<?php

namespace App\Classes;

use DateTime;
use App\Models\Holiday;
use Illuminate\Support\Collection;

class Date extends DateTime
{
    public function __construct($time = 'now', $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * Check if the date is a weekend
     *
     * @return bool
     */
    public function isWeekend(): bool
    {
        return in_array($this->format('l'), ['Saturday', 'Sunday']);
    }

    /**
     * Check if the date is a weekday
     * 
     * @return bool
     */
    public function isWeekday(): bool
    {
        return !$this->isWeekend();
    }

    /**
     * Check if the date is a holiday
     * 
     * @param Collection $holidayCountries
     * @return bool
     */
    public function isHoliday(Collection $holidayCountries = null): bool
    {
        $baseQuery = Holiday::where('date', $this->format('Y-m-d'));

        // check if $cc is provided
        if ($holidayCountries) {
            $baseQuery->whereIn('country', $holidayCountries->toArray());
        }

        return $baseQuery->exists();
    }

    /**
     * Check if the date is a working day
     * 
     * @param Collection $holidayCountries
     * @return bool
     */
    public function isWorkingDay(
        Collection $holidayCountries = null
    ): bool {

        if (!$holidayCountries) {
            return !$this->isWeekend();
        }

        return !$this->isWeekend() && !$this->isHoliday($holidayCountries);
    }
}
