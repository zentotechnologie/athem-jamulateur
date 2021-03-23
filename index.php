<?php include('inc/functions.php') ?>
<?php $ForfaisTexts = GetForfaisTexts(); ?>
<?php generateJsonDataPrice() ?>
<!DOCTYPE html>
<!--[if lt IE 9]> <html class="lt-ie9" lang="fr"> <![endif]-->
<html class="no-js" lang="fr">
<!--<![endif]-->
<head>
	<title>JAMULATEUR</title>
	<link rel='shortcut icon' href="images/logo.png" type="image/x-icon" />
    <meta name="description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
	<meta name="keywords" content=""/>
    <meta name="robots" content="index, follow, all"/>
    <link rel="stylesheet" type="text/css" href="css/jcf.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
</head>
<body>
<div class="wrapper"> 
	 <div class="header">
	 	<a class="logo">
	 		<img src="images/logo.png">
	 	</a>
	 </div>
	 <form class="blocks-content" id="formDevis" enctype="multipart/form-data">
	 	<div class="clear"></div>
	 	<div class="block block-1">
	 		<div class="head">
	 			événement
	 		</div>
	 		<div class="content"> 

	 			<div class="table">
	 				<div>
	 					<div class="customLabel">
	 						Type
	 					</div>
	 					<div>
	 						<?php  
	 						$db = db_connect();
	 						$query = $db->query("SELECT * FROM types where deleted = 0");
	 						$types = $query->fetchAll()
	 						?>
	 						<select name="type">
	 							<option value="">Type d’événement</option>
	 							<?php foreach ($types as $key => $type):?>
	 								<option value="<?= $type['idType'] ?>"><?= $type['name'] ?></option> 
	 							<?php endforeach ?>
	 						</select>
	 					</div>
	 				</div>
	 			</div>
	 			<div class="table">
	 				<div>
	 					<div class="customLabel">
	 						Lieu
	 					</div>
	 					<div>
	 						<input type="text" name="lieu" placeholder="Lieu">
	 					</div>
	 				</div>
	 			</div>
	 			<div class="table">
	 				<div>
	 					<div class="customLabel">
	 						Adresse<sup style="top: -6px;">⁎</sup>
	 					</div>
	 					<div class="adresse">
	 						<div>
	 							<input type="text" name="rue" id="rue" placeholder="RUE">
	 						</div> 
	 					</div>
	 				</div>
	 			</div>
	 			<div class="table">
	 				<div>
	 					<div class="customLabel"> 
	 					</div>
	 					<div class="adresse"> 
	 						<div>
	 							<div class="clear"></div>
		 							<input type="text" name="cp" placeholder="CP">
		 							<input type="text" name="ville" placeholder="Ville">
		 							<input type="hidden" name="distance" value="-1">
	 							<div class="clear"></div>
	 						</div>
	 					</div>
	 				</div>
	 			</div>
	 			<div class="table">
	 				<div>
	 					<div class="customLabel"> 
	 					</div> 
	 					<div class="adresse"> 
	 						<div> 
		 						<input type="text" name="pays" placeholder="Pays">  
	 						</div>
	 					</div>
	 				</div>
	 			</div>

	 			<div class="dimensions">
	 				<div class="table">
	 					<div>
	 						<div class="block-image">
	 							<strong>
	 								Dimensions <br>façade(s) <span>(en m)</span>
	 							</strong>
	 							<img src="images/immeuble.png">
	 						</div>
	 						<div class="hauteur">
	 							<input type="text" class="hauteurInput" name="hauteur" placeholder="(H)" value="10"  >
	 							<input type="range"  class="rangeH" name="rangeH" data-jcf='{"orientation": "vertical"}' value="10" max="100" min="0" step="1">
	 						</div>
	 					</div>
	 				</div>
	 				<div class="largeur">
	 					<input type="range" class="rangeL" name="rangeL"  value="10" max="80" min="10" step="1">
	 					<input type="text" class="largeurInput" name="largeur" placeholder="(L)" value="10" >
	 				</div>
	 			</div>

	 			<div class="table date">
	 				<div>
	 					<div class="customLabel">
	 						Date
	 					</div>
	 					<div>
	 						<div class="table">
	 							<div>
	 								<div class="subLabel subLabel-1">début</div>
	 								<div class="inputDate">
	 									<input type="text" name="dateDebut" placeholder="01-01 -2017">
	 								</div>
	 								
	 								<div class="subLabel">fin</div>
	 								<div class="inputDate">
	 									<input type="text" name="dateFin" placeholder="01-01 -2017">
	 								</div> 
	 							</div>
	 						</div>
	 					</div>
	 				</div>
	 			</div>

	 			<div class="table uploads">
	 				<div>
	 					<div class="customLabel">
	 						téléchargez<br>
	 						<strong>
	 							vos plans
								ou images
	 						</strong>
	 					</div>
	 					<div class="block-files">
	 						 <img src="images/icon-upload.png">
	 						 <input type="file" name="files" multiple>
	 					</div>
	 				</div>
	 				<div>
	 					<div></div>
	 					<div class="filesPreview">
	 						
	 					</div>
	 				</div>
	 			</div>

	 		</div>
	 	</div>

	 	<div class="block block-2">
	 		<div class="head">
	 			Contenus
	 		</div>
	 		<div class="content">
		 		<div class="table img-button-container images-animees">
		 			<div>
		 				<div class="customLabel">
		 					Images<br> animées
		 				</div>
		 				<div class="item-1 alignLeft">
		 					<a href="#" class="img-button" data-index="creationOriginale"></a>
		 					<p><?= nl2br( $ForfaisTexts['visuel'][0]['name'] ) ?></p>
		 				</div>
		 				<div class="item-2 alignCenter">
		 					<a href="#" class="img-button active" data-index="pretJammer"></a>
		 					<p><?= nl2br( $ForfaisTexts['visuel'][1]['name'] ) ?></p>
		 				</div>
		 				<div class="item-3 alignCenter">
		 					<a href="#" class="img-button" data-index="performanceArt"></a>
		 					<p><?= nl2br( $ForfaisTexts['visuel'][2]['name'] ) ?></p>
		 				</div>
		 				<input type="hidden" class="inputText" name="images-animees" value="prêt à jammer">
		 				<input type="hidden" class="inputVal" name="index-images-animees" value="pretJammer">
		 			</div>
		 		</div>

		 		<div class="table">
		 			<div>
		 				<div class="customLabel"></div>
		 				<div>
		 					<p class="images-animees-ml decriptionService creationOriginale"><?= $ForfaisTexts['visuel'][0]['description'] ?></p>
		 					<p class="images-animees-ml decriptionService pretJammer active"><?= $ForfaisTexts['visuel'][1]['description'] ?></p>
		 					<p class="images-animees-ml decriptionService performanceArt"><?= $ForfaisTexts['visuel'][2]['description'] ?></p>
		 				</div>
		 			</div>
		 		</div>

		 		<div class="table boucles">
		 			<div>
		 				<div class="customLabel">
		 					<span class="titleDefault">Nombre <br>de boucles <br>pour</span> 
		 					<span class="titleCreationOriginal">Durée de la</span> 
		 					<span class="titleVisuel"><?= $ForfaisTexts['visuel'][1]['name'] ?></span>
		 				</div>
		 				<div class="range">
		 					<input type="range" class="nbrBoucles" name="nbrBoucles" value="1" max="10" min="1" step="1">
		 					<img src="images/horizontal-range.vals.png" class="graduations_1_10">
		 					<!-- <img src="images/horizontal-range.vals_10_100.png" class="graduations_10_100"> -->
		 					<img src="images/horizontal-range.vals_5_50.png" class="graduations_5_50">
		 				</div>
		 				<div class="select nbrBouclesView">
		 					 <select name="nbrBouclesSelect">>
		 					 	<option value="1">1</option>
		 					 	<option value="2">2</option>
		 					 	<option value="3">3</option>
		 					 	<option value="4">4</option>
		 					 	<option value="5">5</option>
		 					 	<option value="6">6</option>
		 					 	<option value="7">7</option>
		 					 	<option value="8">8</option>
		 					 	<option value="9">9</option>
		 					 	<option value="10">10</option> 
		 					 </select>
		 					 <input type="text" name="nbrBouclesInput" value="3">
		 				</div>
		 			</div>
		 		</div>
		 		<div class="table son img-button-container">
		 			<div>
		 				<div class="customLabel">
		 					son
		 				</div>
		 				<div class="item-1 alignLeft">
		 					<a href="#" class="img-button active" data-index="creationOriginale"></a>
		 					<p><?= nl2br( $ForfaisTexts['son'][0]['name'] ) ?></p>
		 				</div>
		 				<div class="item-2 alignCenter">
		 					<a href="#" class="img-button" data-index="pretJammer"></a>
		 					<p><?= nl2br( $ForfaisTexts['son'][1]['name'] ) ?></p>
		 				</div>
		 				<div class="item-3 alignCenter">
		 					<a href="#" class="img-button" data-index="pasDeSon"></a>
		 					<p><?= nl2br( $ForfaisTexts['son'][2]['name'] ) ?></p>
		 				</div>
		 				<input type="hidden" class="inputText" name="son" value="création originale">
		 				<input type="hidden" class="inputVal" name="index-son" value="creationOriginale">
		 			</div>
		 		</div>	

		 		<div class="table son-ml-container">
		 			<div>
		 				<div class="customLabel"></div>
		 				<div>
		 					<p class="son-ml decriptionService active creationOriginale"><?= $ForfaisTexts['son'][0]['description']  ?></p>
		 					<p class="son-ml decriptionService pretJammer"><?=  $ForfaisTexts['son'][1]['description']  ?></p>
		 					<p class="son-ml decriptionService pasDeSon"><?=  $ForfaisTexts['son'][2]['description']  ?></p>
		 				</div>
		 			</div>
		 		</div>	
	 		</div>
	 	</div>

	 	<div class="block block-3">
	 		<div class="head">
	 			Options
	 		</div>
	 		<div class="content">
	 			<div class="item-1">
	 				<div class="table ">
		 				<div>
		 					<div>
		 						<a href="#" class="img-off-on btnOffOn-1" data-index="captationVideo"></a>
			 					<span><?= nl2br( $ForfaisTexts['options'][0]['name'] ) ?></span>
		 					</div>
		 					<div>
		 						<a href="#" class="img-off-on btnOffOn-2" data-index="siteWeb"></a>
			 					<span><?= nl2br( $ForfaisTexts['options'][1]['name'] ) ?></span>
		 					</div>
		 				</div>
		 				<div>
		 					<div>
		 						<a href="#" class="img-off-on btnOffOn-3" data-index="liveVideo"></a>
			 					<span><?= nl2br( $ForfaisTexts['options'][2]['name'] ) ?></span>
		 					</div>
		 					<div>
		 						<a href="#" class="img-off-on btnOffOn-4" data-index="GestDemarAdmin"></a>
			 					<span><?= nl2br( $ForfaisTexts['options'][3]['name'] ) ?></span>
		 					</div>
		 				</div>
		 				<div>
		 					<div class="definition-de-option">
		 						<p class="default captationVideo">
				 					(définition) <br>de l’option<br> choisie
				 					<span class="info">i</span>
				 				</p>
				 				<p class="option captationVideo">
				 					<?= $ForfaisTexts['options'][0]['description'] ?>
				 					<span class="info">i</span>
				 				</p>
				 				<p class="option siteWeb">
				 					<?= $ForfaisTexts['options'][1]['description'] ?>
				 					<span class="info">i</span>
				 				</p>
				 				<p class="option liveVideo">
				 					 <?= $ForfaisTexts['options'][2]['description'] ?>
				 					<span class="info">i</span>
				 				</p>
				 				<p class="option GestDemarAdmin">
				 					<?= $ForfaisTexts['options'][3]['description'] ?> 
				 					<span class="info">i</span>
				 				</p>
				 				<p class="option affiche">
				 					<?= $ForfaisTexts['options'][4]['description'] ?>
				 					<span class="info">i</span>
				 				</p>
				 			</div>
		 					<div>
		 						<a href="#" class="img-off-on btnOffOn-5" data-index="affiche"></a>
			 					<span><?= nl2br( $ForfaisTexts['options'][4]['name'] ) ?></span>
		 					</div>
		 				</div>
		 				<input type="hidden" class="inputText" name="option"  value="gestion des démarches administratives">
		 				<input type="hidden" class="inputVal" name="index-option"  value="">
		 			</div>
		 			
	 			</div>
				
				<div class="item-1-1">
	 				<h2 class="customLabel">Vidéo mapping</h2>

	 				<?php   
						$query = $db->query("SELECT * FROM autres");
						$autres = $query->fetchAll();
					?> 
	 				<div class="table">
	 					<div>
	 						<div>
	 							<div class="table">
				 					<div>
				 						<div>
				 							<label class="subtitle">Nb. de jamions</label>
				 						</div>
				 						<div class="selectContainer">
				 							<select name="video_jamions"> 
				 								<?php for ($i=1; $i <= $autres[12][2] ; $i++): ?>
					 								<option value="<?= $i ?>"><?= $i ?></option>   
					 							<?php endfor; ?> 
					 						</select>
				 						</div>
				 					</div>
				 					<div>
				 						<div>
				 							<label class="subtitle">Nb de techniciens</label>
				 						</div>
				 						<div class="selectContainer">
				 							<select name="video_techniciens">
					 							<?php for ($i=1; $i <= $autres[10][2] ; $i++): ?>
					 								<option value="<?= $i ?>"><?= $i ?></option>   
					 							<?php endfor; ?>    
					 						</select>
				 						</div>
				 					</div>
				 				</div>
	 						</div>
	 						<div>
	 							<div class="table">
				 					<div> 
				 						<div>
				 							<label for="video_hebergement" class="subtitle">Hébergement techniciens</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="video_hebergement" name="video_hebergement">
				 						</div>
				 					</div>
				 					<div>
				 						<div>
				 							<label for="video_transport" class="subtitle">Transport de l’équipe</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="video_transport" name="video_transport">
				 						</div>
				 					</div>
				 				</div>
	 						</div>
	 					</div>
	 				</div>

	 				<h2 class="customLabel">Sonorisation</h2>
	 				<div class="table">
	 					<div>
	 						<div>
	 							<div class="table">
				 					<div>
				 						<div>
				 							<label class="subtitle">Nb. d’unités de son</label>
				 						</div>
				 						<div class="selectContainer">
				 							<select name="sonorisation_unite">
				 								<option value="0">0</option> 
					 							<?php for ($i=1; $i <= $autres[13][2] ; $i++): ?>
					 								<option value="<?= $i ?>" <?= ($i == 1) ? 'selected' : '' ?>><?= $i ?></option>   
					 							<?php endfor; ?>    
					 						</select>
				 						</div>
				 					</div>
				 					<div>
				 						<div>
				 							<label class="subtitle">Nb de techniciens</label>
				 						</div>
				 						<div class="selectContainer">
				 							<select name="sonorisation_techniciens">
				 								<option value="0">0</option> 
					 							<?php for ($i=1; $i <= $autres[11][2] ; $i++): ?>
					 								<option value="<?= $i ?>" <?= ($i == 1) ? 'selected' : '' ?> ><?= $i ?></option>   
					 							<?php endfor; ?>           
					 						</select>
				 						</div>
				 					</div>
				 				</div>
	 						</div>
	 						<div>
	 							<div class="table">
				 					<div> 
				 						<div>
				 							<label for="sonorisation_hebergement" class="subtitle">Hébergement techniciens</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="sonorisation_hebergement" name="sonorisation_hebergement">
				 						</div>
				 					</div>
				 					<div>
				 						<div>
				 							<label for="sonorisation_transport" class="subtitle">Transport de l’équipe</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="sonorisation_transport" name="sonorisation_transport">
				 						</div>
				 					</div>
				 					<div>
				 						<div>
				 							<label for="sonorisation_taxe_sacem" class="subtitle">TAXE SACEM</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="sonorisation_taxe_sacem" name="sonorisation_taxe_sacem">
				 						</div>
				 					</div>
				 				</div>
	 						</div>
	 					</div>
	 				</div>

	 				<h2 class="customLabel">Autres</h2>
	 				<div class="table">
	 					<div>
	 						<div>
	 							<div class="table">
				 					<div>
				 						<div>
				 							<label for="autre_gardinnage" class="subtitle">Prestation de gardiennage</label>
				 						</div>
				 						<div class="selectChekbox">
				 							<input type="checkbox" id="autre_gardinnage" name="autre_gardinnage">
				 						</div>
				 					</div> 
				 				</div>
				 				<div class="table remise">
				 					<div>
				 						<div>
				 							<label class="subtitle">REMISE COMMERCIALE</label>
				 						</div>
				 						<div>
				 							<input type="text" name="remise_montant" placeholder="Montant &euro;">
				 						</div>
				 						<div>
				 							&nbsp;&nbsp;OU&nbsp;&nbsp;
				 						</div>
				 						<div>
				 							<input type="text" name="remise_pourcentage" placeholder="%">
				 						</div>
				 					</div> 
				 				</div>
				 				<div>
				 					<input type="text" name="remise_label" placeholder="Libellé de la remise">
				 				</div>
	 						</div> 
	 					</div>
	 				</div>
	 			</div>

	 			<div class="item-2"> 

		 			<div class="table">
		 				<div>
		 					<div class="customLabel">
		 						DEVIS <br>estimatif
		 					</div>
		 					<div class="inputContainer">
		 						<input type="text" name="devis" disabled> 
		 						<span>€</span>
		 					</div>
		 				</div>
		 			</div>

		 			<div class="reduction">
		 				<p>
		 					<strong>profitez de la réduction early birds</strong>
		 					si vous réservez 6 mois avant la date de l’événement
		 				</p>
		 			</div>	

		 			<div class="recevoir-devis">
		 				<h2>recevoir le DEVIS détaillé <span>?</span></h2>
		 			</div>	

		 			<div class="table blockEmail">
			 			<div>
			 				<div class="emailInput">
			 					<input type="text" name="email" placeholder="Votre e-mail">
			 				</div>
			 				<div class="submitInput">
			 					<button type="button" id="buttonDemandeDevis">Envoyer</button>
			 				</div>
			 			</div>
		 			</div>
	 			</div>

	 		</div>
	 	</div>  
	 	<input type="hidden" name="depotAddress" value="<?= getDepotAddress() ?>">
	 	<div class="clear"></div>
	 </form>
