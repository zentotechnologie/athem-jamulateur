<?php ob_start();?>
<!DOCTYPE html>
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
				font-family: "DejaVuSans";
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
						<h2><?= _translate_admin('devisNumber') ?>. <?= $infos['devisNumber'] ?></h2>
					</td>
				</tr>
			</table>

			<table style="margin-top: 5px;margin-bottom: 5px">
				<tr>
					<td>
						<table class="infoDevis">
							<tr>
								<td align="right">
									<?= _translate_admin('devisDate') ?>
								</td>
								<td>
									<?= $infos['dateDevis'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('devisReference') ?>	
								</td>
								<td>
									 <?= $infos['devisNumber'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('clientName') ?>	
								</td>
								<td>
									 <?= $infos['fname'] ?> <?= $infos['lname'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('devisValidateDate') ?>	
								</td>
								<td>
									 <?= $infos['validateDate'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('paymentMethod') ?>
								</td>
								<td>
									 <?= _translate_admin('paymentMethodValue') ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('from') ?>
								</td>
								<td>
									 <table width="100%" cellpadding="0" cellspacing="0">
									 	<tr>
									 		<td width="70"><?= $infos['contact']['name'] ?></td>
									 		<td><?= _translate_admin('shortPhoneLabel') ?> <?= $infos['contact']['tel'] ?></td>
									 	</tr>
									 </table>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('to') ?>
								</td>
								<td>
									 <table width="100%" cellpadding="0" cellspacing="0">
									 	<tr>
									 		<td width="70"><?= $infos['fname'] ?> <?= $infos['lname'] ?></td>
									 		<td><?= _translate_admin('shortPhoneLabel') ?> <?= preg_replace('#(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})#', '$1.$2.$3.$4.$5', $infos['tel']) ?></td>
									 	</tr>
									 </table>
								</td>
							</tr>
							<?php if($infos['domaine']): ?>
								<tr>
									<td align="right">
										<?= _translate_admin('domain') ?>
									</td>
									<td>
										 <?= $infos['domaine'] ?>
									</td>
								</tr>
							<?php endif ?>
							<tr>
								<td align="right">
									<?= _translate_admin('dateStartService') ?>
								</td>
								<td>
									 <?= $infos['dateDebut'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('dateEndService') ?>
								</td>
								<td>
									 <?= $infos['dateFin'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('projectionSurface') ?>
								</td>
								<td>
									 <?= $infos['area'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('nbrOfjamions') ?>
								</td>
								<td>
									 <?= $infos['jamions'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('screeningDays') ?>
								</td>
								<td>
									<?= $infos['nbrJours'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('screeningDaysSetting') ?>
								</td>
								<td>
									<?= $infos['nbrJoursPlusCalage'] - $infos['nbrJours'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('screeningDaysSettingOnSite') ?>	
								</td>
								<td>
									<?= $infos['nbrJoursPlusCalage'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('location') ?>	
								</td>
								<td>
									<?= $infos['lieu'] ?>
								</td>
							</tr>
							<tr>
								<td align="right">
									<?= _translate_admin('city') ?>	
								</td>
								<td>
									<?= $infos['villeEvent'] ?>
								</td>
							</tr>
							<?php if( !empty($infos['paysEvent']) ): ?>
								<tr>
									<td align="right">
										<?= _translate_admin('country') ?>
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
						<h4><?= _translate_admin('recipent') ?> :</h4>
						<p> <?= $infos['societe'] ?><br>
							<?= $infos['fname'] ?> <?= $infos['lname'] ?><br>
							<?= $infos['address1'] ?><br>
							<?= $infos['cp'] ?> - <?= $infos['ville'] ?><br>
							<?= $infos['pays'] ?>
						</p>
					</td>
				</tr>
			</table>

			<p style="text-align: left; padding: 5px;background:#f3f3f3;">
				<?= _translate_admin('devisIntroduction') ?>
			</p>

			<table style="margin-top: 10px;" class="detailDevis" cellpadding="0" cellspacing="0">
				<tr>
					<th><?= _translate_admin('description') ?></th>
					<th><?= _translate_admin('quantities') ?></th> 
					<th align="right"><?= _translate_admin('units') ?></th> 
					<th align="right"><?= _translate_admin('unitPriceHT') ?></th> 
					<th align="right"><?= _translate_admin('totalHT') ?></th> 
					<th align="center"><?= _translate_admin('tvaPercent') ?></th> 
					<th align="right"><?= _translate_admin('tva') ?></th> 
					<th align="right"><?= _translate_admin('totalTTC') ?></th> 
				</tr> 
				<?php if( $subTotal['videoMapimg']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							<?= _translate_admin('videoMaping') ?>
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
									echo _translate_admin('originalCreation');
									break; 

								case 'pretJammer':
									echo _translate_admin('readyToJam');
									break; 

								case 'performanceArt':
									echo _translate_admin('customContent');
									break; 
							} ?>
						</td>
						<td align="right"><?= $DataCalcule['visuel']['qte'] ?></td> 
						<td><?php echo $DataCalcule['visuel']['type'] == 'performanceArt' ? _translate_admin('flatRate') : _translate_admin('minutes') ?></td>
						<td align="right"><?= number_format($DataCalcule['visuel']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['visuel']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
		
				
				<!-- <?php if( $DataCalcule['video_jamions']['totalHT'] > 0 ): ?>
					<tr>
						<td>Installation des jamions (compris une soirée de projection)</td>
						<td align="right">1</td>
						<td>Forfait</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_jamions']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?> -->
				

				
					<tr>
						<td><?= _translate_admin('rentalAndOperationOfTheJamion') ?></td>
						<td align="right">1</td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['JamMobile']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				
				

				<!-- <?php if( $DataCalcule['video_techniciens']['totalHT'] > 0 ): ?>
					<tr>
						<td>Rémunération des techniciens de vidéo mapping</td>
						<td align="right"><?= $DataCalcule['video_techniciens']['qte'] ?> x <?= $infos['nbrJoursPlusCalage'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_techniciens']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?> -->
				
				<!-- <?php if( $DataCalcule['video_hebergement']['totalHT'] > 0 ): ?>
					<tr>
						<td>Hébergement des techniciens de vidéo mapping</td>
						<td align="right"><?= $DataCalcule['video_hebergement']['qte'] ?> x <?= $infos['nbrJoursPlusCalage'] ?></td>
						<td>Jour(s)</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_hebergement']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?> -->
				
				<?php if( $DataCalcule['video_transport']['totalHT'] > 0 ): ?>
					<tr>
						<td><?= _translate_admin('transport') ?></td>
						<td align="right"><?= $DataCalcule['video_transport']['qte'] ?></td>
						<td>Km</td>
						<td align="right"><?php echo $infos['jamions'] ?> x <?= number_format($DataCalcule['video_transport']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['video_transport']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>









				
				<?php if( $subTotal['sonorisation']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							<?= _translate_admin('soundSystem') ?>
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
									echo  _translate_admin('originalCreation');
									break; 

								case 'pretJammer':
									echo  _translate_admin('existingMusic');
									break; 

								case 'pasDeSon':
									echo _translate_admin('noSound');
									break; 
							} ?>
							
						</td>
						<td align="right"><?= $DataCalcule['son']['qte'] ?></td>
						<td><?= _translate_admin('minutes') ?></td>
						<td align="right"><?= number_format($DataCalcule['son']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['son']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['son']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['son']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>

				
				
					<tr>
						<td><?= _translate_admin('rentalOfSoundUnitsLightEquipment') ?></td>
						<td align="right"><?= $DataCalcule['sonorisation_unite']['qte'] ?> </td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['prixUnitaire'] + $DataCalcule['JamSon']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['totalHT'] + $DataCalcule['JamSon']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['TVA'] + $DataCalcule['JamSon']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_unite']['TotalTTC'] + $DataCalcule['JamSon']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				

				
				<!-- <?php if( $DataCalcule['JamSon']['totalHT'] > 0 ): ?>
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
				<?php endif ?> -->
				
				<?php if( $DataCalcule['sonorisation_techniciens']['totalHT'] > 0 ): ?>
					<tr>
						<td><?= _translate_admin('technicalTeam') ?></td>
						<td align="right"><?= $DataCalcule['sonorisation_techniciens']['qte'] ?> x <?= $infos['nbrJoursPlusCalage'] ?></td>
						<td><?= _translate_admin('days') ?></td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_techniciens']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>
				
				<?php if( $DataCalcule['sonorisation_hebergement']['totalHT'] > 0 ): ?>
					<tr>
						<td><?= _translate_admin('technicalTeamExpenses') ?></td>
						<td align="right"><?= $DataCalcule['sonorisation_techniciens']['qte'] ?> x <?= $infos['nbrJoursPlusCalage'] ?></td>
						<td><?= _translate_admin('days') ?></td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_hebergement']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?> 
				
				<!-- <?php if( $DataCalcule['sonorisation_transport']['totalHT'] > 0 ): ?>
					<tr>
						<td>Transport du matériel</td>
						<td align="right"><?= $DataCalcule['sonorisation_transport']['qte'] ?></td>
						<td>Km</td>
						<td align="right"><?= $DataCalcule['sonorisation_unite']['qte'] ?> x <?= number_format($DataCalcule['sonorisation_transport']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['sonorisation_transport']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?> -->


				<?php $ForfaisTexts = GetForfaisTexts(); ?>


				
				<?php if( $DataCalcule['GestDemarAdmin']['totalHT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							<?= _translate_admin('administrativeProcedures') ?>
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
						<td><?php echo $ForfaisTexts['options'][3]['name'] ?></td>
						<td align="right"><?= $DataCalcule['GestDemarAdmin']['qte'] ?></td>
						<td><?= _translate_admin('flatRate') ?></td>
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
						<?= _translate_admin('options') ?>
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
						<td><?php echo $ForfaisTexts['options'][0]['name'] ?></td>
						<td align="right"><?= $DataCalcule['captationVideo']['qte'] ?></td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['captationVideo']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr> 
				<?php endif ?>


				<?php if( $DataCalcule['teaser']['totalHT'] > 0 ): ?>
					<tr>
						<td><?php echo $ForfaisTexts['options'][1]['name'] ?></td>
						<td align="right"><?= $DataCalcule['teaser']['qte'] ?></td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['teaser']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['teaser']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['teaser']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['teaser']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>  
				<?php endif ?>
				

				<?php if( $DataCalcule['liveVideo']['totalHT'] > 0 ): ?>
					<tr>
						<td><?php echo $ForfaisTexts['options'][2]['name'] ?></td>
						<td align="right"><?= $DataCalcule['liveVideo']['qte'] ?></td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['liveVideo']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?>


				<?php if( $DataCalcule['affiche']['totalHT'] > 0 ): ?>
					<tr>
						<td><?php echo $ForfaisTexts['options'][4]['name'] ?></td>
						<td align="right"><?= $DataCalcule['affiche']['qte'] ?></td>
						<td><?= _translate_admin('flatRate') ?></td>
						<td align="right"><?= number_format($DataCalcule['affiche']['prixUnitaire'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['totalHT'],2,',',' ' ) ?> €</td>
						<td align="center">20%</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['TVA'],2,',',' ' ) ?> €</td>
						<td align="right"><?= number_format($DataCalcule['affiche']['TotalTTC'],2,',',' ' ) ?> €</td>
					</tr>
				<?php endif ?> 

				
				<?php if( $subTotal['autres']['HT'] > 0 ): ?>
					<tr class="subTotal">
						<td>
							<?= _translate_admin('other') ?>
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
						<td><?= _translate_admin('days') ?></td>
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
						<?= _translate_admin('termsOfPayment') ?>
					</td>
					<td width="200">
						<table class="total" cellpadding="0" cellspacing="0">
							<tr>
								<td><?= _translate_admin('totalHT') ?></td>
								<td align="right"><?= number_format($Total['HT'],2,',',' ' ) ?> €</td>
							</tr>
							<!-- <?php //if( $remise ): ?> 
								<tr>
									<td><?= empty($remise['label']) ? 'Remise' : $remise['label'] ?></td>
									<td align="right"><?= $remise['value'] ?></td>
								</tr>
								<tr>
									<td>Nouveau total HT</td>
									<td align="right"><?= number_format($Total['HTR'],2,',',' ' ) ?> €</td>
								</tr>
							<?php //endif ?> -->
							<tr>
								<td><?= _translate_admin('tva') ?></td>
								<td align="right"><?= number_format($Total['TVA'],2,',',' ' ) ?> €</td>
							</tr>
							<tr class="trTotal">
								<td><?= _translate_admin('totalTTC') ?></td>
								<td align="right"><?= number_format($Total['TTC'],2,',',' ' ) ?> €</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			

			<table style="margin-top: 20px;margin-bottom: 10px;">
				<tr>
					<td>
						<?= _translate_admin('signatureContactText') ?> 
						<br>
						<br>
						<?= $infos['contact']['name'] ?><br>  	 	 	 	 	 
						<?= $infos['contact']['email'] ?><br>
						<?= $infos['contact']['tel'] ?>
					</td>
					<td width="40">
						
					</td>
					<td width="250" align="center" style="background:#f3f3f3;padding-top: 10px">
						<?= _translate_admin('signature') ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td style="font-size: 8px; color: #383838"><?= _translate_admin('underSignatureText') ?></td>
				</tr>
			</table>

		</div>
		<div style="page-break-after: always;"></div>
		<div class="content-privacy-policy" style="padding-top: 20px">
			  <?= getConditionsGenerales(getCurrendLang()) ?>
		</div>

		<div style="border-top: 2px solid #aaa;padding-top: 10px; position: absolute;width: 100%;bottom: 0;">
			<table class="footer">
				<tr>
					<td width="160">
						<h3>The JAM PROJECT</h3>
						<table >
							<tr>
								<td>2, rue René Bazin</td>
							</tr>
							<tr>
								<td>75016 PARIS - FRANCE</td>
							</tr>
							<tr>
								<td>www.thejamproject.com</td>
							</tr>
							<tr>
								<td>RCS Paris 851 989 608</td>
							</tr>
							<tr>
								<td>N° TVA intracommunautaire FR18 851 989 608</td>
							</tr> 
						</table>
									
					</td>
					<td>
						<h3>CONATACT</h3>
						<table>
							<tr>
								<td width="50"><?= $infos['contact']['name'] ?></td>
								<td><?= $infos['contact']['function'] ?></td>
							</tr>
							<tr>
								<td><?= _translate_admin('phone') ?> :</td>
								<td><?= $infos['contact']['tel'] ?></td>
							</tr>
							<tr>
								<td><?= _translate_admin('email') ?> :</td>
								<td><?= $infos['contact']['email'] ?></td>
							</tr>
						</table>
					</td>
					<td width="150">
						<h3><?= _translate_admin('bankDetail') ?></h3>
						<table>
							<tr>
								<td width="50"><?= _translate_admin('bank') ?></td>
								<td>SOCIÉTÉ GÉNÉRALE</td>
							</tr>
							<tr>
								<td><?= _translate_admin('bankCode') ?></td>
								<td>30003</td>
							</tr>
							<tr>
								<td><?= _translate_admin('accountNumber') ?></td>
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

<?php $html = ob_get_clean();
	header( 'content-type: text/html; charset=utf-8' );
	require_once '../libraries/dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	 
	$dompdf->loadHtml($html,'UTF-8');
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();  
	// $dompdf->stream("codexworld",array("Attachment"=>0)); die()
	
?>