<?php  
require 'functions.php';  

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$idDevis = 169;  

if( count($_FILES) > 0 ){
	uploadFiles( $idDevis, $_FILES, '../admin/uploads/' );
}


$result = generatePDFDevis( $idDevis );
extract($result);
include 'generatePdfDevis.php';
$output = $dompdf->output();  

file_put_contents( $infos['addAttachment'], $output );  

print_r($infos['addAttachment']); 

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
?>