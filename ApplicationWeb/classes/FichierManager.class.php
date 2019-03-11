<?php

class FichierManager {

  public function __construct(){}

  public function getFichiersPhp($dirname){

    //on récupère la liste des fichier php à un emplacement donné
    $dir = opendir($dirname);

    while ($file = readdir($dir)) {
      if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
        $file = str_replace(".php", "", $file);
        $listeFormules[] = $file;
      }
    }

    closedir($dir);

    return $listeFormules;
  }

  public function getFichiersCsv($dirname){

    //on récupère la liste des fichier php à un emplacement donné
    $dir = opendir($dirname);

    while ($file = readdir($dir)) {
      if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
        $file = str_replace(".csv", "", $file);
        $listeCsv[] = $file;
      }
    }

    closedir($dir);

    return $listeCsv;
  }

}
?>
