<?php

$surname = $_REQUEST['surname'];
$name = $_REQUEST['name'];
$middleName = $_REQUEST['middleName'];
$abonement = $_REQUEST['abonement'];
$ispaid = $_REQUEST['ispaid'];
$amount = $_REQUEST['amount'];
$date = $_REQUEST['date'];
$phone = $_REQUEST['phone'];

include 'conn.php';

$rs = mysql_query("select * from clients where surnameCl = '$surname' and nameCl = '$name'and middleNameCl like '$middleName%' and phoneCl like '$phone%'");
$row = mysql_fetch_row($rs);
$id = $row[0];

$sql = "insert into
AbonementOfClient (idClient,idAbonement,firstDate,statusAb,countOfTrains,isPaid,amountPay) value
('$id', '$abonement', '$date', 'активен', '0', '$ispaid','0')";
$result = @mysql_query($sql);

if ($result){
    echo json_encode(array('success'=>true));
} else {
    echo json_encode(array('msg'=>'Возможно, клиента нет в базе, клиентов с таким именем несколько(введите полную информацию), у этого клиента уже есть такой абонемент.'));
}

?>
