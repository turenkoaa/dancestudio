<?php

$id = intval($_REQUEST['id']);
$surname = $_REQUEST['surnameSt'];
$name = $_REQUEST['nameSt'];
$middleName = $_REQUEST['middleNameSt'];
$dateOfBirth = $_REQUEST['dateOfBirthSt'];
$gender = $_REQUEST['genderSt'];
$phoneNum = $_REQUEST['phoneSt'];
$email = $_REQUEST['emailSt'];
$passport = $_REQUEST['passportSt'];
$post = $_REQUEST['post'];

include 'conn.php';

$sql = "update staff set surnameSt='$surname',nameSt='$name',middleNameSt='$middleName',dateOfBirthSt='$dateOfBirth',genderSt='$gender', phoneSt='$phoneNum',emailSt='$email',passportSt='$passport',post='$post' where idStaff=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Ошибка: ' . mysql_error()));
}
?>