<?php

$nameAb = $_REQUEST['nameAb'];
$typeOfTrainings = $_REQUEST['typeOfTrainings'];
$priceAb = $_REQUEST['priceAb'];
$numOfTrainings = $_REQUEST['numOfTrainings'];
$numActiveDays = $_REQUEST['numActiveDays'];
$sale = $_REQUEST['sale'];

include 'conn.php';

$sql = "insert into
abonement (nameAb, typeOfTrainings, numOfTrainings, numActiveDays, priceAb, sale) value
('$nameAb', '$typeOfTrainings', '$numOfTrainings', '$numActiveDays', '$priceAb', '$sale')";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array(
        'idAbonement' => mysql_insert_id(),
        'typeOfTrainings' => $typeOfTrainings,
        'priceAb' => $priceAb,
        'numOfTrainings' => $numOfTrainings,
        'numActiveDays' => $numActiveDays,
        'nameAb' => $nameAb,
        'sale' => $sale
    ));
}

?>