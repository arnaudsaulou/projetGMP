<?php

class Enonce{

  //Déclarations des variables de la classe Enonce
  private $idEnonce;
  private $enonce;

  //Constructeur de la classe Enonce
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet Sujet
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {

        case 'idEnonce':
            $this->setIdEnonce($valeur);
            break;

        case 'enonce':
            $this->setenonce($valeur);
            break;

        default:
          echo "Fatal error : construction Sujet invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdEnonce($new_idEnonce){
    $this->idEnonce = $new_idEnonce;
  }

  public function setenonce($new_enonce){
    $this->enonce = $new_enonce;
  }

  //Getter//

  public function getIdEnonce(){
    return $this->idEnonce;
  }

  public function getenonce(){
    return $this->enonce;
  }
}

?>
