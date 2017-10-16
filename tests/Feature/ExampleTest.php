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
    public function testConectionTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     public function testPicoPlacaMain()
    {
        $response = $this->get('/picoplacapredictor');

        $response->assertStatus(200);
    }

    public function testLastPlateDigit(){
        $picoPlacaObj = new PicoPlacaPredictorModel("PBU-1378","2017-10-05","9:00");
        $this->assertEquals(8,$picoPlacaObj->getLastDigitFromPlate());
    }

    public function testDayNameFromDate(){
        $picoPlacaObj = new PicoPlacaPredictorModel("PBU-1378","2017-10-16","9:00");
        $this->assertEquals("Monday",$picoPlacaObj->getDayNameFromDate());
    }

    public function testNotInPicoPlaca(){
        $picoPlacaObj = new PicoPlacaPredictorModel("PCT-1376","2017-10-04","2:00");
        $this->assertEquals(false,$picoPlacaObj->predictPicoPlaca());
    }

    public function testInPicoPlaca(){
        $picoPlacaObj = new PicoPlacaPredictorModel("PCT-1375","2017-09-13","16:00");
        $this->assertEquals(true,$picoPlacaObj->predictPicoPlaca());
    }

    public function testPredictionText(){
        $picoPlacaObj = new PicoPlacaPredictorModel("ABC-0070","2017-07-07","08:20");
        $result=$picoPlacaObj->predictPicoPlaca();
        $this->assertContains("not",$picoPlacaObj->setPredictionText($result));
    }
}
