<?php
header('Content-type: text/html; charset=utf-8');
$array = array("пропуск срока принятия наследства", "наследство","сроки наследства","пропуск наследства","пропуск принятия наследства","вступление в наследство","пропуск вступления в наследство","пропуск сроков вступления в наследство");
$input = $_POST;
$input_str = implode($input_str,$input);
$input_str = mb_strtolower($input_str, 'utf-8');
if (in_array($input_str,$array))
	 header( "Location: forms/lawsuit2.html");
else header( "Location: forms/formHTMLusually.html");
	 

?>