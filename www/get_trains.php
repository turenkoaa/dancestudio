<?php
    
    include 'conn.php';
	
	$rs = mysql_query("select idTrain, concat(surnameSt, ' ', staff.nameSt) as coachName, style.nameSt, durationMinutes, typeOfTrain from staff, trainings, style 
where post='тренер'
and trainings.idCoach=staff.idStaff
and style.idStyle = trainings.idStyle");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}


	echo json_encode($items);
?>