<?php namespace PsuedoRandomizer\Algorithms;

use PsuedoRandomizer\Algorithms\AbstractAlgorithm;
use PsuedoRandomizer\Algorithms\AlgorithmInterface;
use PsuedoRandomizer\Formulas\LinearCongruentialGeneratorFormulaInterface;

/**
 * Class LinearCongruentialGenerator
 * @package PsuedoRandomizer\Algorithms
 * @see https://en.wikipedia.org/wiki/Linear_congruential_generator
 */
class LinearCongruentialGenerator extends AbstractAlgorithm implements AlgorithmInterface
{
    /**
     * LinearCongruentialGenerator constructor.
     * @param LinearCongruentialGeneratorFormulaInterface $formula
     */
    public function __construct(LinearCongruentialGeneratorFormulaInterface $formula)
    {
        $this->periodBase = $formula->periodBase; // or $m (base)
        $this->periodPower = $formula->periodPower; // or $m (power)
        $this->multiplier = $formula->multiplier; // or $a
        $this->increment = $formula->increment; // or $c
    }

    /**
     * Randomize!
     *
     * @return int
     */
    public function random()
    {
        // formula
        $modulus = pow($this->periodBase, $this->periodPower);
        $seed_remainder = (($this->multiplier * $this->getSeed()) + $this->increment) % $modulus;
        
        $this->setSeed($seed_remainder);

        $random_number = (int) substr($seed_remainder, 4, 2);
    
        if ($random_number == 0)
        {
            return $this->endRange;
        }
        
        return $random_number;
    }

    /**
     * Get Seed
     */
    public function getSeed()
    {
        if (empty($this->seed))
        {
            while (strlen($this->seed) < 9)
            {
                $this->seed .= $this->rand();
            }
        }
        
        return $this->seed;
    }
}