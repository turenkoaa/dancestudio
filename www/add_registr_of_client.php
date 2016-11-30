<?php

    $surname = $_REQUEST['surname'];
    $name = $_REQUEST['name'];
    $middleName = $_REQUEST['middleName'];
    $abonement = $_REQUEST['abonement'];
    //$timeoftrain = $_REQUEST['timeoftrain'];
    $idTimetable = $_REQUEST['train'];
    $date = $_REQUEST['date'];
    $phone = $_REQUEST['phone'];

    include 'conn.php';

mysql_query("SET AUTOCOMMIT=0");
mysql_query("START TRANSACTION");

    $rs = mysql_query("select dayOfWeek from timetable where idTimetable='$idTimetable'");
    $row = mysql_fetch_row($rs);
    $dayOfWeek = $row[0];

if($dayOfWeek == strftime("%a", strtotime($date)))
{
    $client_rs = mysql_query("select idClient from clients where surnameCl = '$surname' and nameCl = '$name'and middleNameCl like '$middleName%' and phoneCl like '$phone%'");
    $row = mysql_fetch_row($client_rs);
    $idClient = $row[0];
    
    $abonement_rs = mysql_query("select idAbonementOfClient from AbonementOfClient where idClient = '$idClient' and idAbonement = '$abonement'");
    $row = mysql_fetch_row($abonement_rs);
    $idAbonement = $row[0];

   /* $rs = mysql_query("select idTime from TimeOfTrain where start = '$start'");
    $row = mysql_fetch_row($rs);
    $idTime = $row[0];

    $rs = mysql_query("select idTimetable from timetable where idTime = '$idTime' and numberOfGum='1', idTrain='$train', dayOfWeek='strftime("%a", strtotime('$date'')');
    $row = mysql_fetch_row($rs);
    $idTimetable = $row[0];
    */


    $sql = "insert into Registerings (dateReg, isVisit, idTimetable, idAbonement) value
    ('$date', 'нет', '$idTimetable', '$idAbonement')";
    $result = @mysql_query($sql);

    if ($result and $client_rs and $abonement_rs and $rs){
        mysql_query("COMMIT");
        echo json_encode(array('success'=>true));
    } else {
        mysql_query("ROLLBACK");
        echo json_encode(array('msg'=>$date.', '.$idTimetable.', '.$idAbonement.' '.'Возможно, клиента с таким активным абонемнтом нет. Или он уже записан на эту тренировку.'));
    }
}else {
        echo json_encode(array('msg'=>'Дни недели не совпадают.'));
    }
?>