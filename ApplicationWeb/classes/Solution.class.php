<?php

class Solution{

  //Déclarations des variables de la classe Solution
  private $idSujet;
  private $idQuestion;
  private $valeur;

  //Constructeur de la classe Solution
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet Solution
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'idSujet':
          $this->setIdSujet($valeur);
          break;

        case 'idQuestion':
          $this->setIdQuestion($valeur);
          break;

        case 'libelle':
            $this->setValeur($valeur);
            break;

        default:
          echo "Fatal error : construction Solution invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdSujet($new_idSujet){
    $this->idSujet = $new_idSujet;
  }

  public function setIdQuestion($new_idQuestion){
    $this->idQuestion = $new_idQuestion;
  }

  public function setValeur($new_valeur){
    $this->valeur = $new_valeur;
  }

  //Getter//

  public function getIdSujet(){
    return $this->idSujet;
  }

  public function getIdQuestion(){
    return $this->idQuestion;
  }

  public function getValeur(){
    return $this->valeur;
  }

}

?>
