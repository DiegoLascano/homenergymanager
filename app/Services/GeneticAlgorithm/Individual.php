<?php
namespace App\Services\GeneticAlgorithm;

class Individual
{
    /**
     * This is the genetic makeup of an individual
     *
     * @var array
     */
    private $chromosome;


    /**
     * Fitness of the individual
     *
     * @var double
     */
    private $fitness;

    /**
    * Create a new individual
    *
    * @param Type $var var explanation
    */
    public function __construct($chromosomeLength = null)
    {
        if($chromosomeLength){
            $newChromosome = [];
            for ($i = 0; $i < $chromosomeLength; $i++) {
                $newChromosome[$i] = random_int(1, 120);
            }
        }else{
            $newChromosome = [];
        }
        

        // $chromosomeIndex = 0;
        
        $this->chromosome = $newChromosome;
    }

    /**
    * Create a new individual with a random chromosome
    *
    * @param int $chromosomeLength Desired chromosome length
    */
    public static function random($chromosomeLength)
    {
        $individual = new Individual();

        for ($i = 0; $i < $chromosomeLength; $i++) {
            $individual->setGene($i, random_int(1, 120));
        }

        return $individual;
    }

    /**
     * Get the individual's chromosome
     *
     * @return array The chromosome
     */
    public function getChromosome()
    {
        return $this->chromosome;
    }

    /**
     * Get the length of the individual's chromosome
     *
     * @return int The length
     */
    public function getChromosomeLength()
    {
        return count($this->chromosome);
    }

    /**
     * Fix a gene at the given location of the chromosome
     *
     * @param int $index The location to insert the gene
     * @param int $gene The gene
     */
    public function setGene($index, $gene)
    {
        $this->chromosome[$index] = $gene;
    }

    /**
     * Get the gene at the specified location
     *
     * @param $index The location to get the gene at
     * @return int The value representing the gene at that location
     */
    public function getGene($index)
    {
        return $this->chromosome[$index];
    }

    /**
     * Set the fitness param for this individual
     *
     * @param double $fitness The fitness of this individual
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * Get the fitness for this individual
     *
     * @return double The fitness of the individual
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * Get a printout of the individual
     *
     * @return string Output of the individual details
     */
    public function __toString()
    {
        return $this->getChromosomeString();
    }

    public function getChromosomeString()
    {
        return implode(",", $this->chromosome);
    }
}