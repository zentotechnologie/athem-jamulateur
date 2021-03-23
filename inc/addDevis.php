<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'functions.php'; 
if(isset($_POST)):
	extract($_POST); 

	$db = db_connect();

	$time_stamp = time();

	$dateDebut 	= strtotime( $dateDebut );
	$dateFin 	= strtotime( $dateFin );
 

	$query = $db->query(" INSERT INTO `devis` (

	 	`type`, 
	 	`lieu`, 
	 	`rueEvent`, 
	 	`cpEvent`, 
	 	`villeEvent`,
	 	`paysEvent`,
	 	`distance`,
	 	`largeur`, 
	 	`hauteur`, 
	 	`dateDebut`, 
	 	`dateFin`, 
	 	`visuel`, 
	 	`nbrBoucles`, 
	 	`son`, 
	 	`options`, 

	 	`video_jamions`, 
	 	`video_techniciens`, 
	 	`video_hebergement`, 
	 	`video_transport`, 
	 	`sonorisation_unite`, 
	 	`sonorisation_techniciens`, 
	 	`sonorisation_hebergement`, 
	 	`sonorisation_transport`, 
	 	`sonorisation_taxe_sacem`, 
	 	`autre_gardinnage`, 
	 	`remise_montant`, 
	 	`remise_pourcentage`, 
	 	`remise_label`, 

	 	`email`, 
	 	`tel`, 
	 	`societe`, 
	 	`fname`, 
	 	`lname`, 
	 	`address1`, 
	 	`address2`,  
	 	`cp`,
	 	`ville`,
	 	`pays`,
	 	`dateDevis`) 

	 	VALUES (
  
	 	'$type', 
	 	'$lieu', 
	 	'$rueEvent', 
	 	'$cpEvent',
	 	'$villeEvent', 
	 	'$paysEvent', 
	 	'$distance', 
	 	'$largeur', 
	 	'$hauteur', 
	 	'$dateDebut', 
	 	'$dateFin', 
	 	'$visuel', 
	 	'$nbrBoucles', 
	 	'$son', 
	 	'$options',
	 	 
	 	'$video_jamions', 
	 	'$video_techniciens', 
	 	'$video_hebergement', 
	 	'$video_transport', 
	 	'$sonorisation_unite', 
	 	'$sonorisation_techniciens', 
	 	'$sonorisation_hebergement', 
	 	'$sonorisation_transport', 
	 	'$sonorisation_taxe_sacem', 
	 	'$autre_gardinnage', 
	 	'$remise_montant', 
	 	'$remise_pourcentage', 
	 	'$remise_label', 
	 	
	 	'$email', 
	 	'$tel', 
	 	'$societe', 
	 	'$fname', 
	 	'$lname', 
	 	'$address1', 
	 	'$address2',  
	 	'$cp', 
	 	'$ville', 
	 	'$pays', 
	 	'$time_stamp' )"
	);

	if( $query ){

		$idDevis = $db->lastInsertId();  
		
		if( count($_FILES) > 0 ){
			uploadFiles( $idDevis, $_FILES, '../admin/uploads/' );
		}

		
		$result = generatePDFDevis( $idDevis );
		extract($result);
		include 'generatePdfDevis.php';
		$output = $dompdf->output(); 

		file_put_contents( $infos['addAttachment'], $output );  

		include '../libraries/PHPMailer/PHPMailerAutoload.php';
		// if( sendEmailToCLient( array("email"=>$infos['email'], "addAttachment"=> $infos['addAttachment']) )  &&  sendEmailToAdmin( array("addAttachment"=> $infos['addAttachment'] ) ) ){
		if( sendEmailToCLient( array("email"=>$infos['email'], "addAttachment"=> $infos['addAttachment']) )  ){
			if(file_exists($infos['addAttachment'])){
				unlink($infos['addAttachment']);
			}
		}else{
			if(file_exists($infos['addAttachment'])){
				unlink($infos['addAttachment']);
			}
		}  

		echo $idDevis;
	}else{
		echo 0;
	} 

 
endif;
?>