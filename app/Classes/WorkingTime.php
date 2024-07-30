<?php

namespace App\Classes;

use DateTime;

class WorkingTime
{
    public $start;
    public $end;

    private $effectiveWorkingTime;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;

        $this->effectiveWorkingTime = $this->getWorkingTimeInSeconds();
    }

    private function getWorkingTimeInSeconds()
    {
        // hh:mm:ss
        $start = explode(':', $this->start);
        $end = explode(':', $this->end);

        $startInSeconds = $start[0] * 3600 + $start[1] * 60;
        $endInSeconds = $end[0] * 3600 + $end[1] * 60;

        return $endInSeconds - $startInSeconds;
    }

    /**
     * Get the effective working time in seconds
     *
     * @return int
     */
    public function getEffectiveWorkingTime(): int
    {
        return $this->effectiveWorkingTime;
    }
}
