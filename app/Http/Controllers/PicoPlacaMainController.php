<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use App\Models\PicoPlacaPredictorModel;
use Response;
use Illuminate\Support\Facades\Input;

class PicoPlacaMainController extends BaseController
{
   

	public function index(){

		
		return view('main');
	}

	public function postPrediction(){

		$plate = Input::get("plate");
		$date  = Input::get("date");
		$time  = Input::get("time");

		$picoPlacaObj = new PicoPlacaPredictorModel($plate,$date,$time);
   		$prediction = $picoPlacaObj->predictPicoPlaca();

        return Response::json($picoPlacaObj->setPredictionText($prediction));
	}

}
