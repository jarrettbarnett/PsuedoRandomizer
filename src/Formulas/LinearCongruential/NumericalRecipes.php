<?php namespace PsuedoRandomizer\Formulas\LinearCongruential;

use PsuedoRandomizer\Formulas\LinearCongruentialGeneratorFormulaInterface;
use PsuedoRandomizer\Formulas\AbstractLinearCongruentialGeneratorFormula;

class NumericalRecipes extends AbstractLinearCongruentialGeneratorFormula implements LinearCongruentialGeneratorFormulaInterface
{
    var $periodBase = 2;
    var $periodPower = 32;
    var $multiplier = 1664525;
    var $increment = 1013904223;
}

