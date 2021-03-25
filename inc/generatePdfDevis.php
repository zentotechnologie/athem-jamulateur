<?php ob_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'> 
		<title>Devis</title>
		<style type="text/css"> 


			html{margin:20px 20px 20px}
			body {
			    font-family: sans-serif!important; 
			    font-size: 10px;
			}
			body * {
			    font-family: sans-serif!important;  
			}
			table{
				width: 100%;
			} 
			table.detailDevis th{
				font-size: 9px;
				border-bottom: 1px solid #999;
				padding-bottom: 7px;
				padding: 5px 0;
				text-align: center;
				border-right: 1px solid #999;
				border:1px solid #999;
			}
			table.detailDevis td{
				font-size: 8px;  
				padding: 4px;
				border-right: 1px solid #999;
			}
			table.detailDevis tr:last-child td{
				border-bottom: 1px solid #999;
			}
			table.detailDevis tr td:first-child,
			table tr th:first-child{
				border-left: 1px solid #999;
			}
			table.detailDevis tr.subTotal td{
				background: #ddd;
				font-weight: bold;
				font-size: 9px;   
			}
			table.total td{
				font-size: 11px;
				font-weight: bold;
				padding: 5px 0;
			}
			table td.ml{
				font-size: 8px; 
			}
			tr.trTotal td{
				border-top: 2px double #000;
			}
			table.footer{
				font-size: 9px;
			}
			 
			h1,h2,h3,h4,h5{
				margin: 0 0 3px
			}
			td{
				vertical-align: top;
			} 

			.infoDevis td{
				font-size: 9px;
				vertical-align:middle;
			}
			.infoDevis td:nth-child(2){
				font-weight: bold
			}  
			.content-privacy-policy h1{
				font-size: 14px!important;
				text-transform: uppercase;
			} 
			.content-privacy-policy h2{
				text-transform: uppercase;
				font-size: 11px!important;
				margin: 0;
				padding: 0;
			}
			.content-privacy-policy p{ 
				font-size: 10px!important;
			}
		</style>
	</head>
	<body> 
		<div>
			<table>
				<tr>
					<td>
						<h2>THE JAM PROJECT</h2>
						<p style="margin: 0">
							2, rue René Bazin<br>	 	 	 	 	 	 	 
							75016 PARIS - FRANCE
						</p>
					</td>
					<td width="140">
						<h2>DEVIS No. <?= $infos['devisNumber'] ?></h2>
					</td>
				</tr>
			</table>

			<table style="margin-top: 5px;margin-bottom: 5px">
				<tr>
					<td>
						<table class="infoDevis">
							<tr>
								<td align="right">
									Date du devis
								</td>
								<td>
									<?= $infos['dateDevis'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Référence du devis	
								</td>
								<td>
									 <?= $infos['devisNumber'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Nom du Client
								</td>
								<td>
									 <?= $infos['fname'] ?> <?= $infos['lname'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Date de validité du devis
								</td>
								<td>
									 <?= $infos['validateDate'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Modalité de paiement
								</td>
								<td>
									 Acompte 50% - Solde 10 jours avant l'évènement
								</td>
							</tr>
							<tr>
								<td align="right">
									Emis par
								</td>
								<td>
									 <table width="100%" cellpadding="0" cellspacing="0">
									 	<tr>
									 		<td width="70"><?= $infos['contact']['name'] ?></td>
									 		<td>Tél. <?= $infos['contact']['tel'] ?></td>
									 	</tr>
									 </table>
								</td>
							</tr>
							<tr>
								<td align="right">
									Contact client
								</td>
								<td>
									 <table width="100%" cellpadding="0" cellspacing="0">
									 	<tr>
									 		<td width="70"><?= $infos['fname'] ?> <?= $infos['lname'] ?></td>
									 		<td>Tél. <?= $infos['tel'] ?></td>
									 	</tr>
									 </table>
								</td>
							</tr>
							<tr>
								<td align="right">
									Date de début de la prestation
								</td>
								<td>
									 <?= $infos['dateDebut'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Date de fin de la prestation
								</td>
								<td>
									 <?= $infos['dateFin'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Nombre de soirée(s) de projection	
								</td>
								<td>
									<?= $infos['nbrJours'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Nombre de journée(s) de calage / installation
								</td>
								<td>
									2
								</td>
							</tr>
							<tr>
								<td align="right">
									Nombre de soirée(s) sur place	
								</td>
								<td>
									<?= $infos['nbrJours'] + 2 ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Lieu
								</td>
								<td>
									<?= $infos['lieu'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Ville
								</td>
								<td>
									<?= $infos['villeEvent'] ?>
								</td>
							</tr>
							<?php if( !empty($infos['paysEvent']) ): ?>
								<tr>
									<td align="right">
										Pays
									</td>
									<td>
										<?= $infos['paysEvent'] ?>
									</td>
								</tr>
						<?php endif; ?>

						</table> 
					</td>
					<td width="20">
						
					</td>
					<td width="100">
						<h4>DESTINATAIRE :</h4>
						<p> <?= $infos['societe'] ?><br>
							<?= $infos['fname'] ?> <?= $infos['lname'] ?><br>
							<?= $infos['address1'] ?><br>
							<?= $infos['cp'] ?> - <?= $infos['ville'] ?><br>
							<?= $infos['pays'] ?>
						</p>
					</td>
				</tr>
			</table>

			<p style="text-align: right; padding: 5px;background:#f3f3f3;">
				Ce devis sera validé après inspection du site par les équipes d'ATHEM<br> 
				La protection des publics, des biens et du matériel de projection sont à la charge du client<br>	 
				Ce devis n'intègre pas les droits d'utilisation des contenus devant être acquis auprès de tiers,<br>
				ainsi que les éventuels droits d’asile, location d’espace ou taxes.<br>
				Pour une projection de 30 minutes après la tombée de la nuit.
				<!-- <?php //$DataCalcule['visuel']['qte'] ?> -->
			</p>

			<table style="margin-top: 10px;" class="detailDevis" cellpadding="0" cellspacing="0">
				<tr>
					<th>Description</th>
					<th>Quantités</th> 
					<th align="right">Unités</th> 
					<th align="right">Prix unitaires HT</th> 
					<th align="right">TOTAL HT</th> 
					<th align="center">TVA %</th> 
					<th align="right">TVA</th> 
					<th align="right">TOTAL TTC</th> 
				</tr> 
				<?php if( $subTotal['videoMapimg']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							VIDÉO MAPPING
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td align="right"><?= number_format($subTotal['videoMapimg']['HT'],2,',',' ' ) ?> €</td>
						<td></td>
						<td align="right"><?= number_format($subTotal['videoMapimg']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($subTotal['videoMapimg']['TTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>

				<?php if( $DataCalcule['visuel']['totalHT'] > 0 ): ?>
					<tr>
						<td> 
							<?php switch ( $DataCalcule['visuel']['type'] ) {
								case 'creationOriginale':
									echo "Création originale";
									break; 

								case 'pretJammer':
									echo "Bibliothèque de contenus prêts à jammer";
									break; 

								case 'performanceArt':
									echo "Votre contenu: Facturer cahier des charges (1500€ HT) + frais de mise au format (800€ HT)";
									break; 
							} ?>
						</td>
						<td align="right"><?= $DataCalcule['visuel']['qte'] ?></td> 
						<td>Minutes</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
		
				
				<?php if( $DataCalcule['video_jamions']['totalHT'] > 0 ): ?>
					<tr>
						<td>Installation des jamions (compris une soirée de projection)</td>
						<td align="right"><?= $DataCalcule['video_jamions']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>
				

				<?php if( $DataCalcule['JamMobile']['totalHT'] > 0 ): ?>
					<tr>
						<td>Mise à disposition des jamions (jours supplémentaires au delà de la 1ère soirée)</td>
						<td align="right"><?= $DataCalcule['video_jamions']['qte'] ?> x <?= ( $infos['nbrJours'] == 1 ) ? 1 : ($infos['nbrJours'] - 1) ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
				

				<?php if( $DataCalcule['video_techniciens']['totalHT'] > 0 ): ?>
					<tr>
						<td>Rémunération des techniciens de vidéo mapping</td>
						<td align="right"><?= $DataCalcule['video_techniciens']['qte'] ?> x <?= $infos['nbrJoursPlus2'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
				
				<?php if( $DataCalcule['video_hebergement']['totalHT'] > 0 ): ?>
					<tr>
						<td>Hébergement des techniciens de vidéo mapping</td>
						<td align="right"><?= $DataCalcule['video_hebergement']['qte'] ?> x <?= $infos['nbrJoursPlus2'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
				
				<?php if( $DataCalcule['video_transport']['totalHT'] > 0 ): ?>
					<tr>
						<td>Transport des équipes</td>
						<td align="right"><?= $DataCalcule['video_transport']['qte'] ?></td>
						<td>Km</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>









				
				<?php if( $subTotal['sonorisation']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							SONORISATION
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td align="right"><?= number_format($subTotal['sonorisation']['HT'],2,',',' ' ) ?> €</td>
						<td></td>
						<td align="right"><?= number_format($subTotal['sonorisation']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($subTotal['sonorisation']['TTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>

				<?php if( $DataCalcule['son']['totalHT'] > 0 ): ?>
					<tr>
						<td>
						<?php switch ( $DataCalcule['son']['type'] ) {
								case 'creationOriginale':
									echo "Création originale";
									break; 

								case 'pretJammer':
									echo "Musique existante";
									break; 

								case 'pasDeSon':
									echo "Pas de son";
									break; 
							} ?>
							
						</td>
						<td align="right"><?= $DataCalcule['son']['qte'] ?></td>
						<td>Minutes</td>
						<td align="right"><?= number_format($DataCalcule['son']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['son']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['son']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['son']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>

				
				<?php if( $DataCalcule['sonorisation_unite']['totalHT'] > 0 ): ?>
					<tr>
						<td>Installation des unités de son</td>
						<td align="right"><?= $DataCalcule['sonorisation_unite']['qte'] ?> </td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>

				
				<?php if( $DataCalcule['JamSon']['totalHT'] > 0 ): ?>
					<tr>
						<td>Mise à disposition des unités de son</td>
						<td align="right"><?= $DataCalcule['JamSon']['qte'] ?> x <?= $infos['nbrJours'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['JamSon']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamSon']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['JamSon']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamSon']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>
				
				<?php if( $DataCalcule['sonorisation_techniciens']['totalHT'] > 0 ): ?>
					<tr>
						<td>Rémunération des techniciens de son</td>
						<td align="right"><?= $DataCalcule['sonorisation_techniciens']['qte'] ?> x <?= $infos['nbrJoursPlus2'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
				
				<?php if( $DataCalcule['sonorisation_hebergement']['totalHT'] > 0 ): ?>
					<tr>
						<td>Hébergement des techniciens de son</td>
						<td align="right"><?= $DataCalcule['sonorisation_hebergement']['qte'] ?> x <?= $infos['nbrJoursPlus2'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?> 
				
				<?php if( $DataCalcule['sonorisation_transport']['totalHT'] > 0 ): ?>
					<tr>
						<td>Transport des équipes</td>
						<td align="right"><?= $DataCalcule['sonorisation_transport']['qte'] ?></td>
						<td>Km</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>





				
				<?php if( $DataCalcule['GestDemarAdmin']['totalHT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							DEMARCHES ADMINISTRATIVES
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['totalHT'],2,',',' ' ) ?> €</td>
						<td></td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>

				<?php if( $DataCalcule['GestDemarAdmin']['totalHT'] > 0 ): ?>
					<tr>
						<td>Gestion des demarches administratives</td>
						<td align="right"><?= $DataCalcule['GestDemarAdmin']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['GestDemarAdmin']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>



				
				<?php if( $subTotal['options']['HT'] > 0 ): ?>
				<tr class="subTotal">
					<td>
						OPTIONS
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td align="right"><?= number_format($subTotal['options']['HT'],2,',',' ' ) ?> €</td>
					<td></td>
					<td align="right"><?= number_format($subTotal['options']['TVA'],2,',',' ' ) ?> €</td>
					<td align="right"><?= number_format($subTotal['options']['TTC'],2,',',' ' ) ?> €</td>
				</tr> 
				<?php endif ?>


				<?php if( $DataCalcule['captationVideo']['totalHT'] > 0 ): ?>
					<tr>
						<td>Réalisation d'une video de l´evenement</td>
						<td align="right"><?= $DataCalcule['captationVideo']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>


				<?php if( $DataCalcule['liveVideo']['totalHT'] > 0 ): ?>
					<tr>
						<td>Diffusion en LIVE de l'événement sur votre site web et/ou vos réseaux sociaux</td>
						<td align="right"><?= $DataCalcule['liveVideo']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>


				<?php if( $DataCalcule['affiche']['totalHT'] > 0 ): ?>
					<tr>
						<td>Réalisation d'une affiche pour annoncer l'événement</td>
						<td align="right"><?= $DataCalcule['affiche']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>

				<?php if( $DataCalcule['siteWeb']['totalHT'] > 0 ): ?>
					<tr>
						<td>Réalisation d'un site Internet dédié au projet</td>
						<td align="right"><?= $DataCalcule['siteWeb']['qte'] ?></td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['siteWeb']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['siteWeb']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['siteWeb']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['siteWeb']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>  
				<?php endif ?>

				
				<?php if( $subTotal['autres']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							AUTRES
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td align="right"><?= number_format($subTotal['autres']['HT'],2,',',' ' ) ?> €</td>
						<td></td>
						<td align="right"><?= number_format($subTotal['autres']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($subTotal['autres']['TTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>
				<?php if( $DataCalcule['sonorisation_taxe_sacem']['qte'] > 0 ): ?>
					<tr>
						<td>Taxe sacem</td>
						<td align="right"><?= $DataCalcule['sonorisation_taxe_sacem']['qte'] ?></td>
						<td>%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_taxe_sacem']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_taxe_sacem']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_taxe_sacem']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_taxe_sacem']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>

				<?php if( $DataCalcule['autre_gardinnage']['totalHT'] > 0 ): ?>
					<tr>
						<td>Prestation de gardiennage</td>
						<td align="right"><?= $DataCalcule['autre_gardinnage']['qte'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['autre_gardinnage']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['autre_gardinnage']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['autre_gardinnage']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['autre_gardinnage']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>



			</table>
			<table style="margin-top: 10px;" >
				<tr>
					<td class="ml">
						Conditions de règlement : Acompte 50% - Solde 10 jours avant l'évènement
					</td>
					<td width="200">
						<table class="total" cellpadding="0" cellspacing="0">
							<tr>
								<td>Total HT</td>
								<td align="right"><?= number_format($Total['HT'],2,',',' ' ) ?> €</td>
							</tr>
							<?php if( $remise ): ?> 
								<tr>
									<td><?= empty($remise['label']) ? 'Remise' : $remise['label'] ?></td>
									<td align="right"><?= $remise['value'] ?></td>
								</tr>
								<tr>
									<td>Nouveau total HT</td>
									<td align="right"><?= number_format($Total['HTR'],2,',',' ' ) ?> €</td>
								</tr>
							<?php endif ?>
							<tr>
								<td>TVA</td>
								<td align="right"><?= number_format($Total['TVA'],2,',',' ' ) ?> €</td>
							</tr>
							<tr class="trTotal">
								<td>Total TTC</td>
								<td align="right"><?= number_format($Total['TTC'],2,',',' ' ) ?> €</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			

			<table style="margin-top: 20px;margin-bottom: 10px;">
				<tr>
					<td>
						Merci vivement d'avoir sollicité notre atelier,<br>  
						N'hésitez pas à me contacter pour plus de précision,<br> 	 	 	 	 	 	 	 	 
						Très cordialement,
						<br>
						<br>
						<?= $infos['contact']['name'] ?><br>  	 	 	 	 	 
						<?= $infos['contact']['email'] ?><br>
						<?= $infos['contact']['tel'] ?>
					</td>
					<td width="40">
						
					</td>
					<td width="250" align="center" style="background:#f3f3f3;padding-top: 10px">
						Signature du client (précédée de la mention « Bon pour accord »)
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td style="font-size: 8px; color: #383838">Le Client déclare avoir préalablement pris connaissance et accepté les termes des présentes conditions générales et particulières. </td>
				</tr>
			</table>

		</div>
		<div style="page-break-after: always;"></div>
		<div class="content-privacy-policy" style="padding-top: 20px">
			  <?= getConditionsGenerales() ?>
		</div>

		<div style="border-top: 2px solid #aaa;padding-top: 10px; position: absolute;width: 100%;bottom: 0;">
			<table class="footer">
				<tr>
					<td width="160">
						<h3>ATHEM</h3>
						<table >
							<tr>
								<td>2, rue René Bazin</td>
							</tr>
							<tr>
								<td>75016 PARIS - FRANCE</td>
							</tr>
							<tr>
								<td>www.athem-skertzo.com</td>
							</tr>
							<tr>
								<td>No. Siren ou Siret : 39258871100037</td>
							</tr>
							<tr>
								<td>No. TVA intra. : FR02392588711</td>
							</tr> 
						</table>
									
					</td>
					<td>
						<h3>Contact</h3>
						<table>
							<tr>
								<td width="50"><?= $infos['contact']['name'] ?></td>
								<td><?= $infos['contact']['function'] ?></td>
							</tr>
							<tr>
								<td>Téléphone :</td>
								<td><?= $infos['contact']['tel'] ?></td>
							</tr>
							<tr>
								<td>Email :</td>
								<td><?= $infos['contact']['email'] ?></td>
							</tr>
						</table>
					</td>
					<td width="150">
						<h3>Détails bancaires</h3>
						<table>
							<tr>
								<td width="50">Banque</td>
								<td>SOCIÉTÉ GÉNÉRALE</td>
							</tr>
							<tr>
								<td>Code banque</td>
								<td>30003</td>
							</tr>
							<tr>
								<td>No de compte</td>
								<td>25711452</td>
							</tr>
							<tr>
								<td>IBAN</td>
								<td>FR7630003042600002571145216</td>
							</tr>
							<tr>
								<td>SWIFT/BIC</td>
								<td>SOGEFRPP</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		
	</body>
</html> 

<?php  $html = ob_get_clean();

	require_once '../libraries/dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	 
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();  
	// $dompdf->stream("codexworld",array("Attachment"=>0)); 
	
?>