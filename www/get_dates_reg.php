<?php
    
    include 'conn.php';

    //$today = date('Y-m-d');
	
     $rs = mysql_query("select dateReg from registerings group by dateReg");

	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);
?>