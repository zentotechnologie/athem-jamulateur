<?php 
if( isset($_POST['type']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	$name=$_POST['type'];

	$db->exec("INSERT INTO `types` (`name`, `deleted`) VALUES ('$name', 0); ");

	header('location:./types.php');
endif;
?>