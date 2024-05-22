<?php 

session_start();

$questionNo = $_GET["questionNumber"];
$value1 = $_GET["value1"];
$_SESSION["answer"][$questionNo]=$value1;

?>