<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PicoPlacaPredictorModel;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function lastPlateDigit(){
    	$picoPlacaObj = new PicoPlacaPredictorModel("PBU-1378","2017-10-05","9:00");
    	$this->assertEquals(6,$picoPlacaObj->getLastDigitFromPlate("PCU-9856"));
    }
}
