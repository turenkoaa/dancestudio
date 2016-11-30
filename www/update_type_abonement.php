<?php

$id = intval($_REQUEST['idAbonement']);
$nameAb = $_REQUEST['nameAb'];
$typeOfTrainings = $_REQUEST['typeOfTrainings'];
$priceAb = $_REQUEST['priceAb'];
$numOfTrainings = $_REQUEST['numOfTrainings'];
$numActiveDays = $_REQUEST['numActiveDays'];
$sale = $_REQUEST['sale'];

include 'conn.php';

$sql = "update abonement set
nameAb='$nameAb', typeOfTrainings='$typeOfTrainings', numOfTrainings='$numOfTrainings', numActiveDays='$numActiveDays', priceAb='$priceAb', sale='$sale' where idAbonement=$id";
@mysql_query($sql);
echo json_encode(array(
        'idAbonement' => $id,
        'typeOfTrainings' => $typeOfTrainings,
        'priceAb' => $priceAb,
        'numOfTrainings' => $numOfTrainings,
        'numActiveDays' => $numActiveDays,
        'nameAb' => $nameAb,
        'sale' => $sale
));
?>