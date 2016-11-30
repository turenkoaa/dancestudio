<?php

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

$sql = "insert into 
staff (surnameSt, nameSt, middlenameSt, dateOfBirthSt, genderSt, phoneSt,emailSt,passportSt,post) value ('$surname','$name','$middleName','$dateOfBirth','$gender','$phoneNum','$email','$passport','$post')";
$result = @mysql_query($sql);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Введите корректную информацию.'));
}
?>