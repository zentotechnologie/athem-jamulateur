<?php 
if( isset($_POST['type']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	
	 
	$tab = $_POST['tab'];
	unset($_POST['tab']);
		 
	switch ( $_POST['type'] ) {
		case 'JamMobile':
			unset($_POST['type']);
			
			foreach ($_POST as $key => $value) {
				$db->exec("UPDATE JamMobile SET TotalPrice = '$value' WHERE idJamMobile = $key");
			}
			break;

		case 'JamSon':
			unset($_POST['type']);
			
			foreach ($_POST as $key => $value) {
				$db->exec("UPDATE JamSon SET price = '$value' WHERE idJamSon = $key");
			}
			break;

		case 'visuel':
			unset($_POST['type']);

			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE visuel SET price = '$price' , name = ?, description = ? WHERE idVisuel = $id");
				$query->execute( array($name, $description) );
			}
			break;

		case 'son':
			unset($_POST['type']);

			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE son SET price = '$price' , name = ?, description = ? WHERE idSon = $id");
				$query->execute( array($name, $description) );
			}
			break;

		case 'options':
			unset($_POST['type']);

			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE options SET price = '$price' , name = '$name', description ='$description' WHERE idOption = $id");
				$query->execute( array($name, $description) );
			}
			break;


		case 'autres':
			unset($_POST['type']); 
			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE autres SET price = '$price'  WHERE id = $id");
				$query->execute( array($price) );
			}
			break;
		 
	}

	header('location:prices.php?tab='.$tab);


endif;
?>