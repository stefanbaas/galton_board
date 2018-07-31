<?php

namespace App\Interfaces;

interface GaltonBoardInterface
{
    public function setNumBalls(int $numBalls);
    public function setNumSlots(int $numSlots);
    public function init();
    public function start();
    public function getSlots() :array;
}