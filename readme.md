# Psuedo Random Number Generator

## Setup

$ composer install

#### Basic Example

    <?php
        use PsuedoRandomizer\PsuedoRandomizer;
        use PsuedoRandomizer\Algorithms\MersenneTwister;
        
        $randomizer = new PsuedoRandomizer(new MersenneTwister);
        
        // generate random number!
        $randomizer->random();

#### Using A Different Algorithm

    <?php
    
        use PsuedoRandomizer\PsuedoRandomizer;
        use PsuedoRandomizer\Algorithms\LinearCongruentialGenerator;
        use PsuedoRandomizer\Formulas\LinearCongruential\NumericalRecipes;
            
        // create formula
        $formula = new NumericalRecipes();
            
        // create the algorithm and supply the formula parameters
        $algorithm = new LinearCongruentialGenerator($formula);
        
        // set algorithm
        $randomizer = new PsuedoRandomizer($algorithm);
            
        // generate random number!
        $randomizer->random();
            
#### Configuring Algorithm with Seed and Start/End Ranges
      
    <?php
        // set initial seed and start/end range if needed
        $algorithm->setSeed(1234567890)
                  ->setStartRange(1)
                  ->setEndRange(100);


#### Linear Congruential Example w/ Numerical Recipes Formula
    
    <?php
        use PsuedoRandomizer\PsuedoRandomizer;
        use PsuedoRandomizer\Algorithms\LinearCongruentialGenerator;
        use PsuedoRandomizer\Formulas\LinearCongruential\NumericalRecipes;
        
        // create the algorithm and supply the formula parameters
        $algorithm = new LinearCongruentialGenerator(new NumericalRecipes);
        
        // provider randomizer with the algorithm
        $randomizer = new PsuedoRandomizer($algorithm);
        
        // generate random number!
        $randomizer->random();
    
#### Using a different formula for Linear Congruential

Following the previous example, you only need to add the namespace and swap the class formula provided to the LinearCongruential algorithm class.

    <?php
        use PsuedoRandomizer\Formulas\LinearCongruential\Borland;
        
        // create the algorithm and supply the formula parameters
        $algorithm = new LinearCongruentialGenerator(new Borland());
        
#### One-liner

    <?php
        use PsuedoRandomizer\PsuedoRandomizer;
        use PsuedoRandomizer\Algorithms\LinearCongruentialGenerator;
        use PsuedoRandomizer\Formulas\LinearCongruential\NumericalRecipes;
        
        // too much? maybe...
        $randomizer = new PsuedoRandomizer(new LinearCongruentialGenerator(new NumericalRecipes));
        
        // generate random number!
        $randomizer->random();