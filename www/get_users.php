<?php


	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
    $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'idClient';
    $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';

	$result = array();
    
    $surname = isset($_POST['surnameCl']) ? mysql_real_escape_string($_POST['surnameCl']) : '';  
    $name = isset($_POST['nameCl']) ? mysql_real_escape_string($_POST['nameCl']) : '';  
  

	include 'conn.php';
	
    $where = "surnameCl like '$surname%' and nameCl like '$name%'";  
	$rs = mysql_query("select count(*) from Clients where $where");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("select * from Clients where $where order by $sort $order limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>