<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use App\Models\PicoPlacaPredictorModel;
use Response;
use Illuminate\Support\Facades\Input;

class PicoPlacaMainController extends BaseController
{
   
	//main view
	public function index(){
		//load pico y placa form 
		return view('main');
	}

	//This function return a pico y placa prediction 
	public function postPrediction(){
		//input values
		$plate = Input::get("plate");
		$date  = Input::get("date");
		$time  = Input::get("time");

		//pico y placa predictor
		$picoPlacaObj = new PicoPlacaPredictorModel($plate,$date,$time);
   		$prediction = $picoPlacaObj->predictPicoPlaca();

   		//return a formatted prediction 
        return Response::json($picoPlacaObj->setPredictionText($prediction));
	}

}
