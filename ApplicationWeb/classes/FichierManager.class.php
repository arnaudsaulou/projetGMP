<?php

class FichierManager {

  public function __construct(){}

  public function getListeFormules($dirname){

    //on récupère la liste des formule de correction disponible
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

}
?>
