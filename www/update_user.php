<?php

$id = intval($_REQUEST['id']);
$surname = $_REQUEST['surnameCl'];
$name = $_REQUEST['nameCl'];
$middleName = $_REQUEST['middleNameCl'];
$dateOfBirth = $_REQUEST['dateOfBirthCl'];
$gender = $_REQUEST['genderCl'];
$phoneNum = $_REQUEST['phoneCl'];
$email = $_REQUEST['emailCl'];

include 'conn.php';

$sql = "update Clients set surnameCl='$surname',nameCl='$name',middleNameCl='$middleName',dateOfBirthCl='$dateOfBirth',genderCl='$gender', phoneCl='$phoneNum',emailCl='$email' where idClient=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Ошибка: ' . mysql_error()));
}
?>