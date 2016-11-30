<?php

$id = intval($_REQUEST['id']);
$week = $_REQUEST['dayOfWeek'];
$time = $_REQUEST['time'];
$train = $_REQUEST['train'];
$gum = $_REQUEST['numberOfGum'];

include 'conn.php';

$sql = "update timetable set dayOfWeek='$week',idTime='$time',idTrain='$train',numberOfGum='gum' where idTimetable=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Это время занято.'.$id));
}
?>