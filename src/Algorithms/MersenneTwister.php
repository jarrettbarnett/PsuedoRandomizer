<?php namespace PsuedoRandomizer\Algorithms;

class MersenneTwister extends AbstractAlgorithm implements AlgorithmInterface
{
    /**
     * Randomize!
     */
    public function random()
    {
        // TODO swap for actual MT formula
        return mt_rand($this->startRange, $this->endRange);
    }
    
    /**
     * Calculation
     *
     * @param $mt
     * @param $mti
     *
     * @return int
     */
    public function calculate($mt, $mti)
    {
        $N = 624;
        $M = 397;
        $MATRIX_A = 0x9908b0df;
        $UPPER_MASK = 0x80000000;
        $LOWER_MASK = 0x7fffffff;
        $MASK14 = 0x6000000d;
        $MASK21 = 0x67000000;
        $MASK31 = 0x90000000;
    
        $mag01 = array(0, $MATRIX_A);
    
        if ($mti >= $N) { /* generate $N words all at once */
            
            for ($kk = 0; $kk < $N - $M; $kk++) {
                $y = ($mt[$kk] & $UPPER_MASK) | ($mt[$kk + 1] & $LOWER_MASK);
                $mt[$kk] = $mt[$kk + $M] ^ (($y >> 1) & $MASK31) ^ $mag01[$y & 1];
            }
            
            for (; $kk < $N - 1; $kk++) {
                $y = ($mt[$kk] & $UPPER_MASK) | ($mt[$kk + 1] & $LOWER_MASK);
                $mt[$kk] = $mt[$kk + ($M - $N)] ^ (($y >> 1) & $MASK31) ^ $mag01[$y & 1];
            }
            
            $y = ($mt[$N - 1] & $UPPER_MASK) | ($mt[0] & $LOWER_MASK);
            $mt[$N - 1] = $mt[$M - 1] ^ (($y >> 1) & $MASK31) ^ $mag01[$y & 1];
        
            $mti = 0;
        }
    
        $y = $mt[$mti++];
    
        /* Tempering */
        $y ^= ($y >> 11) & $MASK21;
        $y ^= ($y << 7) & ((0x9d2c << 16) | 0x5680);
        $y ^= ($y << 15) & (0xefc6 << 16);
        $y ^= ($y >> 18) & $MASK14;
    
        return $y;
    }
}