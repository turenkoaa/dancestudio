<?php
    
    include 'conn.php';
	
	$rs = mysql_query("select idTime, concat(TIME_FORMAT(start, '%H:%i'), ' - ',TIME_FORMAT(end, '%H:%i')) as time
from timeoftrain
order by start");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);
?>