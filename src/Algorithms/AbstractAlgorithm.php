<?php namespace PsuedoRandomizer\Algorithms;

use PsuedoRandomizer\Algorithms\AlgorithmInterface;

class AbstractAlgorithm implements AlgorithmInterface
{
    /**
     * @var $seed
     */
    protected $seed;

    /**
     * Callback/Lamba containing additional rand() criteria
     *
     * @var $randClosure
     */
    private $randClosure;
    
    /**
     * Ranges for Number Generation
     *
     * @var $startRange, $endRange
     */
    protected $startRange, $endRange;

    /**
     * Seed Setter
     */
    public function setSeed($seed)
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * Seed Getter
     *
     * @return mixed
     */
    public function getSeed()
    {
        return $this->seed;
    }

    /**
     * Set rand() Closure
     *
     * @param $randClosure
     * @return $this|bool
     */
    public function setRandClosure(\Closure $randClosure)
    {
        if (!is_callable($randClosure))
        {
            return false;
        }

        $this->randClosure = $randClosure;

        return $this;
    }

    /**
     *  Execute Rand Closure
     */
    public function rand()
    {
        if (!is_callable($this->randClosure))
        {
            return false;
        }

        $rand = $this->randClosure;

        return $rand();
    }
    
    /**
     * Start Range
     *
     * @param $startRange
     * @return $this
     */
    public function setStartRange($startRange)
    {
        $this->startRange = $startRange;
        
        return $this;
    }
    
    /**
     * End Range
     *
     * @param $endRange
     * @return $this
     */
    public function setEndRange($endRange)
    {
        $this->endRange = $endRange;
        
        return $this;
    }
}