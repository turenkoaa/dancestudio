<?php


	//$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	//$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	//$offset = ($page-1)*$rows;

	//$result = array();

	include 'conn.php';
	
	//$rs = mysql_query("select count(*) from Clients where $where");
	//$row = mysql_fetch_row($rs);
	//$result["total"] = $row[0];
	$rs = mysql_query("select idTimetable, dayOfWeek, concat(TIME_FORMAT(timeoftrain.start, '%H:%i'), ' - ',TIME_FORMAT(timeoftrain.end, '%H:%i')) as time,
concat(style.nameSt, ' (', typeOfTrain, ') - ',surnameSt, ' ' , staff.nameSt) as train, numberOfGum
from timetable, timeoftrain, trainings, staff, style
where timetable.idTime = timeoftrain.idTime
and timetable.idTrain = trainings.idTrain
and trainings.idCoach=staff.idStaff
and trainings.idStyle = style.idStyle
order by numberOfGum, start
	");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	//$result["rows"] = $items;

	echo json_encode($items);

?>