<?php
   
    $dateReg = $_REQUEST['dateReg'];
    
    include 'conn.php';

    //$today = date('Y-m-d');
	
    $rs = mysql_query("select idRegisterings, concat (surnameCl, ' ', nameCl) as client, style.nameSt, isVisit, start, numberOfGum, dayOfWeek, dateReg from Registerings, style, clients, trainings, abonementofclient, timetable, timeoftrain
where abonementofclient.idAbonementOfClient = registerings.idAbonement
and abonementofclient.idClient = clients.idClient
and registerings.idTimetable = timetable.idTimetable
and timetable.idTrain = trainings.idTrain
and trainings.idStyle = style.idStyle
and timetable.idTime = timeoftrain.idTime
and dateReg = '$dateReg' order by start asc");

	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	echo json_encode($items);
?>