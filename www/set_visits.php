<?php
    
    $ss = $_POST['ss'];

    include 'conn.php';

mysql_query("SET AUTOCOMMIT=0");
mysql_query("START TRANSACTION");

    $sql = "update registerings set isVisit='да' where idRegisterings in (".$ss.")";
    $result1 = @mysql_query($sql);

    $rs = @mysql_query("select idAbonement from registerings where idRegisterings in ($ss)");
    $row = mysql_fetch_row($rs);
    $idAbonement = implode(", ", $row);
    $result2 = @mysql_query("update abonementofclient set countOfTrains= countOfTrains+1 where idAbonementOfClient in ($idAbonement)");

    if ($result1 and $result2){
        mysql_query("COMMIT");
        echo json_encode(array('success'=>true));
    } else {
        mysql_query("ROLLBACK");
        echo json_encode(array('msg'=>'There is error.'));
    }
    
?>  