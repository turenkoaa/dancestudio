<?php

$idStyle = $_REQUEST['style'];
$typeOfTrain = $_REQUEST['typeOfTrain'];
$idStaff = $_REQUEST['coach'];
$durationMinutes = $_REQUEST['durationMinutes'];

include 'conn.php';



$sql = "insert into
Trainings (typeOfTrain, idStyle, durationMinutes, idCoach) value
('$typeOfTrain', '$idStyle', '$durationMinutes', '$idStaff')";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=> $idStyle.' '.$typeOfTrain.' '.$idStaff.' '.$durationMinutes));
}

?>