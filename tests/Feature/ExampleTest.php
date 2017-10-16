<?php

namespace Tests\Feature;

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
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     public function picoPlacaMain()
    {
        $response = $this->get('/picoplacapredictor');

        $response->assertStatus(200);
    }

    // public function lastPlateDigit(){
    //     $picoPlacaObj = new PicoPlacaPredictorModel("PBU-1378","2017-10-05","9:00");
    //     $this->assertEquals(6,$picoPlacaObj->getLastDigitFromPlate("PCU-9856"));
    // }

    // public function dayNameFromDate(){
    //     $picoPlacaObj = new PicoPlacaPredictorModel("PBU-1378","2017-10-16","9:00");
    //     $this->assertEquals("Monday",$picoPlacaObj->getDayNameFromDate());
    // }
}
