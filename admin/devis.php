<?php   
	if(isset($_GET['id'])):
		include '../inc/functions.php';
 
		$result = generatePDFDevis( $_GET['id'] );
		extract($result);
		include '../inc/generatePdfDevis.php'; 
		$dompdf->stream('Devis_'.$infos['devisNumber'].'.pdf',array('Attachment'=>0));
	endif;
?>