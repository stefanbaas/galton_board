<?php

namespace App\Classes;

class GaltonBoard
{
    private $numBalls;
    private $numSlots;

    public function setNumBalls($numBalls)
    {
        $this->numBalls = $numBalls;
    }

    public function setNumSlots($numSlots)
    {
        $this->numSlots = $numSlots;
    }
}