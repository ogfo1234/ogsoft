<?php

namespace App\Classes;

use App\Classes\WorkingTime;

class Task
{
    private $name = '';
    private $dueDate;

    private $startDate;
    private $estimatedTime; // in minutes

    private $workingTime;
    private $includeHolidays;

    public function __construct(
        string $name,
        Date $startDate,
        int $estimatedTime,
        WorkingTime $workingTime,
        bool $includeHolidays = false
    ) {
        $this->name = $name;
        $this->startDate = $startDate;
        $this->estimatedTime = $estimatedTime;
        $this->workingTime = $workingTime;
        $this->includeHolidays = $includeHolidays;

        $this->dueDate = $this->getEndDate();
    }

    public function getEndDate(): Date
    {
        $endDate = clone $this->startDate;
        $_estimatedTime = $this->estimatedTime * 60;

        // iterate through each day to check if it is a working day
        while ($_estimatedTime > 0) {
            $endDate->modify('+60 seconds');

            // check if the date is a weekend
            if ($endDate->isWeekend()) {
                continue;
            }

            // if enabled, check if the date is a holiday
            if ($this->includeHolidays && $endDate->isHoliday()) {
                continue;
            }

            // if the datetime is not between the working time
            if (
                $endDate->format('H:i') <= $this->workingTime->start ||
                $endDate->format('H:i') > $this->workingTime->end
            ) {
                continue;
            }

            $_estimatedTime -= 60;
        }

        return $endDate;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of dueDate
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Get the value of startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of estimatedTime
     */
    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    /**
     * Set the value of estimatedTime
     *
     * @return  self
     */
    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;

        return $this;
    }

    /**
     * Get the value of workingTime
     */
    public function getWorkingTime()
    {
        return $this->workingTime;
    }

    /**
     * Set the value of workingTime
     *
     * @return  self
     */
    public function setWorkingTime($workingTime)
    {
        $this->workingTime = $workingTime;

        return $this;
    }

    /**
     * Get the value of includeHolidays
     */
    public function getIncludeHolidays()
    {
        return $this->includeHolidays;
    }

    /**
     * Set the value of includeHolidays
     *
     * @return  self
     */
    public function setIncludeHolidays($includeHolidays)
    {
        $this->includeHolidays = $includeHolidays;

        return $this;
    }
}
