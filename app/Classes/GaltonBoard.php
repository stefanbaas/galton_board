<?php

namespace App\Classes;

class GaltonBoard
{
    private $numBalls = 0;
    private $numSlots = 0;
    private $board = array();
    private $slots = array();
    private $curRow = 0;

    public function setNumBalls($numBalls)
    {
        $this->numBalls = $numBalls;
    }

    public function setNumSlots($numSlots)
    {
        $this->numSlots = $numSlots;
    }

    private function _createBoard()
    {
        $board = array();
        for($nr = 1; $nr <= $this->numSlots; $nr++){
            $board[] = array_fill(0, $nr, 0);
        }

        $this->board = $board;
    }

    private function _createSlots()
    {
        $slots = array_fill(0, $this->numSlots, 0);
        $this->slots = $slots;
    }

    public function init()
    {
        $this->_createBoard();
        $this->_createSlots();
    }
}