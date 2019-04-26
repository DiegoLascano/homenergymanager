<?php

namespace App\Services\GeneticAlgorithm;

class Schedule
{
    /**
     * Hourly energy cost indexed by their IDs
     *
     * @var array
     */
    private $energyCost;

    /**
     * Hourly PV energy generated
     *
     * @var array
     */
    private $energyPV;

    /**
     * Appliances indexed by their IDs
     *
     * @var array
     */
    private $appliances;

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
        $this->appliances = [];
        $this->energyCost = [];
        $this->energyPV = [];
        $this->appliancesCount = 0;
        $this->timeSlots = $timeSlots;
    }

    /**
    * Set parameters of appliances
    *
    * @param array $appliances
    */
    public function setAppliances($appliances)
    {
        return $this->appliances = $appliances;
    }

    /**
    * Set the energy cost array for a given day
    *
    * @param array $energyCost
    */
    public function setEnergyCost($energyCost)
    {
        return $this->energyCost = $energyCost;
    }

    /**
    * Set the energy cost array for a given day
    *
    * @param array $energyPV
    */
    public function setEnergyPV($energyPV)
    {
        return $this->energyPV = $energyPV;
    }

    /**
    * Set the number of appliances
    *    
    * @param int $appliancesCount
    */
    public function setAppliancesCount($appliancesCount)
    {
        return $this->appliancesCount = $appliancesCount;
    }

    /**
    * Get parameters of appliances
    *
    */
    public function getAppliances()
    {
        return $this->appliances;
    }

    /**
    * Gets the energy cost 
    *
    * @param array $energyCost
    */
    public function getEnergyCost()
    {
        return $this->energyCost;
    }

    /**
    * Gets the PV energy generated
    *
    * @param array $energyCost
    */
    public function getEnergyPV()
    {
        return $this->energyPV;
    }

    /**
    * Get the number of appliances 
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