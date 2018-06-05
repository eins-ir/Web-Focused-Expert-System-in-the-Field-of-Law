<?php
	header('Content-type: text/html; charset=utf-8');
	header('Content-Type: application/msword');
	header("Content-Disposition: attachment; filename=phoneproblem.doc;");
	header("Content-Transfer-Encoding: binary");
	
	$inputs=$_POST;
	$length=0;
	
	foreach ($inputs as $in){
		if ($in=="") $length++;
	}
	if ($length>1){
		header("Location: Error.html");
	}
	else{
		$document = 'doc12.html';
		$document2 = 'doc2.html';
	}

	$marks=array("{operator}","{number}","{from}","{to}","{cash}");
	$file = file_get_contents($document, true);
	$newfile = str_replace($marks,$inputs,$file);
	echo $newfile;
	$f=fopen($document2,'w+');
	fwrite($f,$newfile);
?>