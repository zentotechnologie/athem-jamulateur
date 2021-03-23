<?php
  namespace Chirp;
  require_once '../../configdb.php';

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  $result = $db->prepare("SELECT * FROM fleursusers ");
  $result->execute();

  while($row = $result->fetch()):
      $data[] = array( 
                        utf8_decode('Date & Heure') => date('d-m-y H:i',$row['timestamp']), 
                        utf8_decode('Civilité') =>utf8_decode($row['civilite']) , 
                        'Nom' =>utf8_decode($row['nom']) , 
                        utf8_decode('Prénom') =>utf8_decode($row['prenom']) ,   
                        utf8_decode('Téléphone') =>utf8_decode($row['tel']) , 
                        'E-mail' =>utf8_decode($row['email']) , 
                        'Optin' =>$row['nwl'] ? 'Oui' : 'Non'
                     );
  endwhile; 
  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // file name for download
  $filename = "users.xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }

  exit;
?>