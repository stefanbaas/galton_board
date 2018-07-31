<?php

namespace App\Classes;

class GaltonBoard
{
    private $numBalls = 0;
    private $numSlots = 0;
    private $board = array();
    private $slots = array();
    private $curBall = 0;
    private $curRow = 0;
    private $curPos = 0;

    /**
     * Set number of balls
     * @param int $numBalls
     */
    public function setNumBalls(int $numBalls)
    {
        $this->numBalls = $numBalls;
    }

    /**
     * Set number of slots
     * @param int $numSlots
     */
    public function setNumSlots(int $numSlots)
    {
        $this->numSlots = $numSlots;
    }

    /**
     * Create an array for the board
     */
    private function _createBoard()
    {
        $board = array();
        for($nr = 1; $nr <= $this->numSlots; $nr++){
            $board[] = array_fill(0, $nr, 0);
        }

        $this->board = $board;
    }

    /**
     * Create an array with slots
     */
    private function _createSlots()
    {
        $slots = array_fill(0, $this->numSlots, 0);
        $this->slots = $slots;
    }

    /**
     * Reset board for new ball
     */
    private function _resetBoard()
    {
        $this->curPos = 0;
        $this->curRow = 0;
        $this->_createBoard();
    }

    /**
     * Add a new ball - loop trough board
     * @param int $nr
     * @return int
     */
    private function _addBall(int $nr)
    {
        $this->curBall = $nr;
        $this->_resetBoard();
        foreach($this->board AS $row){
            $newPos = $this->_getNewPos($this->curRow, $this->curPos);
            $this->_setPos($this->curRow, $newPos);
            $this->curRow++;
        }

        return $this->curPos;
    }

    /**
     * Get a new random position - go left or right
     * @param int $curRow
     * @param int $curPos
     * @return int|mixed
     */
    private function _getNewPos(int $curRow, int $curPos)
    {
        $aPosDirections = array($curPos, $curPos+1);
        $newPosKey = array_rand($aPosDirections);
        $newPos = $aPosDirections[$newPosKey];

        if($curRow == 0) {
            return $curPos;
        }else{
            return $newPos;
        }
    }

    /**
     * Set the position on the board and update current position
     * @param int $rowNr
     * @param int $pos
     */
    private function _setPos(int $rowNr, int $pos)
    {
        $this->curPos = $pos;
        $this->board[$rowNr][$pos] = 1;
    }

    /**
     * Increase a slot by a slotnr
     * @param int $slotNr
     */
    private function _increaseSlot(int $slotNr){
        $this->slots[$slotNr]++;
    }

    /**
     * Initiate the Galton board - create the board and the slots array
     */
    public function init()
    {
        $this->_createBoard();
        $this->_createSlots();
    }

    /**
     * Start the Galton board - add the balls and increase the slots
     */
    public function start()
    {
        for($nr = 1; $nr <= $this->numBalls; $nr++){
            $slotNr = $this->_addBall($nr);
            $this->_increaseSlot($slotNr);
        }
    }

    /**
     * Get the slots array
     * @return array
     */
    public function getSlots()
    {
        return $this->slots;
    }

}