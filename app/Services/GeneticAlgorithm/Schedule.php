<?php

namespace App\Services\GeneticAlgorithm;

class Schedule
{
    /**
     * Appliances indexed by their IDs
     *
     * @var int
     */
    private $appliancesCount;
    
    /**
     * Number of timeslots (120 in one day; one each 12 minutes)
     *
     * @var int
     */
    private $timeSlots;

    /**
    * Create an instance of Schedule class
    *
    * @param Type $var var explanation
    */
    public function __construct($timeSlots)
    {
        $this->appliancesCount = 0;
        $this->timeSlots = $timeSlots;
    }

    /**
    * Set a collection of appliances
    *
    */
    public function setAppliancesCount($appliancesCount)
    {
        return $this->appliancesCount = $appliancesCount;
    }

    /**
    * Get a collection of appliances
    *
    */
    public function getAppliancesCount()
    {
        return $this->appliancesCount;
    }

    /**
    * Get a collection of appliances
    *
    */
    public function getTimeslots()
    {
        return $this->timeSlots;
    }
}