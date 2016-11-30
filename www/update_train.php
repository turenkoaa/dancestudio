<?php

$id = intval($_REQUEST['id']);
$idStyle = $_REQUEST['style'];
$typeOfTrain = $_REQUEST['typeOfTrain'];
$idStaff = $_REQUEST['coach'];
$durationMinutes = $_REQUEST['durationMinutes'];

include 'conn.php';

$sql = "update trainings set idStyle='$idStyle',typeOfTrain='$typeOfTrain',idCoach='$idStaff',durationMinutes='$durationMinutes' where idTrain=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Возможно, такая тренировка уже есть.'));
}
?>