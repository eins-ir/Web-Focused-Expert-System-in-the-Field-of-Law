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

if ($inputs['answerer_flag']=="yes"){
	if ($length>0){
         header("Location: formHTMLusually_mistake.html");
	}
	else{
	$document = "../documents/er.html";
	$document2 = "../documents/er2.html";
	}
}
else{
	if ($length>2){
         header("Location: formHTMLusually_mistake.html");
	}
	else{
	$document = "../documents/er12.html";
	$document2 = "../documents/er22.html";
	}
} 
$marks=array("{court}", "{plaintiff}","{requisites}","{phone}","{e-mail}");

$file = file_get_contents($document, true);
$newfile = str_replace($marks,$inputs,$file);
$newfile = str_replace("{answerer}",$inputs['answerer'],$newfile);
$newfile = str_replace("{statement}",$inputs['statement'],$newfile);
$newfile = str_replace("{text}",str_replace("\n", '<br/>',$inputs['text']),$newfile);
$newfile = str_replace("{beg}",str_replace("\n", '<br/>',$inputs['beg']),$newfile);
$newfile = str_replace("{apps}",str_replace("\n", '<br/>',$inputs['apps']),$newfile);

$today = date("d.m.y"); 
$newfile = str_replace("{data}",$today,$newfile);
$name = $inputs['plaintiff'];
$newname = NewName($name);
$newfile = str_replace("{lastname}",$newname,$newfile);
echo $newfile;
$f=fopen($document2,'w+');
fwrite($f,$newfile);

?>