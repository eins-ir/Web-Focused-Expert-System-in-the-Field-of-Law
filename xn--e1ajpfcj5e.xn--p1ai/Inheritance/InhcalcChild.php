<?php
error_reporting(0);

function clearData($data, $type='i'){
	switch($type){
		case 'i': return $data*1; break;
		case 's': return trim(strip_tags($data)); break;
	}
}

$child_per = 0;
$msgErrC = 'n';

if(!empty($_POST)){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$per = clearData($_POST['per']);
		$hchild = clearData($_POST['hchild']);
		}
		
		//расчет доли в наследстве для детей наследника:
		try{
		if($hchild < 1)
			$msgErrC = "Количество детей должно быть больше одного и целым числом";
		elseif(gettype($hchild)!='integer')
			$msgErrC = "Количество детей должно быть целым числом";
		elseif($per>1 || $per<=0)
			$msgErrC = "Доля в наследстве у погибшего наследника должна быть больше 0 и меньше или равна 1";
		elseif($hchild == 1)
			$msgErrC = "Единственный ребенок получает всю долю погибшего наследника";
		elseif(is_int($hchild))
			$child_per = $per / $hchild;
		}
		catch (Exception $e){
			$msgErrC = "Входные данные должны быть целыми числами больше нуля!";
		}

		if($child_per>1 || $child_per<0)
			$msgErrC = "Ошибка рассчета данных. Проверьте введенные данные.";
}

require_once('inheritancePage.html');

?>