<?php
require_once "config.php";
	$data =  $_GET['data'];
	$id = $data[0];
	$item_id = $data[1];

	mysqli_query($link, "DELETE FROM request WHERE id=".$id);
	mysqli_query($link, "UPDATE items SET is_broken = 0 WHERE id=".$item_id);
	header('location: myactivity.php');


// Redirect to login page
mysqli_close($link);
exit;
?>