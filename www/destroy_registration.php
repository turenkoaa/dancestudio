<?php

    $ss = $_POST['ss'];

    include 'conn.php';

    $sql = "delete from Registerings where idRegisterings in (".$ss.")";
    $result = @mysql_query($sql);
    if ($result){
        echo json_encode(array('success'=>true));
    } else {
        echo json_encode(array('msg'=>'There is error.'));
    }

?>