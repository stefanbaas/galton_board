<?php

namespace Tests\Unit;

use App\Classes\GaltonBoard;
use ReflectionClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GaltonBoardTest extends TestCase
{
    private $sut;

    protected function setUp()
    {
        parent::setUp();
        $this->sut = New GaltonBoard();
    }

    /**
     * Get a private method
     * @param string $name
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected static function getMethod(string $name) {
        $class = new ReflectionClass('App\Classes\GaltonBoard');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testSetNumBalls()
    {
        $this->sut->setNumBalls(50);
        $this->assertEquals(50, $this->getObjectAttribute($this->sut, 'numBalls'));
    }

    public function testSetNumSlots()
    {
        $this->sut->setNumSlots(13);
        $this->assertEquals(13, $this->getObjectAttribute($this->sut, 'numSlots'));
    }

    public function testCreateBoard()
    {
        $this->sut->setNumSlots(3);
        $this->sut->init();
        $this->assertEquals(array(array(0),array(0,0),array(0,0,0)), $this->getObjectAttribute($this->sut, 'board'));
    }

    public function testCreateSlots()
    {
        $this->sut->setNumSlots(5);
        $this->sut->init();
        $this->assertEquals(array(0,0,0,0,0), $this->getObjectAttribute($this->sut, 'slots'));
    }

    public function testGetNewPos()
    {
        // Init
        $this->sut->setNumBalls(1);
        $this->sut->setNumSlots(13);
        $this->sut->init();

        // foo
        $foo = self::getMethod('_getNewPos');

        // get pos in top - is always 0
        $returnVal = $foo->invokeArgs($this->sut, array(0, 0));
        $this->assertEquals(0, $returnVal);

        // test pos - can be 0 or 1
        $returnVal = $foo->invokeArgs($this->sut, array(1, 0));
        $this->assertTrue(in_array($returnVal, array(0,1)));

        // test pos - can be 3 or 4
        $returnVal = $foo->invokeArgs($this->sut, array(4, 3));
        $this->assertTrue(in_array($returnVal, array(3,4)));
    }

    public function testSetPos()
    {
        // Init
        $this->sut->setNumBalls(1);
        $this->sut->setNumSlots(13);
        $this->sut->init();

        $testPositions = [
            1 => 1,
            3 => 2
        ];

        // foo
        $foo = self::getMethod('_setPos');

        foreach($testPositions AS $rowNr => $pos) {
            // Test if pos is 0
            $board = $this->getObjectAttribute($this->sut, 'board');
            $this->assertEquals(0, $board[$rowNr][$pos]);

            // Set pos
            $foo->invokeArgs($this->sut, array($rowNr, $pos));

            // Test if pos is 1
            $board = $this->getObjectAttribute($this->sut, 'board');
            $this->assertEquals(1, $board[$rowNr][$pos]);
        }
    }

    public function testAddBall()
    {
        // Init
        $this->sut->setNumBalls(2);
        $this->sut->setNumSlots(13);
        $this->sut->init();

        // foo
        $foo = self::getMethod('_addBall');
        $returnVal = $foo->invokeArgs($this->sut, array(1));

        // Test if curBall var is 1
        $curBall = $this->getObjectAttribute($this->sut, 'curBall');
        $this->assertEquals(1, $curBall);

        // ReturnVal must fit in one of the 13 slots
        $this->assertTrue(($returnVal >= 0 && $returnVal <= 13));

        // Add a second ball
        $foo = self::getMethod('_addBall');
        $returnVal = $foo->invokeArgs($this->sut, array(2));

        // Test if curBall var is 2
        $curBall = $this->getObjectAttribute($this->sut, 'curBall');
        $this->assertEquals(2, $curBall);

        // ReturnVal must fit in one of the 13 slots
        $this->assertTrue(($returnVal >= 0 && $returnVal <= 13));
    }

    public function testReset()
    {
        // Init
        $this->sut->setNumBalls(1);
        $this->sut->setNumSlots(3);
        $this->sut->init();
        $this->sut->start();

        // Check if curRow isset
        $this->assertEquals(3, $this->getObjectAttribute($this->sut, 'curRow'));

        // Reset
        $foo = self::getMethod('_resetBoard');
        $foo->invoke($this->sut);

        // Check if params have been reset
        $this->assertEquals(0, $this->getObjectAttribute($this->sut, 'curPos'));
        $this->assertEquals(0, $this->getObjectAttribute($this->sut, 'curRow'));
        $this->assertEquals(array(array(0),array(0,0),array(0,0,0)), $this->getObjectAttribute($this->sut, 'board'));
    }

    public function testIncreaseSlot()
    {
        // Init
        $this->sut->setNumBalls(1);
        $this->sut->setNumSlots(3);
        $this->sut->init();

        // Increase slot 1
        $foo = self::getMethod('_increaseSlot');
        $foo->invokeArgs($this->sut, array(1));

        $slots = $this->getObjectAttribute($this->sut, 'slots');

        $this->assertEquals(1, $slots[1]);

        // Increase slot 1 again
        $foo = self::getMethod('_increaseSlot');
        $foo->invokeArgs($this->sut, array(1));

        $slots = $this->getObjectAttribute($this->sut, 'slots');

        $this->assertEquals(2, $slots[1]);

        // Increase slot 2
        $foo = self::getMethod('_increaseSlot');
        $foo->invokeArgs($this->sut, array(2));

        $slots = $this->getObjectAttribute($this->sut, 'slots');

        $this->assertEquals(1, $slots[2]);
    }
}
