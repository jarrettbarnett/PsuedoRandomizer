<?php namespace PsuedoRandomizer;

interface PsuedoRandomizerInterface
{
    /**
     * Primary method used to generate random number
     *
     * @return mixed
     */
    public function random();
}