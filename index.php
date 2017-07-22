<?php
/**
 * Welcome to Big Dice!
 *
 * This is 24-hour programming assignment. From the time you receive this
 * (based on the sent date of the email) you have 24 hours to return to
 * us a fully-functional solution that we can run for ourselves.
 *
 * Big Dice is a simple test to see how you'd approach solving what sounds
 * like a simple problem but is in fact a bit tricky.
 *
 * Without using the rand() function, can you make a big_dice() function
 * which returns a random int between 1-100, with even distribution
 *
 * You can and must use the dice() function within the big_dice() function
 *
 * Some simple testing code is included at the bottom to ensure
 * even distribution and to calculate run-time.
 *
 * DELIVERABLES:
 *
 * -- All code, PHP files, etc., necessary to run your solution
 * -- A Google Docs graph of the distribution of your results from the
 * test function below
 *
 * Good luck!
 *
 *
 *
 * @author Jarrett Barnett <hello@jarrettbarnett.com>
 * @date July, 22, 2017
 *
 *
 */

/**
 * This is your only input function (use instead of rand())
 * @return int
 */
function dice()
{
    return rand(1,6);
}
/**
 * Here's the test -- create a random number between 1 and 100
 * @return int $result number between 1 and 100
 */

function big_dice()
{
    $max = 100;
    
    // seed variables
    $rand = dice(); // prefer to only run this once as it impacts performance
    $seed = microtime(true);
    $multiplier = 1664525;
    
    $increment = 1013904223;
    $exp = (int) '3' . $rand;
    $modulus = pow(2, $exp);
    
    // calculate seed
    $seed = (($seed * (float) $multiplier) + $increment / $modulus) / $exp;
    $seed ^= ($seed >> 4);
    
    $result = substr($seed, -2, 2);
    
    // condition for 100
    if ($result == 0)
    {
        return $max;
    }
    
    return $result;
}

/**
 * Test Big Dice
 *
 * @param int $test_limit
 */
function test_big_dice($test_limit = 100000)
{
    $big_dice_rolls = array();
    $start = microtime(true);

    for ($i = 0; $i < $test_limit; $i++) {
        $big_dice_rolls[] = big_dice();
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
}


test_big_dice();