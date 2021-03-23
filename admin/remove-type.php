<?php 
if( isset($_POST['id']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	$id=$_POST['id'];
	$result = $db->exec("UPDATE types set deleted = 1 where idType=$id");

	echo $result;
endif;
?>