<?php 
if( isset($_POST['id']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	$id=$_POST['id'];
	$result = $db->exec("UPDATE devis set deleted = 1 where idDevis=$id");

	echo $result;
endif;
?>