<?php namespace PsuedoRandomizer;

use PHPUnit\Framework\TestCase;
use PsuedoRandomizer\PsuedoRandomizer;
use PsuedoRandomizer\Formulas\LinearCongruential\NumericalRecipes;
use PsuedoRandomizer\Algorithms\LinearCongruentialGenerator;

class NumericalRecipesTest extends TestCase
{
    var $algorithm;

    /**
     * Setup Generator
     */
    public function setUp()
    {
        // setup Randomizer
        $this->algorithm = new LinearCongruentialGenerator(new NumericalRecipes());
    }

    /** @test  */
    public function variety_of_numbers_are_returned()
    {
        $results = [];
    
        $this->algorithm
            ->setSeed(1234567890)
            ->setStartRange(1)
            ->setEndRange(100);
    
        $randomizer = new PsuedoRandomizer( $this->algorithm );
    
        for ($i = 1; $i <= 100; $i ++) {
            $results[] = $randomizer->random();
        }
    
        $this->assertNotEmpty($results);
    
        // let's check for uniform distribution
        $sum  = array_sum($results);
        $mean = $sum / count($results);
    
        $this->assertLessThan( 60, $mean, 'Average of random numbers above the average!' );
        $this->assertGreaterThan( 40, $mean, 'Average of random numbers below the average!' );
    }
    
    /** @test */
    public function always_receive_a_return_number()
    {
        $this->algorithm
            ->setSeed(56791252)
            ->setStartRange(1)
            ->setEndRange(1000);
    
        $randomizer = new PsuedoRandomizer( $this->algorithm );
    
        for ($i = 1; $i <= 1000; $i++) {
            $results[] = $randomizer->random();
        }
    
        $this->assertEquals(1000, count($results), 'Randomizer failed to return required number of random numbers!');
    }
}