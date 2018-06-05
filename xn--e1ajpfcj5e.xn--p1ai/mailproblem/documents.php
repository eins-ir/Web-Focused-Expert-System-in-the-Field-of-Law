<?php
	header('Content-type: text/html; charset=utf-8');
	header('Content-Type: application/msword');
	header("Content-Disposition: attachment; filename=mailproblem.doc;");
	header("Content-Transfer-Encoding: binary");
	
	$inputs=$_POST;
	$length=0;
	
	$date = $inputs['date'];
	$today = date("Y-m-d");

	foreach ($inputs as $in){
		if ($in=="") $length++;
	}
	
	if( $date > $today)
	{
		header("Location: Error.html");
		echo "ошибка";
	}
	else{
		$document = 'doc1.html';
		$document2 = 'doc2.html';
	}
	
	$marks=array("{data}", "{operator}","{Identificator}");
	$file = file_get_contents($document, true);
	$newfile = str_replace($marks,$inputs,$file);
	echo $newfile;
	$f=fopen($document2,'w+');
	fwrite($f,$newfile);
?>