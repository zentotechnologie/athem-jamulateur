<?php 
if( isset($_POST['type']) ):
	require_once '../inc/functions.php';
	$db = db_connect();
	
	 
	$tab = $_POST['tab'];
	unset($_POST['tab']);
		 
	switch ( $_POST['type'] ) {
		case 'JamMobile':
			unset($_POST['type']); 
			
			foreach ($_POST['price'] as $key => $value) {
				$query = $db->prepare("UPDATE jamionsPrices SET jam_1 = :jam_1, jam_2 = :jam_2, jam_3 = :jam_3 WHERE id = :id ");
				
				$query->bindParam(":id", $key);
				$query->bindParam(":jam_1", $value['jam_1']);
				$query->bindParam(":jam_2", $value['jam_2']);
				$query->bindParam(":jam_3", $value['jam_3']);
				$query->execute();
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
				$query = $db->prepare("UPDATE visuel SET price = '$price' , name = ?, name_en = ?, description = ?, description_en = ? WHERE idVisuel = $idVisuel");
				$query->execute( array($name, $name_en, $description, $description_en) );
			}
			break;

		case 'son':
			unset($_POST['type']); 
			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE son SET price = '$price' , name = ?, name_en = ?, description = ?, description_en = ? WHERE idSon = $idSon");
				$query->execute( array($name, $name_en, $description, $description_en) );
			}
			break;

		case 'options':
			unset($_POST['type']); 

			foreach ($_POST['fields'] as $key => $field) {
				extract($field); 
				$query = $db->prepare("UPDATE options SET price = :price , name = :name,  name_en = :name_en, description =:description, description_en =:description_en WHERE idOption = $id");
				$query->bindParam(":price", $price);
				$query->bindParam(":name", $name);
				$query->bindParam(":name_en", $name_en);
				$query->bindParam(":description", $description);
				$query->bindParam(":description_en", $description_en);
				$query->execute();
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