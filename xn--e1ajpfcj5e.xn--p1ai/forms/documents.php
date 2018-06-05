$newfile = str_replace("{text}",str_replace("\n", '<br/>',$inputs['text']),$newfile);
<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/msword');
header("Content-Disposition: attachment; filename=filename.doc;");
header("Content-Transfer-Encoding: binary");
$inputs=$_POST;
$length=0;
foreach ($inputs as $in){
	if ($in=="")
		$length++;
}
if ($inputs['phone']=="")
	$length--;
if ($inputs['e-mail']=="")
	$length--;
if ($_POST['measure']=='yes'){
	if ($length>1){
         header("Location: formHTMLusually_mistake.html");
	}
	else{
		if ($_POST['inheritance']=='under the will'){
			$document = '../documents/MIZ_Vosstanovlenie_srokov (1)12.html';
			$document2 = '../documents/MIZ_Vosstanovlenie_srokov (1)22.html';
		}
		else if ($_POST['inheritance']=='according to law'){
			$document = '../documents/Vosstanovlenie_srokov_po_zakony12.html';
			$document2 = '../documents/Vosstanovlenie_srokov_po_zakony22.html';
		}
		else header("Location: formHTMLusually_mistake.html");
	}
}
else {
	if ($length>2){
         header("Location: formHTMLusually_mistake.html");
	}
	else{
		if ($_POST['inheritance']=='under the will'){
			$document = '../documents/MIZ_Vosstanovlenie_srokov (1).html';
			$document2 = '../documents/MIZ_Vosstanovlenie_srokov (1)2.html';
		}
		else if ($_POST['inheritance']=='according to law'){
			$document = '../documents/Vosstanovlenie_srokov_po_zakony.html';
			$document2 = '../documents/Vosstanovlenie_srokov_po_zakony2.html';
		}
		else header("Location: formHTMLusually_mistake.html");
	}
}
unset($_POST['inheritance']);

if ($_POST['queue']=="1")
	$article = 1142;
else if ($_POST['queue']=='2')
	$article = 1143;
	else if ($_POST['queue']=='3')
		$article = 1144;
		else
			$article = 1145;
			

function NewName($name){
	$point = ".";
	$pos = strpos($name," ");
	$str0 = substr($name, 0,$pos);
	$str = substr($name, $pos,3);
	$pos = strpos($name," ",$pos+1);
	$str2 = substr($name, $pos,3);
	$newname = $str0.$point.$str.$point.$str2.$point;
	return $newname;
}			

$marks=array("{court}", "{plaintiff}","{requisites}","{phone}","{e-mail}","{testator}","{address_testator}");

$file = file_get_contents($document, true);
//$newfile = str_replace($marks,$inputs,$file);

$newfile = str_replace($marks,$inputs,$file);
$newfile = str_replace("{relatives_out}",$inputs['relatives_out'],$newfile);
$newfile = str_replace("{relatives_in}",$inputs['relatives_in'],$newfile);
$newfile = str_replace("{date_of_death}",$inputs['date_of_death'],$newfile);
$newfile = str_replace("{article}",$article,$newfile);
$newfile = str_replace("{queue}",$inputs['queue'],$newfile);
if ($_POST['measure']=='yes') {
	$n = $_POST['ii'];
	$result="";
	$property = $_POST['property'];

	for($i=0;$i<=$n;$i++){
	$measure = "По отношении ";
	$str_tmp = "";
	$tmp = "";
	if (($property[$i] == 'квартиры') || ($property[$i] == 'земельного участка')){
		$str_tmp = " по адресу ";
		$tmp = $_POST['property2'][$i];
	}
	else if ($property[$i] == 'автомобиля'){
		$str_tmp = " модели ";
		$tmp = $_POST['property2'][$i];
	}
	else if ($property[$i] == 'банковского счета'){
		$str_tmp = ", номер которого ";
		$tmp = $_POST['property2'][$i];
	}
	$measure = $measure.$property[$i].$str_tmp.$tmp." - ";
	$str_tmp = "";
	$tmp = "";
	$input_measure = $_POST['measure_fied'][$i];
	if ($input_measure == 'запрет на совершение определённых действий, в том числе запрет на пользование имуществом'){
		$str_tmp = ". Запрет устанавливается в отношении ";
		$tmp = $_POST['measure2'][$i];
		$measure = $measure.$input_measure.$str_tmp.$tmp.".";
	}
	else if ($input_measure == 'иные меры, если их непринятие может затруднить или сделать невозможным исполнение решения суда'){
		$str_tmp = $_POST['measure3'][$i];
		$measure = $measure.$str_tmp.".";
	}
	else{
		$measure = $measure.$input_measure.".";
	}
	if ($property[$i]!="" && $input_measure!=""){
	$k=$i+1;
	$result = $result.$k.". ".$measure."<br/>";
	}
	}
	$newfile = str_replace("{measures}",$result,$newfile);
}
$apps = $inputs['apps'];
$apps = str_replace("\n", '<br/>',$apps);

$newfile = str_replace("{apps}",$apps,$newfile);
$today = date("d.m.y"); 
$newfile = str_replace("{data}",$today,$newfile);
$name = $inputs['plaintiff'];
$newname = NewName($name);
$newfile = str_replace("{lastname}",$newname,$newfile);
echo $newfile;
$f=fopen($document2,'w+');
fwrite($f,$newfile);

?>