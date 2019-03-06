<?php

class Formule {

  public static function Intervale_x_ValeurValeur($prametres){
    //Extraction des paramètres (ne pas modifier)
    $intervale = $prametres[0];
    $valeurValeur = $prametres[1];

    // ------------------------------------ //
    //  Coder ci-dessous la fonction voulu  //
    // ------------------------------------

    var_dump($prametres);

    return $intervale * $valeurValeur;
  }

}

//////////////////////////////////////////
//     Utilitaire (ne pas modifier)    //
/////////////////////////////////////////
$formule = new Formule;
echo json_encode($formule->Intervale_x_ValeurValeur($_POST['listeValeurDonneeVariable']));
?>
