<?php

    include 'conn.php';
	
	$rs = mysql_query("select idAbonement, nameAb from abonement");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);

?>