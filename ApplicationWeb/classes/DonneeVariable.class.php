<?php

class DonneeVariable{

  //Déclarations des variables de la classe DonneeVariable
  private $idDonneeVariable;
  private $idType;
  private $valeur;

  //Constructeur de la classe DonneeVariable
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet DonneeVariable
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'idDonneeVariable':
          $this->setIdDonneeVariable($valeur);
          break;

        case 'idType':
            $this->setIdType($valeur);
            break;

        case 'valeur':
            $this->setValeur($valeur);
            break;

        default:
          echo "Fatal error : construction DonneeVariable invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdDonneeVariable($new_idDonneeVariable){
    $this->idDonneeVariable = $new_idDonneeVariable;
  }

  public function setIdType($new_idType){
    $this->idType = $new_idType;
  }

  public function setValeur($new_valeur){
    $this->valeur = $new_valeur;
  }

  //Getter//
  public function getIdDonneeVariable(){
    return $this->idDonneeVariable;
  }

  public function getIdType(){
    return $this->idType;
  }

  public function getValeur(){
    return $this->valeur;
  }
}

?>
