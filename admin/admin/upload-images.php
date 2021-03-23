<?php  require_once '../configdb.php';
 
extract($_POST);

$uploaddir = '../images/';
$name = time()."_".$_FILES['file']['name'];
$uploadfile = $uploaddir . basename($name);

if(file_exists( $uploaddir.$name) ) unlink( $uploaddir.$name );

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) { 

	//////////////// Remove Old Image///////////////
	$fleurscontent = $db->prepare("SELECT * FROM fleurscontent where page='index' ");
    $fleurscontent->execute(); 
    $content = $fleurscontent->fetch();    

    if( file_exists( "../images/".$content['champ1'] ) ) unlink("../images/".$content['champ1']);
	////////////////////////////////////////////////

	$query = $db->prepare("UPDATE fleurscontent SET   $champ = :champ where page=:page ");    
    $query->bindParam(':champ', $name);
    $query->bindParam(':page', $page); 
    $query->execute();
	
    $url = $ancre.'#'.$ancre;    


} else {
    $url = '';
}

 header('Location: pages.php?'.$url);   
?>
