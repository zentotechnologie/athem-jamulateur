<?php   
	function printR($array)
	{
		echo "<pre>";
			print_r($array);
		echo "</pre>";

		die();
	}
	function db_connect(){
		
		$servername = "localhost";
		$username = "jamuser";
		$password = "J@MZTO2o18"; // 
		$dbname = "jamulateur";

		// $servername = "localhost";
		// $username = "root";
		// $password = "root"; // Zento&EI@2017
		// $dbname = "jammulator";

		try {
			    $db = new PDO("mysql:host=$servername;dbname=".$dbname, $username, $password);
			    // set the PDO error mode to exception
			    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

			    return $db;
		}
		catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
		}
	} 

	function getTypeLabel($idType){
		$db = db_connect();
		$query = $db->query("SELECT * from types where idType = $idType "); 
		return $query->fetchAll()[0]['name'];
	}

	function datediff($dateDebut, $dateFin){ 
		$datediff_ = $dateFin - $dateDebut; 
		return floor($datediff_ / (60 * 60 * 24))+1;
	}
	function getContactInfo()
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM representant");
        return $query->fetchAll(PDO::FETCH_ASSOC)[0];
	}
	function GetForfaisTexts()
	{	
		$data = array();
		$db = db_connect();
		//////////////////////// Visuel ////////////////////////
		$query = $db->query("SELECT name, description from visuel");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['visuel'][$key]['name'] = $value['name'];
			$data['visuel'][$key]['description'] = $value['description'];
		}
		///////////////////////////////////////////////////////

		//////////////////////// SON ////////////////////////
		$query = $db->query("SELECT  name, description from son");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['son'][$key]['name'] = $value['name'];
			$data['son'][$key]['description'] = $value['description'];
		}
		////////////////////////////////////////////////////////

		//////////////////////// Option ////////////////////////
		$query = $db->query("SELECT  name, description from options");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['options'][$key]['name'] = $value['name'];
			$data['options'][$key]['description'] = $value['description'];
		}
		////////////////////////////////////////////////////////
 		
		return $data;
	}
	function getDataPrices()
	{
		$db = db_connect();
		$data = array(
			"visuel" => array(),
			"son" => array(),
			"options" => array(),
			"autres" => array(),
			"JamMobile" => array(),
			"JamSon" => array()
		);

		///////////////////////// Visuel ////////////////////////
		$query = $db->query("SELECT slug, price from visuel");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['visuel'][$value['slug']] = intval($value['price']);
		}
		///////////////////////// Visuel ////////////////////////


		///////////////////////// Son ///////////////////////////
		$query = $db->query("SELECT slug, price from son");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['son'][$value['slug']] = intval($value['price']);
		}
		/////////////////////////////////////////////////////////


		///////////////////////// Options ///////////////////////
		$query = $db->query("SELECT slug, price from options");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['options'][$value['slug']] = intval($value['price']);
		}
		/////////////////////////////////////////////////////////


		///////////////////////// Autre ///////////////////////
		$query = $db->query("SELECT slug, price from autres");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['autres'][$value['slug']] = floatval($value['price']);
		}
		/////////////////////////////////////////////////////////


		/////////////////////// JamMobile ///////////////////////
		$query = $db->query("SELECT nbrJours, TotalPrice from JamMobile");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['JamMobile'][$value['nbrJours']] = intval($value['TotalPrice']);
		}
		/////////////////////////////////////////////////////////

		///////////////////////// JamSon ///////////////////////
		$query = $db->query("SELECT nbrJours, price from JamSon");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['JamSon'][$value['nbrJours']] = intval($value['price']);
		}
		/////////////////////////////////////////////////////////
		//printR($data);
		return $data;

	}
	function generateJsonDataPrice($value='')
	{
		$fp = fopen('js/data.json', 'w');
		fwrite($fp, json_encode( getDataPrices() ));
		fclose($fp);
	}
	function TVA( $amount ){

		return  ($amount == 0) ? 0 : ($amount * 20)/100;
	}

	function HTTC( $amount ){

		return ($amount == 0) ? 0 : $amount + ($amount * 20)/100;
	}

	function TAXE( $amount, $taxe ){

		return ($amount * $taxe)/100;
	}


	function getFrenchDate( $timestamp ){	
		
		$days = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
		$months = array('janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
		
			return $days[date('w', $timestamp)].date(' j ', $timestamp).$months[date('n', $timestamp)-1].date(' Y', $timestamp);
	}
	function generatePDFDevis( $idDevis ){
		$data = array();
		$db = db_connect();
		$query = $db->query("SELECT * from devis where idDevis = $idDevis ");
		$result = $query->fetchAll(PDO::FETCH_ASSOC)[0]; 


		$infos = array(
			"devisNumber" 	=> date('Yj', $result['dateDevis']).$result['idDevis'],
			"fname" 		=> $result['fname'],
			"lname" 		=> $result['lname'],
			"email" 		=> $result['email'],
			"tel" 			=> $result['tel'],
			"societe" 		=> $result['societe'],
			"address1"  	=> $result['address1'],
			"cp" 			=> $result['cp'],
			"villeEvent"	=> $result['villeEvent'], 
			"ville"			=> $result['ville'], 
			"paysEvent"			=> $result['paysEvent'], 
			"distance"			=> $result['distance'], 

			"dateDebut"		=> getFrenchDate( $result['dateDebut'] ),
			"dateFin"		=> getFrenchDate( $result['dateFin'] ),
			"nbrJours"		=> datediff($result['dateDebut'], $result['dateFin']),

			"dateDevis"		=> getFrenchDate( $result['dateDevis'] ), 
			"validateDate" 	=> getFrenchDate( $result['dateDevis'] + (3600 * 24 * 30) ), 

			"options"		=> ( !empty($result['options']) && strpos(',', $result['options']) !== false ) ? array($result['options']) : explode(',', $result['options']),
			"contact"		=> getContactInfo(),
			"lieu"			=> $result['lieu'],
			"pays"			=> $result['pays']

		);
 
		$DataPrices = getDataPrices(); 



		////// Transport et hebergement ///////////////
		$priceHebergementImage 	= $DataPrices['autres']['priceHebergementImage'];
		$priceHebergementSon 	= $DataPrices['autres']['priceHebergementSon'];

		$priceDeplacementImage 	= $DataPrices['autres']['priceDeplacementImage'];
		$priceDeplacementSon 	= $DataPrices['autres']['priceDeplacementSon'];

		$PriceTransportHeberg = 0;

		// Hebergement
	 	$PriceTransportHeberg += ($priceHebergementImage * 2) * ($infos['nbrJours'] + 2);
	 	$PriceTransportHeberg +=  ( $DataPrices['son'][ $result['son'] ] > 0 ) ? $priceHebergementSon * ($infos['nbrJours'] + 2) : 0 ;

	 	// Transport
	 	$PriceTransportHeberg += $priceDeplacementImage * $infos['distance'];
	 	$PriceTransportHeberg +=  ( $DataPrices['son'][ $result['son'] ] > 0 ) ? $priceDeplacementSon * $infos['distance'] : 0 ;

		////////////////////////////////////////////////

		////// Demarches administratives ///////////////
	 	$GestDemarAdmin = (in_array('GestDemarAdmin', $infos['options'])) ? $DataPrices['options']['GestDemarAdmin'] : 0;
		////////////////////////////////////////////////

		////// Options ///////////////
	 	$captationVideo = (in_array('captationVideo', $infos['options'])) ? $DataPrices['options']['captationVideo'] : 0;
	 	$liveVideo = (in_array('liveVideo', $infos['options'])) ? $DataPrices['options']['liveVideo'] : 0;
	 	$siteWeb = (in_array('siteWeb', $infos['options'])) ? $DataPrices['options']['siteWeb'] : 0;
	 	$affiche = (in_array('affiche', $infos['options'])) ? $DataPrices['options']['affiche'] : 0;
		////////////////////////////////////////////////
		
		$infos['nbrJoursPlus2'] = $infos['nbrJours'] + 2;

		//printR(array($result, $DataPrices)) ;	

		$DataCalcule = array(
			/////////////////////////////////////////// VIDÉO MAPPING /////////////////////////////////////////////////////////////
			"visuel" => array(
				"type" 			=> $result['visuel'], 
				"qte" 			=> $result['nbrBoucles'],
				"prixUnitaire" 	=> $DataPrices['visuel'][ $result['visuel'] ],
				"totalHT" 		=> $DataPrices['visuel'][ $result['visuel'] ] * $result['nbrBoucles'],
				"TVA" 			=> TVA( $DataPrices['visuel'][ $result['visuel'] ] * $result['nbrBoucles'] ),
				"TotalTTC" 		=> HTTC($DataPrices['visuel'][ $result['visuel'] ] * $result['nbrBoucles'])
			),
			"video_jamions" => array(
				"qte" 			=> $result['video_jamions'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceJamionImage'],
				"totalHT" 		=> $DataPrices['autres']['priceJamionImage']*$result['video_jamions'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceJamionImage']*$result['video_jamions'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceJamionImage']*$result['video_jamions'])
			),
			"JamMobile" => array(
				"qte" 			=> 1,
				"prixUnitaire" 	=> $DataPrices['JamMobile'][ $infos['nbrJours'] ],
				"totalHT" 		=> $DataPrices['JamMobile'][ $infos['nbrJours'] ] * $result['video_jamions'],
				"TVA" 			=> TVA( $DataPrices['JamMobile'][ $infos['nbrJours'] ] * $result['video_jamions'] ),
				"TotalTTC" 		=> HTTC($DataPrices['JamMobile'][ $infos['nbrJours'] ] * $result['video_jamions'] ) 
			),
			"video_techniciens" => array(
				"qte" 			=> $result['video_techniciens'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceTechnicienImage'],
				"totalHT" 		=> $DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlus2'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlus2'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlus2'])
			),
			"video_hebergement" => array(
				"qte" 			=> $result['video_hebergement'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceHebergementImage'],
				"totalHT" 		=> $DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlus2'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlus2'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlus2'])
			),

			"video_transport" => array(
				"qte" 			=> $result['video_transport']*$infos['distance'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceDeplacementImage']*2,
				"totalHT" 		=> $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$infos['distance']*2,
				"TVA" 			=> TVA( $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$infos['distance']*2 ),
				"TotalTTC" 		=> HTTC( $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$infos['distance']*2 )
			),

			/////////////////////////////////////////////// SONORISATION /////////////////////////////////////////////////////////
			"son" => array(
				"type" 			=> $result['son'], 
				"qte" 			=> $result['nbrBoucles'],
				"prixUnitaire" 	=> $DataPrices['son'][ $result['son'] ],
				"totalHT" 		=> $DataPrices['son'][ $result['son'] ] * $result['nbrBoucles'],
				"TVA" 			=> TVA( $DataPrices['son'][ $result['son'] ] * $result['nbrBoucles'] ),
				"TotalTTC" 		=> HTTC($DataPrices['son'][ $result['son'] ] * $result['nbrBoucles']) 
			),
			"sonorisation_unite" => array(
				"qte" 			=> $result['sonorisation_unite'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceVehiculeSon'],
				"totalHT" 		=> $DataPrices['autres']['priceVehiculeSon']*$result['sonorisation_unite'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceVehiculeSon']*$result['sonorisation_unite'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceVehiculeSon']*$result['sonorisation_unite'])
			),
			"JamSon" => array(
				"qte" 			=> $result['sonorisation_unite'],
				"prixUnitaire" 	=> $DataPrices['JamSon'][ $infos['nbrJours'] ],
				"totalHT" 		=> $DataPrices['JamSon'][ $infos['nbrJours'] ] * $result['sonorisation_unite'],
				"TVA" 			=> TVA( $DataPrices['JamSon'][ $infos['nbrJours'] ]* $result['sonorisation_unite'] ),
				"TotalTTC" 		=> HTTC($DataPrices['JamSon'][ $infos['nbrJours'] ]* $result['sonorisation_unite'] )
			), 
			"sonorisation_techniciens" => array(
				"qte" 			=> $result['sonorisation_techniciens'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceTechnicienSon'],
				"totalHT" 		=> $DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlus2'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlus2'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlus2'])
			),
			"sonorisation_hebergement" => array(
				"qte" 			=> $result['sonorisation_hebergement'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceHebergementSon'],
				"totalHT" 		=> $DataPrices['autres']['priceHebergementSon']*$result['sonorisation_hebergement']*$infos['nbrJoursPlus2'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceHebergementSon']*$result['sonorisation_hebergement']*$infos['nbrJoursPlus2'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceHebergementSon']*$result['sonorisation_hebergement']*$infos['nbrJoursPlus2'])
			),
			"sonorisation_transport" => array(
				"qte" 			=> $result['sonorisation_transport']*$infos['distance'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceDeplacementSon']*2,
				"totalHT" 		=> $DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$infos['distance']*2,
				"TVA" 			=> TVA( $DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$infos['distance']*2 ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$infos['distance']*2)
			), 
			/////////////////////////////////////////////// Demarches administratives /////////////////////////////////////////////////////////
			"GestDemarAdmin" => array(
				"qte" 			=> ($GestDemarAdmin > 0) ? 1 : 0,
				"prixUnitaire" 	=> $GestDemarAdmin,
				"totalHT" 		=> $GestDemarAdmin,
				"TVA" 			=> TVA( $GestDemarAdmin ),
				"TotalTTC" 		=> HTTC($GestDemarAdmin)	
			),

			/////////////////////////////////////////////// options  /////////////////////////////////////////////////////////
			"captationVideo" => array(
				"qte" 			=> ($captationVideo > 0) ? 1 : 0,
				"prixUnitaire" 	=> $captationVideo,
				"totalHT" 		=> $captationVideo,
				"TVA" 			=> TVA( $captationVideo ),
				"TotalTTC" 		=> HTTC($captationVideo)
			),
			"liveVideo" => array(
				"qte" 			=> ($liveVideo > 0) ? 1 : 0,
				"prixUnitaire" 	=> $liveVideo,
				"totalHT" 		=> $liveVideo,
				"TVA" 			=> TVA( $liveVideo ),
				"TotalTTC" 		=> HTTC($liveVideo)
			),
			"affiche" => array(
				"qte" 			=> ($affiche > 0) ? 1 : 0,
				"prixUnitaire" 	=> $affiche,
				"totalHT" 		=> $affiche,
				"TVA" 			=> TVA( $affiche ),
				"TotalTTC" 		=> HTTC($affiche) 
			),
			"siteWeb" => array(
				"qte" 			=> ($siteWeb > 0) ? 1 : 0,
				"prixUnitaire" 	=> $siteWeb,
				"totalHT" 		=> $siteWeb,
				"TVA" 			=> TVA( $siteWeb ),
				"TotalTTC" 		=> HTTC($siteWeb )
			),
			/////////////////////////////////////////////// Autres /////////////////////////////////////////////////////////
			"sonorisation_taxe_sacem" => array(
				"qte" 			=> "" ,
				"prixUnitaire" 	=> "",
				"totalHT" 		=> "",
				"TVA" 			=> "",
				"TotalTTC" 		=> "",
			), 
			"autre_gardinnage" => array(
				"qte" 			=> $result['autre_gardinnage']*$infos['nbrJoursPlus2'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceGardiennage'],
				"totalHT" 		=> $DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlus2'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlus2']),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlus2'])
			),

		);
 

		$subTotal = array(
			"videoMapimg" => array(
				"HT"  => $DataCalcule['visuel']['totalHT'] + $DataCalcule['video_jamions']['totalHT'] + $DataCalcule['JamMobile']['totalHT'] + $DataCalcule['video_techniciens']['totalHT'] + $DataCalcule['video_hebergement']['totalHT'] + $DataCalcule['video_transport']['totalHT'] ,
				"TVA" => $DataCalcule['visuel']['TVA'] + $DataCalcule['video_jamions']['TVA'] + $DataCalcule['JamMobile']['TVA'] + $DataCalcule['video_techniciens']['TVA'] + $DataCalcule['video_hebergement']['TVA'] + $DataCalcule['video_transport']['TVA'],
				"TTC" => $DataCalcule['visuel']['TotalTTC'] + $DataCalcule['video_jamions']['TotalTTC'] + $DataCalcule['JamMobile']['TotalTTC'] + $DataCalcule['video_techniciens']['TotalTTC'] + $DataCalcule['video_hebergement']['TotalTTC'] + $DataCalcule['video_transport']['TotalTTC']
			),
			"sonorisation" => array(
				"HT"  => $DataCalcule['son']['totalHT'] + $DataCalcule['sonorisation_unite']['totalHT'] + $DataCalcule['JamSon']['totalHT'] + $DataCalcule['sonorisation_techniciens']['totalHT'] + $DataCalcule['sonorisation_hebergement']['totalHT'] + $DataCalcule['sonorisation_transport']['totalHT'],
				"TVA" => $DataCalcule['son']['TVA'] + $DataCalcule['sonorisation_unite']['TVA'] + $DataCalcule['JamSon']['TVA'] + $DataCalcule['sonorisation_hebergement']['TVA'] + $DataCalcule['sonorisation_transport']['TVA'],
				"TTC" => $DataCalcule['son']['TotalTTC'] + $DataCalcule['sonorisation_unite']['TotalTTC'] + $DataCalcule['JamSon']['TotalTTC'] + $DataCalcule['sonorisation_hebergement']['TotalTTC'] + $DataCalcule['sonorisation_transport']['TotalTTC']
			),  
			"GestDemarAdmin" => array(
				"HT"  => $DataCalcule['GestDemarAdmin']['totalHT'] ,
				"TVA" => $DataCalcule['GestDemarAdmin']['TVA'],
				"TTC" => $DataCalcule['GestDemarAdmin']['TotalTTC']
			), 
			"options" => array(
				"HT"  => $DataCalcule['captationVideo']['totalHT'] + $DataCalcule['liveVideo']['totalHT'] + $DataCalcule['affiche']['totalHT'] + $DataCalcule['siteWeb']['totalHT'] ,
				"TVA" => $DataCalcule['captationVideo']['TVA'] + $DataCalcule['liveVideo']['TVA'] + $DataCalcule['affiche']['TVA'] + $DataCalcule['siteWeb']['TVA'],
				"TTC" => $DataCalcule['captationVideo']['TotalTTC'] + $DataCalcule['liveVideo']['TotalTTC'] + $DataCalcule['affiche']['TotalTTC'] + $DataCalcule['siteWeb']['TotalTTC']
			),
			"autres" => array(
				"HT"  => $DataCalcule['autre_gardinnage']['totalHT'],
				"TVA" => $DataCalcule['autre_gardinnage']['TVA'],
				"TTC" => $DataCalcule['autre_gardinnage']['TotalTTC']
			)
		);
		$Total = array();
		$Total["HT"] = $subTotal['videoMapimg']['HT'] + $subTotal['sonorisation']['HT'] + $subTotal['GestDemarAdmin']['HT'] + $subTotal['options']['HT'];

		if( $result['sonorisation_taxe_sacem'] > 0  ){

			$DataCalcule['sonorisation_taxe_sacem'] = array(
				"qte" 			=> $DataPrices['autres']['taxeSacem'] ,
				"prixUnitaire" 	=> TAXE($Total["HT"], $DataPrices['autres']['taxeSacem']),
				"totalHT" 		=> TAXE($Total["HT"], $DataPrices['autres']['taxeSacem']),
				"TVA" 			=> TVA( TAXE($Total["HT"], $DataPrices['autres']['taxeSacem']) ),
				"TotalTTC" 		=> HTTC(TAXE($Total["HT"], $DataPrices['autres']['taxeSacem'])),
			);

			$subTotal['autres']['HT']  += $DataCalcule['sonorisation_taxe_sacem']['totalHT'];
			$subTotal['autres']['TVA'] += $DataCalcule['sonorisation_taxe_sacem']['TVA'];
			$subTotal['autres']['TTC'] += $DataCalcule['sonorisation_taxe_sacem']['TotalTTC'];

		}

		$Total["HT"] += $subTotal['autres']['HT'];

		$nbrJourFromNow = datediff(time(),$result['dateDebut']);
		if( $nbrJourFromNow >= (30*6) ){
            $Total['HT'] = $Total['HT'] - ($Total['HT'] * 10) / 100;
        }

        $remise = false;
        $Total['HTR'] = $Total['HT'];
        if( $result['remise_montant'] > 0 ){
        	$Total['HTR'] = $Total['HTR'] - $result['remise_montant'];
        	$remise = array(
        		'label' => $result['remise_label'],
        		'value' => number_format($result['remise_montant'],2,',',' ' ).' €'
        	);
        }
        if( $result['remise_pourcentage'] > 0 ){
        	$Total['HTR'] = $Total['HTR'] - TAXE($Total['HTR'], $result['remise_pourcentage'] ); 
        	$remise = array(
        		'label' => $result['remise_label'],
        		'value' => $result['remise_pourcentage'].'%'
        	);
        }



        $Total['TVA'] = TVA( $Total['HTR'] );
        $Total['TTC'] = HTTC( $Total['HTR'] );


 	
 
		$infos['addAttachment'] = "Devis_".time().".pdf";

		return array( 
			"infos" 		=> $infos,
			"DataCalcule"	=> $DataCalcule,
			"subTotal"		=> $subTotal,
			"Total"			=> $Total,
			"remise"		=> $remise
		);
  

	}


	function sendEmailToCLient( $infos ){
		
		 
		

		$mail = new PHPMailer;
		$mail->isSMTP();

		// Zento
		// Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		// $mail->SMTPDebug = 2;
		// //Set the hostname of the mail server
		// $mail->Host = 'auth.smtp.1and1.fr';
		// //Set the SMTP port number - likely to be 25, 465 or 587
		// $mail->Port = 465;
		// //Whether to use SMTP authentication
		// $mail->SMTPAuth = true;
		// $mail->SMTPSecure = 'ssl'; 
		// //Username to use for SMTP authentication
		// $mail->Username = 'noreply-athem@zento.fr';
		// //Password to use for SMTP authentication
		// $mail->Password = 'Xwo@6973nas'; 


		//GMAIL
		$mail->SMTPDebug = 2;	
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "athem.zento@gmail.com";
		//Password to use for SMTP authentication
		$mail->Password = "Xwo@6973nas";

		$mail->setFrom( getContactInfo()['email'], 'ATHEM');
		$mail->addAddress( $infos['email'] );
		// $mail->addCC( getContactInfo()['email'] );
		$mail->Subject  = 'JAMULATEUR - ATHEM';
		$mail->addAttachment( $infos['addAttachment'] );
		$mail->IsHTML(true); 
		$mail->CharSet = 'UTF-8';
		$mail->Body     = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-6-I"/><title>Untitled Document</title></head><body>Madame, Monsieur,<br/><br/>Merci vivement d&rsquo;avoir utilis&eacute; le JAMULATEUR pour r&eacute;aliser votre devis ci joint,<br/><br/>Cette proposition financi&egrave;re peut probablement &ecirc;tre optimis&eacute;e, n&rsquo;h&eacute;sitez pas &agrave; me contacter par courriel ou t&eacute;l&eacute;phone.<br/><br/>Restant &agrave; votre disposition,<br/><br/>Tr&egrave;s cordialement,<br/><br/>Philippe<br/><a href="mailto:contact@athem-skertzo.com">contact@athem-skertzo.com</a><br/>GSM + 33 (0)6 07 32 09 21<br/>ATELIER ATHEM<br/><a href="http://www.athem-skertzo.com/" target="_blank">ATHEM WEBSITE</a> - <a href="https://www.facebook.com/athem" target="_blank">FACEBOOK</a> - <a href="https://plus.google.com/u/0/b/101244148760564709999/101244148760564709999/posts" target="_blank">GOOGLE+</a> - <a href="https://www.pinterest.com/stagedbyathem/" target="_blank">PINTEREST</a> - <a href="https://twitter.com/StagedbyATHEM" target="_blank">TWITTER</a></body></html>';

		return ( $mail->send() ) ? true : false;
	}

	function sendEmailToAdmin( $infos ){ 

		// $mail = new PHPMailer;
		// $mail->setFrom( 'noreply@athem-skertzo.com', 'ATHEM');
		// $mail->addAddress( getContactInfo()['email'] );
		// $mail->Subject  = 'Devis généré - ATHEM';
		// $mail->addAttachment( $infos['addAttachment'] );
		// $mail->CharSet = 'UTF-8';
		// $mail->IsHTML(true); 
		// $mail->Body     = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-6-I"/><title>Untitled Document</title></head><body><p>Bonjour,<br><br>Un nouveau devis, ci-joint, a été émis et envoyé par le JAMULATEUR<br><br>Cordialement</p></body></html>';

		// return ( $mail->send() ) ? true : false;
	}

	function slugify($slug){ 
		$slug = preg_replace('@[\s!:;_\?=\\\+\*/%&#]+@', '-', $slug);  
		$slug = mb_strtolower($slug); 
		$slug = trim($slug, '-');  

	    $slug = iconv('UTF-8', 'ISO-8859-1//IGNORE', $slug); 

	  return $slug;
	}

	function insetFile( $data ){
		extract($data);
		$db = db_connect();
		$query = $db->query("INSERT INTO `uploads` (idDevis, fileName, realName) VALUES ('$idDevis','$fileName','$realName') " );
	}

	function uploadFiles( $idDevis, $files, $uploaddir ){  ;

		foreach ($files as $key => $file) {
  
			$fileName = time()."_". basename( slugify($file['name']) );
			$uploadfile = $uploaddir .$fileName; 

			if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
			    
			    insetFile(array(
			    	"idDevis"  => $idDevis,
			    	"fileName" => $fileName,
			    	"realName" => $file['name']
			    ));
			}

		} 
	} 

	function getConditionsGenerales()
	{	
		$db = db_connect();
		$query = $db->query("SELECT * FROM contents where slug = 'conditions_generales'");
        return $query->fetchAll(PDO::FETCH_ASSOC)[0]['content'];
	}

	function getDepotAddress()
	{	
		$db = db_connect();
		$query = $db->query("SELECT * FROM contents where slug = 'adresse_depot'");
        return $query->fetchAll(PDO::FETCH_ASSOC)[0]['content'];
	}












?>