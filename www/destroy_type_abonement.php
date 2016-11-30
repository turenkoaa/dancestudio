<?php

$idAbonement = intval($_REQUEST['id']);

include 'conn.php';

$sql = "delete from abonement where idAbonement=$idAbonement";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success'=>true));
}
?>