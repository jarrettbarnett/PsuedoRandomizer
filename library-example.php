<?php

// composer autoloader
require realpath('vendor/autoload.php');

use PsuedoRandomizer\PsuedoRandomizer;
use PsuedoRandomizer\Formulas\LinearCongruential\NumericalRecipes;
use PsuedoRandomizer\Formulas\LinearCongruential\Borland;
use PsuedoRandomizer\Algorithms\LinearCongruentialGenerator;

/**
 * Roll a Die
 *
 * @return int
 */
$dice = function()
{
    return rand(1,6);
};

// setup initial seed
$seed = '';
while (strlen($seed) < 9)
{
    $seed .= $dice();
}
$seed = (int) $seed;


// setup the randomizer with Numerical Recipes values for LinearCongruentialGenerator class
$algorithm = new LinearCongruentialGenerator(new NumericalRecipes());
$algorithm->setSeed($seed)
          ->setRandClosure($dice)
          ->setStartRange(1)
          ->setEndRange(100);
$psuedoRandomizer = (new PsuedoRandomizer($algorithm));

// example usage
// $psuedoRandomizer->random();


/**
 * Test!
 */
$test_limit = 100000;
$big_dice_rolls = array();
$start = microtime(true);

for ($i = 0; $i < $test_limit; $i++) {
    $big_dice_rolls[] = $psuedoRandomizer->random();
}

$stop = microtime(true);
$duration = round((($stop - $start)), 4);
$breakdown = array_count_values($big_dice_rolls);
arsort($breakdown); // anomolies would be at the top or bottom

echo "Tested {$test_limit} rolls in ~{$duration} sec" . '<br />';
echo "Ended up with " . count($breakdown) . " total outputs" . '<br />';

foreach ($breakdown as $int => $occurances) {
    $pecentage = round($occurances / $test_limit * 100, 2);
    echo "{$int} => [{$pecentage}%] {$occurances}<br/>";
}
