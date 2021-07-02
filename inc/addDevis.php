<?php 
require 'functions.php'; 
if(isset($_POST)):
	extract($_POST); 

	$db = db_connect();

	$time_stamp = time();

	$dateDebut 	= strtotime( $dateDebut );
	$dateFin 	= strtotime( $dateFin );
 

	$query = $db->prepare(" INSERT INTO `devis` (

	 	`type`, 
	 	`lieu`, 
	 	`rueEvent`, 
	 	`cpEvent`, 
	 	`villeEvent`,
	 	`idf`,
	 	`paysEvent`,
	 	`distance`,
	 	`domaine`,
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
	 	`dateDevis`,
	 	`lang`) 

	 	VALUES ( 
	 	:type, 
	 	:lieu, 
	 	:rueEvent, 
	 	:cpEvent,
	 	:villeEvent, 
	 	:idf, 
	 	:paysEvent, 
	 	:distance,
	 	:domaine,
	 	:largeur, 
	 	:hauteur, 
	 	:dateDebut, 
	 	:dateFin, 
	 	:visuel, 
	 	:nbrBoucles, 
	 	:son, 
	 	:options,
	 	 
	 	:video_jamions, 
	 	:video_techniciens, 
	 	:video_hebergement, 
	 	:video_transport, 
	 	:sonorisation_unite, 
	 	:sonorisation_techniciens, 
	 	:sonorisation_hebergement, 
	 	:sonorisation_transport, 
	 	:sonorisation_taxe_sacem, 
	 	:autre_gardinnage,  
	 	
	 	:email, 
	 	:tel, 
	 	:societe, 
	 	:fname, 
	 	:lname, 
	 	:address1, 
	 	:address2,  
	 	:cp, 
	 	:ville, 
	 	:pays, 
	 	:time_stamp, 
	 	:lang )"
	);

	$exec = $query->execute(array(
		':type' => $type,
	 	':lieu' => $lieu, 
	 	':rueEvent' => $rueEvent, 
	 	':cpEvent' => $cpEvent,
	 	':villeEvent' => $villeEvent, 
	 	':idf' => $idf, 
	 	':paysEvent' => $paysEvent, 
	 	':distance' => $distance,
	 	':domaine' => $domaine,
	 	':largeur' => $largeur, 
	 	':hauteur' => $hauteur, 
	 	':dateDebut' => $dateDebut, 
	 	':dateFin' => $dateFin, 
	 	':visuel' => $visuel, 
	 	':nbrBoucles' => $nbrBoucles, 
	 	':son' => $son, 
	 	':options' => $options,
	 	 
	 	':video_jamions' => $video_jamions, 
	 	':video_techniciens' => $video_techniciens, 
	 	':video_hebergement' => $video_hebergement, 
	 	':video_transport' => $video_transport, 
	 	':sonorisation_unite' => $sonorisation_unite, 
	 	':sonorisation_techniciens' => $sonorisation_techniciens, 
	 	':sonorisation_hebergement' => $sonorisation_hebergement, 
	 	':sonorisation_transport' => $sonorisation_transport, 
	 	':sonorisation_taxe_sacem' => $sonorisation_taxe_sacem, 
	 	':autre_gardinnage' => $autre_gardinnage,  
	 	
	 	':email' => $email, 
	 	':tel' => $tel, 
	 	':societe' => $societe, 
	 	':fname' => $fname, 
	 	':lname' => $lname, 
	 	':address1' => $address1, 
	 	':address2' => $address2,  
	 	':cp' => $cp, 
	 	':ville' => $ville, 
	 	':pays' => $pays, 
	 	':time_stamp' => $time_stamp, 
	 	':lang' => $lang
	));

	if( $query ){

		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);

		$idDevis = $db->lastInsertId();  
		
		$attachments = array();

		if( count($_FILES) > 0 ){
			$attachments = uploadFiles( $idDevis, $_FILES, '../admin/uploads/' );
		}

		
		$result = generatePDFDevis( $idDevis );
		extract($result);
		include 'generatePdfDevis.php';
		$output = $dompdf->output(); 

		file_put_contents( $infos['addAttachment'], $output );
		$attachments[] = $infos['addAttachment'];

		include '../libraries/PHPMailer/PHPMailerAutoload.php';
		
		// if( sendEmailToCLient( array("email"=>$infos['email'], "addAttachment"=> $infos['addAttachment']) )  &&  sendEmailToAdmin( array("addAttachment"=> $infos['addAttachment'] ) ) ){

		if( sendEmailToCLient( array("email"=>$infos['email'], "attachments"=> $attachments) )  ){
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