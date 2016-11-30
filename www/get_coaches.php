<?php
    
    include 'conn.php';
	
	$rs = mysql_query("select idStaff, concat(surnameSt, ' ', staff.nameSt) as coach from staff where post='тренер'");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);
?>