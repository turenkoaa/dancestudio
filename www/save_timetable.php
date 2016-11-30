<?php

$week = $_REQUEST['dayOfWeek'];
$time = $_REQUEST['time'];
$train = $_REQUEST['train'];
$gum = $_REQUEST['numberOfGum'];

include 'conn.php';

$sql = "insert into 
timetable (dayOfWeek, idTime, idTrain, numberOfGum) value ('$week','$time','$train','$gum')";
$result = @mysql_query($sql);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Это время занято.'));
}
?>