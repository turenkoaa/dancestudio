<?php
    
    include 'conn.php';
	
	$rs = mysql_query("select idTrain, concat(style.nameSt, ' (', typeOfTrain, ') - ',surnameSt, ' ' , staff.nameSt) as train from style, staff, trainings
where style.idStyle = trainings.idStyle
and staff.idStaff = trainings.idCoach");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);
?>