</div>

<!-- Modal -->
<div id="demandeDevis" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="loader">
      	<div></div>
      	<p class="percent"><span>100</span>%</p>
      </div>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">recevoir votre devis</h4>
      </div>
      <div class="modal-body">
        <p>Indiquer vos noms et adresses pour recevoir votre devis </p>
        <form class="form-horizontal" id="SendDevis">
	        <div class="form-group">
			    <label  class="col-sm-3 control-label">ADRESSE MAIL</label>
			    <div class="col-sm-9">
			      <input class="form-control" name="email" placeholder="">
			    </div>
			</div>

			<div class="form-group">
			    <label  class="col-sm-3 control-label">TÉLÉPHONE</label>
			    <div class="col-sm-4">
			      <input class="form-control" name="tel" placeholder="">
			    </div>
			</div>

			<div class="form-group">
			    <label  class="col-sm-3 control-label">SOCIÉTÉ</label>
			    <div class="col-sm-9">
			      <input class="form-control" name="societe" placeholder="">
			    </div>
			</div>

			<div class="form-group">
			    <label  class="col-sm-3 control-label">NOM</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name="fname" placeholder="">
			    </div>
			    <div class="col-sm-5">
			      <input class="form-control" name="lname" placeholder="">
			    </div>
			</div>

			<div class="form-group">
			    <label  class="col-sm-3 control-label">ADRESSE</label>
			    <div class="col-sm-9">
			      <input class="form-control" name="address1" placeholder="">
			    </div>
			</div> 

			<div class="form-group">
			    <label  class="col-sm-3 control-label"></label>
			    <div class="col-sm-9">
			      <input class="form-control" name="address2" placeholder="">
			    </div>
			</div>

			<div class="form-group">
			    <label  class="col-sm-3 control-label">ADRESSE</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name="cp" placeholder="CP">
			    </div>
			    <div class="col-sm-5">
			      <input class="form-control" name="ville" placeholder="Ville">
			    </div> 
			</div>
			<div class="form-group">
			    <label  class="col-sm-3 control-label"></label> 
			    <div class="col-sm-9">
			      <input class="form-control" name="pays" placeholder="Pays">
			    </div>
			</div>
			<div class="privacy-policy">
				<p>
					<a href="#" id="open-privacy-policy"> Consultez nos conditions générales </a>
				</p>
				<div class="content-privacy-policy" style="display: none;">
				 	<?= getConditionsGenerales() ?>
				</div>

				</div>
			</div>

			<div class="submitBTN">
				<button type="button" class="btn btn-large" id="ButtonSendDevis">Recevoir votre devis</button>
			</div>

			<p class="footer-modal">
				ATHEM - 2 rue René Bazin - 75106 Paris - <br>Siret : 39258871100037
			</p> 

		</form>
      </div>  
    </div>

  </div>
