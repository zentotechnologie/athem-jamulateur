<?php 
if( isset($_POST['type']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	$name=$_POST['type'];
	$name_en=$_POST['type_en'];

	$db->exec("INSERT INTO `types` (`name`, `name_en`, `deleted`) VALUES ('$name', '$name_en',  0); ");

	header('location:./types.php');
endif;
?>