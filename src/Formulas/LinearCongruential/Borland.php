<?php namespace PsuedoRandomizer\Formulas\LinearCongruential;

use PsuedoRandomizer\Formulas\LinearCongruentialGeneratorFormulaInterface;
use PsuedoRandomizer\Formulas\AbstractLinearCongruentialGeneratorFormula;

class Borland extends AbstractLinearCongruentialGeneratorFormula implements LinearCongruentialGeneratorFormulaInterface
{
    var $periodBase = 2;
    var $periodPower = 32;
    var $multiplier = 22695477;
    var $increment = 1;
}

