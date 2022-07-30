<?php

include_once("databases/dbconnections.php");

$result=array();

$start=isset($_GET['start']) ? intval($_GET['start']) : 0;
	$items=$conn->query("SELECT * FROM `post` where `post_id` > " . $start);

	while ($row = $items->fetch_assoc()) {
		$result['items'][]=$row;
	}

	$conn->close();

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");

	echo json_encode($result);


?>