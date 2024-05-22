<?php
$duration =60;

$time2 = date("H:i:s",strtotime("$_SESSION[duration] minutes"));

echo $time2;

?>