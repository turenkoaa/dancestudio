<?php
    
    include 'conn.php';
	
	$rs = mysql_query("select idTimetable, concat(dayOfWeek, ' ', TIME_FORMAT(start, '%H:%i'), ': ',style.nameSt, ' (', typeOfTrain, ') - ',surnameSt, ' ' , staff.nameSt, ', ', 'зал: ', numberOfGum) as train from style, staff, timetable, trainings, timeoftrain
where style.idStyle = trainings.idStyle
and trainings.idTrain = timetable.idTrain
and staff.idStaff = trainings.idCoach
and timetable.idTime = timeoftrain.idTime
order by numberOfGum, dayOfWeek, start");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}


	echo json_encode($items);
?>