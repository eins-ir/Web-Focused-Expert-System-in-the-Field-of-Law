<?php
error_reporting(0);

function clearData($data, $type='i'){
	switch($type){
		case 'i': return $data*1; break;
		case 's': return trim(strip_tags($data)); break;
	}
}

$percentage_spouse = 0;
$percentage = 0;
$flag=TRUE;

if(!empty($_POST)){
	$msgErr = 'n';
	$msgErrSpouse = 'n';
	$spouse = 0;
	$spouseflag = 0;
	$per_s = 0;
	$spouseN = 0;
	
	try{
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$heirs = clearData($_POST['heirs']);
		$undignified = clearData($_POST['undignified']);
		$dependant = clearData($_POST['dependant']);
		$queue = clearData($_POST['queue']);
		$spouse = clearData($_POST['spouse']);
		$spouseflag = clearData($_POST['spouseflag']);
		$per_s = clearData($_POST['per_s']);
		$spouseN = clearData($_POST['spouseN']);
	
		if($spouse==0 && $spouseflag==1){
			$msgErr = "Ошибка! Если супруга нет, то доля для супруга не рассчитывается";
		}
		elseif($spouseN==1 && $spouseflag==1){
			$msgErr = "Ошибка! Если супруг является недостойным наследником, то доля для супруга не рассчитывается";
		}
		elseif($queue>1 && $spouse==1){
			$msgErr = "Ошибка! Если супруг жив, то очередь наследства должна быть первая";
			$msgErrSpouse = "";
		}
		elseif(gettype($heirs)!='integer'){
			$msgErr = "Ошибка ввода данных в поле Количество наследников";
			$msgErrSpouse = "";
		}
		elseif(gettype($undignified)!='integer'){
			$msgErr = "Ошибка ввода данных в поле Количество недостойных наследников";
			$msgErrSpouse = "";
		}
		elseif(gettype($dependant)!='integer'){
			$msgErr = "Ошибка ввода данных в поле Количество иждивенцев";
		}
		elseif($heirs < $undignified){
			$msgErr = "Введите корректные данные. Общее количество наследников не должно быть меньше, чем количество недостойных наследников.";
			$msgErrSpouse = "";
			$flag=FALSE;
		}
		elseif($spouseN==1 && $undignified==0){
			$msgErr = "Если супруг является недостойным наследником, то количество недостойных наследников должно быть 1 или более";
		}
		else {
			// расчет количества наследников: кол-во наследников - недостойные
			$true_heir = $heirs - $undignified;
	
			//доля супруга:
			if($spouse==1)
				$spouseI=0.5;
	
			//расчет доли в наследстве: (наследство - половина наследства в браке)/(наследники + иждивенцы)
			if($spouseN==1)
				$percentage = (1.0)/($true_heir + $dependant);
			if($spouseN==0)
				$percentage = (1.0 - $spouseI)/($true_heir + $dependant);
	
			//если супруг, то 
			if($percentage && $spouseN==0){
				if($flag==TRUE || $spouseI==0.5)
					$percentage_spouse = $spouseI + $percentage;
				else 
					$percentage_spouse = 0.0;
			}
		}
	}
	}
	catch (Exception $e){
		$msgErr = "Входные данные должны быть целыми числами больше нуля!";
	}
	
	if(!$percentage) {
		$flag=FALSE;
	}
	
	if($percentage==1)
		$msgErr = "Доля в наследстве равна 100%";
	
	if($percentage_spouse==1)
		$msgErrSpouse = "Доля в наследстве супруга равна 100%";

	if($percentage_spouse){
		if($per_s==3){
			if((($percentage==0) || (($heirs + $dependant - $undignified) == 0)) && ($flag==TRUE) && ($spouseI==0.5) && ($queue==1) && ($spouseN==0))
				$msgErrSpouse = "Доля в наследстве супруга равна 0.5% от всего наследства, нажитого в браке.";
			else if($heirs < $undignified || ($queue>1) || $flag==FALSE || $spouseI==0)
				$msgErrSpouse = "";
		}
		elseif($per_s!=3)
			$percentage_spouse = $percentage;
	}
	}
}
require_once('inheritancePage.html');

?>





