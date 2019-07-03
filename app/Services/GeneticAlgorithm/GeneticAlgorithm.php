<?php

namespace App\Services\GeneticAlgorithm;

class GeneticAlgorithm
{
    /**
     * Individual within the Population
     *
     * @var int
     */
    private $populationSize;

    /**
     * Probability of mutation (0.02 is normally)
     *
     * @var double
     */
    private $mutationRate;

    /**
     * Probability of crossover (0.9 normally)
     *
     * @var double
     */
    private $crossoverRate;

    /**
     * Number of 'elite' individuals to be skipped during crossover
     *
     * @var integer
     */
    private $elitismCount;

    /**
     * Size of the tournament
     *
     * @var int
     */
    private $tournamentSize;

    /**
     * Temperature for simulated annealing
     *
     * @var int
     */
    private $temperature;

    /**
     * Cooling rate for simulated annealing
     *
     * @var int
     */
    private $coolingRate;

    /**
     * Create a new instance of this class
     */
    public function __construct($populationSize, $mutationRate, $crossOverRate, $elitismCount, $tournamentSize)
    {
        $this->populationSize = $populationSize;
        $this->mutationRate = $mutationRate;
        $this->crossoverRate = $crossOverRate;
        $this->elitismCount = $elitismCount;
        $this->tournamentSize = $tournamentSize;
        $this->temperature = 1.0;
        $this->coolingRate = 0.001;
    }

    /**
    * Initialize a population
    *
    * @param OST $ost Operation start time vector
    */
    public function initPopulation($chromosomeLength)
    {
        // $population = new Population($this->populationSize);
        $population = Population::random($this->populationSize, $chromosomeLength);
        return $population;
    }

    /**
     * Get the temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Cool temperature
     *
     */
    public function coolTemperature()
    {
        $this->temperature *= (1 - $this->coolingRate);
    }

    /**
    * Calculate the fitness of an individual
    *
    * @param Individual $individual The individual to be analized
    * @param Schedule $schedule Schedule
    * @return double The fitness of the individual
    */
    public function calculateFitness($individual, $schedule)
    {
        // Variable initialization
        $currentTimeslot = $schedule->getTimeslots() - 1;
        $lastTimeslot = 120;

        $pscd = array_fill(0, $lastTimeslot, 0);
        $sumEnergia = array_fill(0, $lastTimeslot, 0);
        $denCost = array_fill(0, $lastTimeslot, 0);
        $score = array_fill(0, 2, 0);
        $p = 5; //variable para la sumatoria DTR
        $cu = 0.4; //thresshold of electrical energy consumed
        $lambda = 1.4423;
        $weightEnergyCost = 0.5; //weight for the energy cost
        $weightDTR = 1- $weightEnergyCost; //weight for the DTR (delay time rate)
        $i = 0;
        
        //Evaluate each appliance
        foreach ($schedule->getAppliances() as $appliance) {
            $alpha = $appliance->start_oti;
            $beta = $appliance->finish_oti;
            $la = $appliance->length_operation;

            $start = $individual->getChromosome()[$i];
            $finish = $start + $la;

            // This section is for the DTR summation
            if (($start > $alpha) && ($finish < $beta)) {
                $DTR = ($start - $alpha) / ($beta - $la - $alpha);
                $sumDTR[$i] = pow($p, $DTR);
            }else{
                $score[0] += 1; 
                $sumDTR[$i] = 5;
            }
            
            // Constraint verification
            if ($finish > $lastTimeslot) {
                $score[1] += 2; 
            }

            // Matriz de consumo
            $consumptionMatrix[$i] = array_fill(0, $lastTimeslot, 0);
            for ($j = $start; $j < $finish; $j++) { 
                $consumptionMatrix[$i][$j] = $appliance->power_kWh / ($lastTimeslot / 24);
            }
            $i++;
        }

        // Max consumption vector for each appliance within a single timeslot
        for ($m = 1; $m < $schedule->getAppliancesCount(); $m++) { 
            $maxConsumption[$m] = $schedule->getEnergyCost()[$m] / ($lastTimeslot / 24);
        }

        // Summation for the cost of energy
        for ($n = $currentTimeslot; $n < $lastTimeslot; $n++) { 
            for ($count=0; $count < $schedule->getAppliancesCount(); $count++) { 
                $pscd[$n] =  $pscd[$n] + $consumptionMatrix[$count][$n];
            }
            $netPscd = $pscd[$n] - $schedule->getEnergyPV()[$n];
            if ($netPscd < 0)$netPscd = 0;
            
            if (($pscd[$n] >= 0) && ($pscd[$n] <= $cu)) {
                // $sumEnergia[$n] = $pscd[$n] * $schedule->getEnergyCost()[$n];
                $sumEnergia[$n] = $netPscd * $schedule->getEnergyCost()[$n];
            }elseif ($pscd[$n] > $cu) {
                // $sumEnergia[$n] = $lambda * $pscd[$n] * $schedule->getEnergyCost()[$n];
                $sumEnergia[$n] = $lambda * $netPscd * $schedule->getEnergyCost()[$n];
            }

            $denCost[$n] = $schedule->getEnergyCost()[$n] * array_sum($maxConsumption);
        }

        $totalConsumption = array_sum($sumEnergia) / array_sum($denCost);
        $totalDTR = array_sum($sumDTR) / ($p * $schedule->getAppliancesCount());

        $score[2] = $weightEnergyCost * $totalConsumption + $weightDTR * $totalDTR;

        $fitness = array_sum($score);;
        $individual->setFitness($fitness);
        return $fitness;
    }

