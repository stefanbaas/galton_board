<?php

namespace Tests\Unit;

use App\Classes\GaltonBoard;
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
     * A basic test example.
     *
     * @return void
     */
    public function testInstantiation()
    {
        $this->assertNotNull($this->sut);
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
        $this->sut->createBoard();
        $this->assertEquals(array(array(0),array(0,0),array(0,0,0)), $this->getObjectAttribute($this->sut, 'board'));
    }
}
