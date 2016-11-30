<?php

$surname = $_REQUEST['surnameCl'];
$name = $_REQUEST['nameCl'];
$middleName = $_REQUEST['middleNameCl'];
$dateOfBirth = $_REQUEST['dateOfBirthCl'];
$gender = $_REQUEST['genderCl'];
$phoneNum = $_REQUEST['phoneCl'];
$email = $_REQUEST['emailCl'];

include 'conn.php';

$sql = "insert into 
clients (surnameCl, nameCl, middlenameCl, dateOfBirthCl, genderCl, phoneCl,emailCl) value ('$surname','$name','$middleName','$dateOfBirth','$gender','$phoneNum','$email')";
$result = @mysql_query($sql);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Введите корректную информацию.'));
}
?>