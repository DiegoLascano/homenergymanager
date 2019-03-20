<?php

namespace App\Services\GeneticAlgorithm;

use App\Events\ScheduleGenerated;
use App\Schedule as ScheduleModel;
use App\Appliance as ApplianceModel;

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
    * Initialize the LOCAL $schedule with all the information needed
    *
    */
    public function initializeSchedule()
    {
        $timeSlots = 120;
        $schedule = new Schedule($timeSlots);
        $appliances = ApplianceModel::select('id')->where('status', '0')->get();
        $appliancesCount = count($appliances);
        // $appliancesCount = 10;
        $schedule->setAppliancesCount($appliancesCount);

        return $schedule;
    }

    /**
    * This function runs/controls the GA cycle
    *
    * @param Type $var var explanation
    */
    public function run()
    {
        $maxGenerations = 500;

        $schedule = $this->initializeSchedule();

        $chromosomeLength = 16;
        // GeneticAlgorithm(PopulationSize, Mutation, Crossover, Elites, Torneo)
        $algorithm = new GeneticAlgorithm(100, 0.02, 0.9, 2, 10);
        $population = $algorithm->initPopulation($schedule->getAppliancesCount());
        $algorithm->evaluatePopulation($population);
        
        // dump($population);
        // $population = $algorithm->crossoverPopulation($population);
    
        $generation = 1;

        // This variables are used to verify minimization 
        $minimo = 1000;
        $bestGen = $generation;
        $maintainedGenerations = 0;

        while (!$algorithm->isTerminationConditionMet($maintainedGenerations)
                && !$algorithm->isGenerationsMaxedOut($generation, $maxGenerations)) {
    
            $fittest = $population->getFittest(0);
    
            print "Generation: " . $generation . "(" . $fittest->getFitness() . ") Generations maintained: " . $maintainedGenerations;
            // print $fittest;
            // print "Generation: " . $generation;
            print "\n";
    
            // Apply crossover
            $population = $algorithm->crossoverPopulation($population);
    
            // Apply mutation
            $population = $algorithm->mutatePopulation($population);
    
            // Evaluate Population
            $algorithm->evaluatePopulation($population);

            // Prepare termination condition
            $fitness = $population->getFittest(0)->getFitness();
            if($fitness < $minimo){
                $minimo = $fitness;
                $bestGen = $generation;
            }
            $maintainedGenerations = $generation - $bestGen;

            // Increment current generation
            $generation++;
    
            // Cool temperature of GA for simulated annealing
            $algorithm->coolTemperature();
        }
        $optimalSolution =  $population->getFittest(0);

        // Update Schedule in database
        // $this->schedule->update([
        //     'chromosome' => $optimalSolution->getChromosomeString(),
        //     'fitness' => $optimalSolution->getFitness(),
        //     'generations' => $generation,
        //     'status' => 'COMPLETED'
        // ]);
        // event(new ScheduleGenerated($optimalSolution));
        dump($optimalSolution);
        dump($schedule->getAppliancesCount());
    }
}