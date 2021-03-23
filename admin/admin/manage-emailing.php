<?php  require_once '../configdb.php'; 

if( isset($_POST) ):
    
    extract($_POST);
    
    $query = $db->prepare("UPDATE fleurscontent SET champ1 = :champ1 , champ3 = :champ3 , champ5 = :champ5 , champ6 = :champ6 , champ7 = :champ7, champ8 = :champ8, champ9 = :champ9 where page='emailing' ");    
    $query->bindParam(':champ1', $objet); 
    $query->bindParam(':champ3', $texte1); 
    $query->bindParam(':champ5', $bgcolor); 
    $query->bindParam(':champ6', $url); 
    $query->bindParam(':champ7', $texte2); 
    $query->bindParam(':champ8', $textecta); 
    $query->bindParam(':champ9', $textcolor); 

    $query->execute();
endif;
if( isset($_FILES) ):
    
     for ($i=1; $i <= 2 ; $i++) :
        $champs = array('champ2','champ4');
        if( !empty( $_FILES['image'.$i]['name'] ) ):

            $uploaddir = '../email/images/';
            $tab = explode('.', $_FILES['image'.$i]['name']);
            $extention = $tab[count($tab) - 1];
            $name = 'img_emailing_damart_'.$i.'_'.time().'.'.$extention;
            $uploadfile = $uploaddir . basename($name);
            $champ = $champs[$i-1];

            if (move_uploaded_file($_FILES['image'.$i]['tmp_name'], $uploadfile)):
                //////////////// Remove Old Image///////////////
                    $fleurscontent = $db->prepare("SELECT * FROM fleurscontent where page='emailing' ");
                    $fleurscontent->execute(); 
                    $content = $fleurscontent->fetch();  
                    if( file_exists( $uploaddir.$content[$champ] ) ) unlink($uploaddir.$content[$champ]);
                ////////////////////////////////////////////////

                $query = $db->prepare("UPDATE fleurscontent SET   $champ = :champ where page='emailing' ");    
                $query->bindParam(':champ', $name); 
                $query->execute();
            endif;
        endif;
     endfor;

    
endif;
header('Location: emailing.php');   
?>
