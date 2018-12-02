<?php

class Sujet{

  //Déclarations des variables de la classe Sujet
  private $idSujet;
  private $idEnonce;

  //Constructeur de la classe Sujet
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet Sujet
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {

        case 'idSujet':
            $this->setIdSujet($valeur);
            break;

        case 'idEnonce':
            $this->setIdEnonce($valeur);
            break;

        default:
          echo "Fatal error : construction Sujet invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdSujet($new_idSujet){
    $this->idSujet = $new_idSujet;
  }

  public function setIdEnonce($new_idEnonce){
    $this->idEnonce = $new_idEnonce;
  }

  //Getter//

  public function getIdSujet(){
    return $this->idSujet;
  }

  public function getIdEnonce(){
    return $this->idEnonce;
  }
}

?>
