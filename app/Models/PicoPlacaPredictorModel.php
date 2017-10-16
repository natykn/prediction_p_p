<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class PicoPlacaPredictorModel extends Model
{
    //attributes
   private $plate;
   private $date;
   private $time;


   //constructor
   public function __construct($plate,$date,$time){
   		$this->plate = $plate;
   		$this->date = $date;
   		$this->time = $time;
   }

   //get the last digit from a car plate 
   public function getLastDigitFromPlate(){
   	return substr($this->plate, -1);
   }

   //get the day name from a date
   public function getDayNameFromDate(){
	   //convert string to date 
	   $dateValue = DateTime::createFromFormat("Y-m-d",$this->date);
   	return $dateValue->format("l");
   }
 
   public function predictPicoPlaca(){
   	$isInPicoPlaca = false; //flat to save boolean prediction
   	$dateFormat="Y-m-d H:i"; 
   	$dayName=$this->getDayNameFromDate();
   	$lastPlateDigit= $this->getLastDigitFromPlate();

   	//pico placa restriction by day and hour 
   	$restrictionsByDay = ["Monday" => [1, 2],
   					 		"Tuesday" => [3, 4],
   					 		"Wednesday" => [5, 6],
   							"Thursday" => [7, 8],
   							"Friday" => [9, 0]
   							];
      //pico placa restriction by hour
   	$restrictionsByHour = [["7:00","9:30"],
   							["16:00","19:30"]
   							];


   	//checks if there is a day restriction 
   	if(key_exists($dayName, $restrictionsByDay) && in_array($lastPlateDigit,$restrictionsByDay[$dayName])){
   		//checks if there is a hour restriction
   		$dateToEvaluate = DateTime::createFromFormat($dateFormat,$this->date." ".$this->time);
   		foreach ($restrictionsByHour as $hoursRange){
   			$startAt = DateTime::createFromFormat($dateFormat,$this->date." ".$hoursRange[0]);
   			$endAt = DateTime::createFromFormat($dateFormat,$this->date." ".$hoursRange[1]);
   		
   			if($dateToEvaluate->getTimestamp()>=$startAt->getTimestamp() && $dateToEvaluate->getTimestamp()<=$endAt->getTimestamp() ){
   				return $isInPicoPlaca=true;

   			}

   		}
		
   	}

   	return $isInPicoPlaca;

   }
   //creates a formatted response to display the prediction 
   public function setPredictionText($predictionValue){
   		return "The car can ".($predictionValue?"not ":"")." be on road";
   	}

}
