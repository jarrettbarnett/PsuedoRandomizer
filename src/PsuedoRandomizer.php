<?php namespace PsuedoRandomizer;

use PsuedoRandomizer\Algorithms\AlgorithmInterface;

class PsuedoRandomizer extends AbstractPsuedoRandomizer
{
    /**
     * @var AlgorithmInterface
     */
    protected $psuedoAlgorithm;

    /**
     * PsuedoRandomizer constructor.
     * @param AlgorithmInterface $algorithm
     */
    public function __construct(AlgorithmInterface $algorithm)
    {
        $this->psuedoAlgorithm = $algorithm;

        return $this;
    }

    /**
     * Randomize!
     *
     * @return mixed
     */
    public function random()
    {
        return $this->psuedoAlgorithm->random();
    }
}