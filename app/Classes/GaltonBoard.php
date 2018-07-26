<?php

namespace App\Classes;

class GaltonBoard
{
    private $numBalls = 0;
    private $numSlots = 0;
    private $board = array();

    public function setNumBalls($numBalls)
    {
        $this->numBalls = $numBalls;
    }

    public function setNumSlots($numSlots)
    {
        $this->numSlots = $numSlots;
    }

    public function createBoard()
    {
        $board = array();
        for($nr = 1; $nr <= $this->numSlots; $nr++){
            $board[] = array_fill(0, $nr, 0);
        }

        $this->board = $board;
    }
}