</div>

<!-- Modal -->
<div id="sent" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">MERCI</h4>
      </div>
      <div class="modal-body"> 
      	
      	<center> 
      		<p>
      			Vous allez recevoir très prochainement votre devis <br>
      			à l'adresse <span id="email"> ....@....com </span>
      		</p>
      		<div class="submitBTN">
				<a class="btn btn-large" data-dismiss="modal">A BIENTOT</a>
			</div>
      	</center>
      </div>
	</div> 
  </div>
</div>

<div id="error" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Erreur</h4>
      </div>
      <div class="modal-body">  
      	<center style="padding: 20px 10px"> 
      		 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
      	</center>
      </div>
	</div> 
  </div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jcf.js"></script>  
<script type="text/javascript" src="js/jcf.range.js"></script>  
<script type="text/javascript" src="js/jcf.select.js"></script>  
<script type="text/javascript" src="js/jcf.checkbox.js"></script>  
<script type="text/javascript" src="js/ie.js"></script>  
<script type="text/javascript" src="js/jquery-validate.js"></script> 
<script type="text/javascript" src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script> 
<script type="text/javascript" src="js/bootstrap-datepicker.fr.js"></script>   
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places,geometry,geocoder&key=AIzaSyDdE2jgrKygv7hNryyAkvlr3zQq3c_wBu8&language=fr"></script>   

<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript"> 
$(function() {
	jcf.replaceAll();
 
	$('[name=dateDebut]').datepicker({
		 format: 'dd-mm-yyyy',  
		 autoclose: true,
		 startDate: getDate(2),
		 language: "fr"
	}).on('changeDate', function (event) {  
		$('[name=dateFin]').datepicker('setStartDate', event.date );

		calculate();

	});	
	$('[name=dateFin]').datepicker({
		 format: 'dd-mm-yyyy', 
		 autoclose: true,
		 startDate: getDate(3),
		 language: "fr"
	}).on('changeDate', function (event) {  
		$('[name=dateDebut]').datepicker('setEndDate', event.date );

		calculate();

	});	 
}); 
</script>
</body>
</html>