<?php require_once '../configdb.php'; 
	
	$q = $db->prepare("TRUNCATE TABLE fleursusers");
	$q->execute();  
 

	header("location:home.php");
?>