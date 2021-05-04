<?php  

	function printR($array)
	{
		echo "<pre>";
			print_r($array);
		echo "</pre>";

		die();
	}
	function db_connect(){
		
		// $servername = "localhost";
		// $username = "jamuser";
		// $password = "J@MZTO2o18"; // 
		// $dbname = "jamulateur";

		$servername = "localhost";
		$username = "root";
		$password = "mysql";
		$dbname = "jamulateur";

		try {
			    $db = new PDO("mysql:host=$servername;dbname=".$dbname, $username, $password);
			    // set the PDO error mode to exception
			    $db->exec("set names utf8");
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

		$isFr = getCurrendLang() === 'fr';

		//////////////////////// Visuel ////////////////////////
		$query = $db->query("SELECT name, description, name_en, description_en from visuel");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['visuel'][$key]['name'] = $isFr ? $value['name'] :  $value['name_en'];
			$data['visuel'][$key]['description'] = $isFr ? $value['description'] :  $value['description_en'];
		}
		///////////////////////////////////////////////////////

		//////////////////////// SON ////////////////////////
		$query = $db->query("SELECT  name, description, name_en, description_en from son");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['son'][$key]['name'] = $isFr ? $value['name'] :  $value['name_en'];
			$data['son'][$key]['description'] = $isFr ? $value['description'] :  $value['description_en'];
		}
		////////////////////////////////////////////////////////

		//////////////////////// Option ////////////////////////
		$query = $db->query("SELECT  name, description, name_en, description_en from options");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['options'][$key]['name'] = $isFr ? $value['name'] :  $value['name_en'];
			$data['options'][$key]['description'] = $isFr ? $value['description'] :  $value['description_en'];
		}
		////////////////////////////////////////////////////////
 		
		return $data;
	}
	function getDataPrices() {

		$db = db_connect();
		$data = array(
			"visuel" => array(),
			"son" => array(),
			"options" => array(),
			"autres" => array(),
			"jamionsPrices" => array(),
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
		$query = $db->query("SELECT nbr_days,jam_1,jam_2,jam_3,idf from jamionsPrices");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$data['jamionsPrices'][$key] = array(
				"nbrJour" => intval($value['nbr_days']),
				"jam_1" => intval($value['jam_1']),
				"jam_2" => intval($value['jam_2']),
				"jam_3" => intval($value['jam_3']),
				"idf" 	=> intval($value['idf'])
			);
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
			"idf"			=> $result['idf'], 
			"paysEvent"		=> $result['paysEvent'], 
			"distance"		=> $result['distance'], 

			"domaine" 		=> $result['domaine'],

			"dateDebut"		=> getFrenchDate( $result['dateDebut'] ),
			"dateFin"		=> getFrenchDate( $result['dateFin'] ),
			"nbrJours"		=> datediff($result['dateDebut'], $result['dateFin']),

			"area"			=> $result['largeur'] * $result['hauteur'],
			"jamions"		=> $result['video_jamions'],

			"dateDevis"		=> getFrenchDate( $result['dateDevis'] ), 
			"validateDate" 	=> getFrenchDate( $result['dateDevis'] + (3600 * 24 * 30) ), 

			"options"		=> ( !empty($result['options']) && strpos(',', $result['options']) !== false ) ? array($result['options']) : explode(',', $result['options']),
			"contact"		=> getContactInfo(),
			"lieu"			=> $result['lieu'],
			"pays"			=> $result['pays']

		);
 
		$DataPrices = getDataPrices(); 


		$infos['nbrJoursPlusCalage'] = $infos['nbrJours'] + 1;

		////// Transport et hebergement ///////////////
		// $priceHebergementImage 	= $DataPrices['autres']['priceHebergementImage'];
		$priceHebergementSon 	= $DataPrices['autres']['priceHebergementSon'];

		$priceDeplacementImage 	= $DataPrices['autres']['priceDeplacementImage'];
		$priceDeplacementSon 	= $DataPrices['autres']['priceDeplacementSon'];

		$PriceTransportHeberg = 0;

		// Hebergement
	 	// $PriceTransportHeberg += ($priceHebergementImage * 2) * $infos['nbrJoursPlusCalage'];
	 	if($infos['idf'] == 0){
	 		$PriceTransportHeberg +=  ( $DataPrices['son'][ $result['son'] ] > 0 ) ? $priceHebergementSon * ($infos['nbrJoursPlusCalage']) : 0 ;
	 	} 

	 	// Transport
	 	if($infos['idf'] == 0){
		 	$PriceTransportHeberg += $priceDeplacementImage * $infos['distance'];
		 	$PriceTransportHeberg +=  ( $DataPrices['son'][ $result['son'] ] > 0 ) ? $priceDeplacementSon * $infos['distance'] : 0 ;
		 }

		////////////////////////////////////////////////

		////// Demarches administratives ///////////////
	 	$GestDemarAdmin = (in_array('GestDemarAdmin', $infos['options'])) ? $DataPrices['options']['GestDemarAdmin'] : 0;
		////////////////////////////////////////////////

		////// Options ///////////////
	 	$captationVideo = (in_array('captationVideo', $infos['options'])) ? $DataPrices['options']['captationVideo'] : 0;
	 	$liveVideo = (in_array('liveVideo', $infos['options'])) ? $DataPrices['options']['liveVideo'] : 0;
	 	$teaser = (in_array('teaser', $infos['options'])) ? $DataPrices['options']['teaser'] : 0;
	 	$affiche = (in_array('affiche', $infos['options'])) ? $DataPrices['options']['affiche'] : 0;
		//////////////////////////////////////////////// 

		//printR(array($result, $DataPrices)) ;	
		if( $result['visuel'] == 'performanceArt' ){
			$result['nbrBoucles'] =  1;
		}

		///////// jamionsPrices ///////// 
		$jamion = array();
		foreach ($DataPrices['jamionsPrices'] as $_k => $jam) {
			if( $jam['nbrJour'] == $infos['nbrJours'] && $jam['idf'] == $infos['idf']  ){
				$jamion = $jam;
			}
		}
		/////////////////////////////////

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
			// "video_jamions" => array(
			// 	"qte" 			=> $result['video_jamions'],
			// 	"prixUnitaire" 	=> $DataPrices['autres']['priceJamionImage'],
			// 	"totalHT" 		=> $DataPrices['autres']['priceJamionImage']*$result['video_jamions'],
			// 	"TVA" 			=> TVA( $DataPrices['autres']['priceJamionImage']*$result['video_jamions'] ),
			// 	"TotalTTC" 		=> HTTC($DataPrices['autres']['priceJamionImage']*$result['video_jamions'])
			// ),
			"JamMobile" => array(
				"qte" 			=> 1,
				"prixUnitaire" 	=> $jamion['jam_'.$result['video_jamions']],
				"totalHT" 		=> $jamion['jam_'.$result['video_jamions']],
				"TVA" 			=> TVA( $jamion['jam_'.$result['video_jamions']] ),
				"TotalTTC" 		=> HTTC( $jamion['jam_'.$result['video_jamions']] ) 
			),
			// // "video_techniciens" => array(
			// // 	"qte" 			=> $result['video_techniciens'],
			// // 	"prixUnitaire" 	=> $DataPrices['autres']['priceTechnicienImage'],
			// // 	"totalHT" 		=> $DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlusCalage'],
			// // 	"TVA" 			=> TVA( $DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlusCalage'] ),
			// // 	"TotalTTC" 		=> HTTC($DataPrices['autres']['priceTechnicienImage']*$result['video_techniciens']*$infos['nbrJoursPlusCalage'])
			// // ),
			// "video_hebergement" => array(
			// 	"qte" 			=> $result['video_hebergement'],
			// 	"prixUnitaire" 	=> $DataPrices['autres']['priceHebergementImage'],
			// 	"totalHT" 		=> $DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlusCalage'],
			// 	"TVA" 			=> TVA( $DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlusCalage'] ),
			// 	"TotalTTC" 		=> HTTC($DataPrices['autres']['priceHebergementImage']*$result['video_hebergement']*$infos['nbrJoursPlusCalage'])
			// ),

			"video_transport" => array(
				"qte" 			=> $infos['idf'] == 0 ? $result['video_transport']*$infos['distance']*2 : 0,
				"prixUnitaire" 	=> $infos['idf'] == 0 ? $DataPrices['autres']['priceDeplacementImage']: 0,
				"totalHT" 		=> $infos['idf'] == 0 ? $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$result['video_jamions']*$infos['distance']*2 : 0,
				"TVA" 			=> $infos['idf'] == 0 ? TVA( $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$result['video_jamions']*$infos['distance']*2 ) : 0,
				"TotalTTC" 		=> $infos['idf'] == 0 ? HTTC( $DataPrices['autres']['priceDeplacementImage']*$result['video_transport']*$result['video_jamions']*$infos['distance']*2 ) : 0
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
				"totalHT" 		=> $DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage'] ),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceTechnicienSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage'])
			),
			"sonorisation_hebergement" => array(
				"qte" 			=> $infos['idf'] == 0 ? $result['sonorisation_hebergement'] : 0,
				"prixUnitaire" 	=> $infos['idf'] == 0 ? $DataPrices['autres']['priceHebergementSon'] : 0,
				"totalHT" 		=> $infos['idf'] == 0 ? $DataPrices['autres']['priceHebergementSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage'] : 0,
				"TVA" 			=> $infos['idf'] == 0 ? TVA( $DataPrices['autres']['priceHebergementSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage'] ) : 0,
				"TotalTTC" 		=> $infos['idf'] == 0 ? HTTC($DataPrices['autres']['priceHebergementSon']*$result['sonorisation_techniciens']*$infos['nbrJoursPlusCalage']) : 0
			),
			// "sonorisation_transport" => array(
			// 	"qte" 			=> $infos['idf'] == 0 ? $result['sonorisation_transport']*$infos['distance']*2 : 0,
			// 	"prixUnitaire" 	=> $infos['idf'] == 0 ? $DataPrices['autres']['priceDeplacementSon'] : 0,
			// 	"totalHT" 		=> $infos['idf'] == 0 ? $DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$result['sonorisation_unite']*$infos['distance']*2 : 0,
			// 	"TVA" 			=> $infos['idf'] == 0 ? TVA( $DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$result['sonorisation_unite']*$infos['distance']*2 ) : 0,
			// 	"TotalTTC" 		=> $infos['idf'] == 0 ? HTTC($DataPrices['autres']['priceDeplacementSon']*$result['sonorisation_transport']*$result['sonorisation_unite']*$infos['distance']*2) : 0
			// ), 
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
			"teaser" => array(
				"qte" 			=> ($teaser > 0) ? 1 : 0,
				"prixUnitaire" 	=> $teaser,
				"totalHT" 		=> $teaser,
				"TVA" 			=> TVA( $teaser ),
				"TotalTTC" 		=> HTTC($teaser )
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
				"qte" 			=> $result['autre_gardinnage']*$infos['nbrJoursPlusCalage'],
				"prixUnitaire" 	=> $DataPrices['autres']['priceGardiennage'],
				"totalHT" 		=> $DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlusCalage'],
				"TVA" 			=> TVA( $DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlusCalage']),
				"TotalTTC" 		=> HTTC($DataPrices['autres']['priceGardiennage']*$result['autre_gardinnage']*$infos['nbrJoursPlusCalage'])
			),

		);
 

		$subTotal = array(
			"videoMapimg" => array(
				"HT"  => $DataCalcule['visuel']['totalHT'] + 
						// $DataCalcule['video_jamions']['totalHT'] + 
						$DataCalcule['JamMobile']['totalHT'] + 
						// $DataCalcule['video_techniciens']['totalHT'] + 
						// $DataCalcule['video_hebergement']['totalHT'] + 
						$DataCalcule['video_transport']['totalHT'] ,

				"TVA" => $DataCalcule['visuel']['TVA'] + 
						// $DataCalcule['video_jamions']['TVA'] + 
						$DataCalcule['JamMobile']['TVA'] + 
						// $DataCalcule['video_techniciens']['TVA'] + 
						// $DataCalcule['video_hebergement']['TVA'] + 
						$DataCalcule['video_transport']['TVA'],
				"TTC" => $DataCalcule['visuel']['TotalTTC'] + 
						// $DataCalcule['video_jamions']['TotalTTC'] + 
						$DataCalcule['JamMobile']['TotalTTC'] + 
						// $DataCalcule['video_techniciens']['TotalTTC'] + 
						// $DataCalcule['video_hebergement']['TotalTTC'] + 
						$DataCalcule['video_transport']['TotalTTC']
			),
			"sonorisation" => array(
				"HT"  => $DataCalcule['son']['totalHT'] + 
						 $DataCalcule['sonorisation_unite']['totalHT'] + 
						 $DataCalcule['JamSon']['totalHT'] + 
						 $DataCalcule['sonorisation_techniciens']['totalHT'] + 
						 $DataCalcule['sonorisation_hebergement']['totalHT'],

				"TVA" => $DataCalcule['son']['TVA'] + 
				         $DataCalcule['sonorisation_unite']['TVA'] + 
				         $DataCalcule['JamSon']['TVA'] + 
				         $DataCalcule['sonorisation_techniciens']['TVA'] + 
				         $DataCalcule['sonorisation_hebergement']['TVA'],

				"TTC" => $DataCalcule['son']['TotalTTC'] + 
						 $DataCalcule['sonorisation_unite']['TotalTTC'] + 
						 $DataCalcule['JamSon']['TotalTTC'] + 
						 $DataCalcule['sonorisation_hebergement']['TotalTTC']
			),  
			"GestDemarAdmin" => array(
				"HT"  => $DataCalcule['GestDemarAdmin']['totalHT'] ,
				"TVA" => $DataCalcule['GestDemarAdmin']['TVA'],
				"TTC" => $DataCalcule['GestDemarAdmin']['TotalTTC']
			), 
			"options" => array(
				"HT"  => $DataCalcule['captationVideo']['totalHT'] + 
				         $DataCalcule['liveVideo']['totalHT'] + 
				         $DataCalcule['affiche']['totalHT'] + 
				         $DataCalcule['teaser']['totalHT'] ,

				"TVA" => $DataCalcule['captationVideo']['TVA'] + 
				         $DataCalcule['liveVideo']['TVA'] + 
				         $DataCalcule['affiche']['TVA'] + 
				         $DataCalcule['teaser']['TVA'],

				"TTC" => $DataCalcule['captationVideo']['TotalTTC'] + 
				         $DataCalcule['liveVideo']['TotalTTC'] + 
				         $DataCalcule['affiche']['TotalTTC'] + 
				         $DataCalcule['teaser']['TotalTTC']
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

		/// if reservation Before 6 months
		// $nbrJourFromNow = datediff(time(),$result['dateDebut']);
		// if( $nbrJourFromNow >= (30*6) ){
  //           $Total['HT'] = $Total['HT'] - ($Total['HT'] * 10) / 100;
  //       }

        $remise = false;
        $Total['HTR'] = $Total['HT'];
        // if( $result['remise_montant'] > 0 ){
        // 	$Total['HTR'] = $Total['HTR'] - $result['remise_montant'];
        // 	$remise = array(
        // 		'label' => $result['remise_label'],
        // 		'value' => number_format($result['remise_montant'],2,',',' ' ).' €'
        // 	);
        // }
        // if( $result['remise_pourcentage'] > 0 ){
        // 	$Total['HTR'] = $Total['HTR'] - TAXE($Total['HTR'], $result['remise_pourcentage'] ); 
        // 	$remise = array(
        // 		'label' => $result['remise_label'],
        // 		'value' => $result['remise_pourcentage'].'%'
        // 	);
        // }



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

		$contactInfos = getContactInfo();

		$mail = new PHPMailer;

		//SMTP GMAIL
		$mail->isSMTP();  
		$mail->SMTPDebug = 1;	 
		$mail->Host = 'smtp.gmail.com'; 
		$mail->Port = 587; 
		$mail->SMTPSecure = 'tls'; 
		$mail->SMTPAuth = true; 
		$mail->Username = "athem.zento@gmail.com"; 
		$mail->Password = "ptnjuzmmblbrupvg";


		$mail->setFrom( $contactInfos['email'], 'ATHEM');
		$mail->addAddress( $infos['email'] );
		$mail->addCC( "contact@jamion.fr" );
		$mail->Subject  = 'JAMULATEUR - Atelier JAM';
		if($infos['attachments'] && count($infos['attachments']) > 0){
			foreach ($infos['attachments']as $key => $attachment) {
				$mail->addAttachment( $attachment );
			}
		} 
		$mail->IsHTML(true); 
		$mail->CharSet = 'UTF-8';
		$mail->Body     = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-6-I"/><title>Untitled Document</title></head><body>Madame, Monsieur,<br/><br/>Merci vivement d&rsquo;avoir utilis&eacute; le JAMULATEUR pour r&eacute;aliser votre devis ci joint,<br/><br/> N&rsquo;h&eacute;sitez pas &agrave; me contacter par courriel ou t&eacute;l&eacute;phone pour &eacute;tudier votre projet et finaliser votre chiffrage.<br/><br/>Restant &agrave; votre disposition,<br/><br/>Tr&egrave;s cordialement,<br/><br/> '.$contactInfos['name'].'<br/><a href="mailto:'.$contactInfos['email'].'">'.$contactInfos['email'].'</a><br/>GSM '.$contactInfos['tel'].'<br /> <br/> <strong>ATELIER JAM</strong><br /> <span style="color: #555"><strong>PRODUCTION &amp; SC&Eacute;NOGRAPHIE CULTURELLE - COLLABORATION ARTISTIQUE</strong></span> </body></html>';

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

		$attachments = array();
		foreach ($files as $key => $file) {
  
			$fileName = time()."_". basename( slugify($file['name']) );
			$uploadfile = $uploaddir .$fileName; 

			if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
			    
			    insetFile(array(
			    	"idDevis"  => $idDevis,
			    	"fileName" => $fileName,
			    	"realName" => $file['name']
			    ));

			    $attachments[] = '../admin/uploads/'.$fileName;
			}

		}
		return $attachments;
	} 

	function getConditionsGenerales($lang = 'fr')
	{	
		$db = db_connect();

		$query = $db->query("SELECT * FROM contents where slug = 'conditions_generales'"); 
        $data =  $query->fetchAll(PDO::FETCH_ASSOC)[0];

        return $lang == 'fr' ? $data['content'] : $data['content_en'];
	}

	function getDepotAddress()
	{	
		$db = db_connect();
		$query = $db->query("SELECT * FROM contents where slug = 'adresse_depot'");
        return $query->fetchAll(PDO::FETCH_ASSOC)[0]['content'];
	}

	function getCurrendLang()
	{
		return isset($_GET['lang']) && $_GET['lang'] == 'en' ? 'en' : 'fr';
	}


	function _translate($keyString)
	{
		$languages = json_decode(file_get_contents("./inc/languages.min.json"), true);
		$currendLang = getCurrendLang();
		return $languages[$currendLang][$keyString];
	} 

	function _translate_admin($keyString)
	{
		$languages = json_decode(file_get_contents("../inc/languages.min.json"), true);
		$currendLang = getCurrendLang(); 
		return $languages[$currendLang][$keyString];
	}



?>