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
        $this->sut->setNumBalls(5);
        $this->assertEquals(5, $this->getObjectAttribute($this->sut, 'numBalls'));
    }
}