    /**
     * Evaluate a given population
     *
     * @param Population $population The population to evaluate
     * @param Schedule $schedule Schedule data
     */
    public function evaluatePopulation($population, $schedule)
    {
        $populationFitness = 0;
        
        $individuals = $population->getIndividuals();

        foreach ($individuals as $individual) {
            $populationFitness += $this->calculateFitness($individual, $schedule);
        }

        $population->setPopulationFitness($populationFitness);
    }

    /**
     * Determine whether the termination condition has been met
     * This has to be when the min fitness population remains the best 
     * during 100 generetaions
     *
     * @param Population $population Population we are evaluating
     * @return boolean The truth value of this check
     */
    public function isTerminationConditionMet($maintainedGenerations)
    {
        return $maintainedGenerations > 100;
        // return $population->getFittest(0)->getFitness() < 20;
    }

    /**
     * Determine whether we have reached the max generations we want to
     * iterate through
     *
     * @param int $generations Number of generations
     * @param int $maxGenerations Max generations
     */
    public function isGenerationsMaxedOut($generations, $maxGenerations)
    {
        return $generations > $maxGenerations;
    }

    /**
     * Select a parent from a population to be used in a crossover
     * with some other individual
     *
     * The technique used here is tournament selection method
     *
     * @param Population $population The population
     * @return Individual The selected parent
     */
    public function selectParent($population)
    {
        $tournament = new Population();

        $population->shuffle();

        for ($i = 0; $i < $this->tournamentSize; $i++) {
            $participant = $population->getIndividual($i);
            $tournament->setIndividual($i, $participant);
        }
        // dd($tournament);
        return $tournament->getFittest(0);
    }

    /**
     * Perform a crossover on a population's individuals
     *
     * @param Population $population The population
     * @return Population $newPopulation The resulting population
     */
    public function crossoverPopulation($population)
    {
        $newPopulation = new Population($population->size());

        for ($i = 0; $i < $population->size(); $i++) {
            $parentA = $population->getFittest($i);

            $random = mt_rand() / mt_getrandmax();
            if (($this->crossoverRate > $random) && ($i > $this->elitismCount)) {
                // Initialise offspring
                $offspring = Individual::random($parentA->getChromosomeLength());

                $parentB = $this->selectParent($population);

                $swapPoint = mt_rand(0, $parentB->getChromosomeLength());

                for ($j = 0; $j < $parentA->getChromosomeLength(); $j++) {
                    if ($j < $swapPoint) {
                        $offspring->setGene($j, $parentA->getGene($j));
                    } else {
                        $offspring->setGene($j, $parentB->getGene($j));
                    }
                }

                $newPopulation->setIndividual($i, $offspring);
            } else {
                // Add to population without crossover (Elite individuals)
                $newPopulation->setIndividual($i, $parentA);
            }
        }

        return $newPopulation;
    }

    /**
     * Perform a mutation on the individuals of the given population
     *
     * @param Population $population The population to mutate
     */
    public function mutatePopulation($population)
    {
        $newPopulation = new Population();
        $bestFitness = $population->getFittest(0)->getFitness();

        for ($i = 0; $i < $population->size(); $i++) {
            // $individual = $population->getFittest($i);
            $individual = $population->getIndividual($i);
            // dd($individual);
            $randomIndividual = Individual::random($population->getIndividual(0)->getChromosomeLength());
            // $randomIndividual = new Individual($population->getIndividual(0)->getChromosomeLength());

            // Calculate adaptive mutation rate
            $adaptiveMutationRate = $this->mutationRate;

            if ($individual->getFitness() < $population->getAvgFitness()) {
                $fitnessDelta1 =  $individual->getFitness() - $bestFitness;
                $fitnessDelta2 = $population->getAvgFitness() - $bestFitness;
                $adaptiveMutationRate = ($fitnessDelta1 / $fitnessDelta2) * $this->mutationRate;
            }
            // if ($individual->getFitness() > $population->getAvgFitness()) {
            //     $fitnessDelta1 = $bestFitness - $individual->getFitness();
            //     $fitnessDelta2 = $bestFitness - $population->getAvgFitness();
            //     $adaptiveMutationRate = ($fitnessDelta1 / $fitnessDelta2) * $this->mutationRate;
            // }
            
            if ($i > $this->elitismCount) {
                for ($j = 0; $j < $individual->getChromosomeLength(); $j++) {
                    $random = mt_rand() / mt_getrandmax();

                    if (($adaptiveMutationRate * $this->temperature) > $random) {
                        $individual->setGene($j, $randomIndividual->getGene($j));
                        // dump($individual);
                        // $individual->setGene($j, 'mutado');
                        // dump($i);
                        // dump($individual);
                        // $individual[$j] = 'mutado';
                    }
                }
            }
            $newPopulation->setIndividual($i, $individual);
        }
        return $newPopulation;
    }
}