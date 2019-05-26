<?php

namespace App\Services\GeneticAlgorithm;

use App\Events\ScheduleGenerated;
use App\Schedule as ScheduleModel;
use App\Appliance as ApplianceModel;
use Carbon\Carbon;
use App\Prcu;
use App\PowerGenerated;
use App\Events\FlashMessage;

class SchedulingGA
{
    protected $schedule;

    /**
    * Create a new instance of SchedulinGA class
    *
    * @param ScheduleModel $schedule Schedule we want to run the GA
    */
    public function __construct(ScheduleModel $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
    * Get the timeslot for the current time of the day
    *
    */
    public function getCurrentTimeslot()
    {
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $timeslot = (int)ceil(($hour * 60 + $minute) / 12);

        $timeslot = 1; //this variable has to be removed

        return $timeslot;
    }

    /**
    * Get the PV energy generated for a day
    *
    */
    public function getPV()
    {
        $energyPV = [];
        $m = 0;
        $day = Carbon::now()->format('Y-m-d');
        $PV = PowerGenerated::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $day)->get();
                        
        // Generate a vector with 120 values 
        for ($i=1; $i < 25; $i++) { 
            $hourlyPV = $PV[0][$i];

            // PV energy for each timeslot
            for ($j=1; $j < 6; $j++) { 
                $energyPV[$m] = $hourlyPV / 5;
                $m++;
            }
        }
        return $energyPV;
    }

    /**
    * Get the cost of energy from DB for today Prcu
    *
    */
    public function getEnergyCost()
    {
        $energyCost = [];
        $m = 0;
        $day = Carbon::now()->format('Y-m-d');
        $costs = Prcu::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $day)->get();
                        
        // Generate a vector with 120 values 
        for ($i=1; $i < 25; $i++) { 
            $hourlyCost = $costs[0][$i];
            for ($j=1; $j < 6; $j++) { 
                $energyCost[$m] = $hourlyCost;
                $m++;
            }
        }
        return $energyCost;
    }

    /**
    * Initialize the LOCAL $schedule with all the information needed
    *
    */
    public function initializeSchedule()
    {
        $timeSlots = $this->getCurrentTimeslot();
        $schedule = new Schedule($timeSlots);

        $appliances = ApplianceModel::where('status', '0')->get();
        $schedule->setAppliances($appliances);
        
        $appliancesCount = count($appliances);
        $schedule->setAppliancesCount($appliancesCount);

        $energyCost = $this->getEnergyCost();
        $schedule->setEnergyCost($energyCost);

        $energyPV = $this->getPV();
        $schedule->setEnergyPV($energyPV);

        return $schedule;
    }

    /**
    * This function runs/controls the GA cycle
    *
    * @param Type $var var explanation
    */
    public function run()
    {
        $maxGenerations = 1000;

        $schedule = $this->initializeSchedule();

        // GeneticAlgorithm(PopulationSize, Mutation, Crossover, Elites, Torneo)
        $algorithm = new GeneticAlgorithm(100, 0.02, 0.9, 2, 10);

        $population = $algorithm->initPopulation($schedule->getAppliancesCount());

        $algorithm->evaluatePopulation($population, $schedule);
    
        $generation = 1;

        // This variables are used to verify minimization 
        $minimo = 1000;
        $bestGen = $generation;
        $stallGenerations = 0;

        while (!$algorithm->isTerminationConditionMet($stallGenerations)
                && !$algorithm->isGenerationsMaxedOut($generation, $maxGenerations)) {
    
            $fittest = $population->getFittest(0);
    
            print "Generation: " . $generation . "(" . $fittest->getFitness() . ") Stall Generations: " . $stallGenerations;
            print "\n";
    
            // Apply crossover
            $population = $algorithm->crossoverPopulation($population);
    
            // Apply mutation
            $population = $algorithm->mutatePopulation($population);
    
            // Evaluate Population
            $algorithm->evaluatePopulation($population, $schedule);

            // Generate termination condition
            $fitness = $population->getFittest(0)->getFitness();
            if($fitness < $minimo){
                $minimo = $fitness;
                $bestGen = $generation;
            }
            $stallGenerations = $generation - $bestGen;

            // Increment current generation
            $generation++;
    
            // Cool temperature of GA for simulated annealing
            $algorithm->coolTemperature();
        }
        $bestSolution =  $population->getFittest(0);

        // Update Schedule in database
        $this->schedule->update([
            'chromosome' => $bestSolution->getChromosomeString(),
            'fitness' => $bestSolution->getFitness(),
            'generations' => $generation,
            'status' => 'COMPLETED'
        ]);
        event(new FlashMessage('success', 'New schedule generated successfully'));
        // event(new ScheduleGenerated($bestSolution));

        // dump($bestSolution);
    }
}