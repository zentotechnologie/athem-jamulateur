<?php 
require_once '../configdb.php';
$id=$_POST['id'];
$result = $db->exec("DELETE from fleursusers where id=$id");

echo $result;
?>