<?php

class SujetPossible{

  //Déclarations des variables de la classe SujetPossible
  private $idSujet;
  private $idDonneeVariable;

  //Constructeur de la classe SujetPossible
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet SujetPossible
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {

        case 'idSujet':
            $this->setIdSujet($valeur);
            break;

        case 'idDonneeVariable':
            $this->setIdDonneeVariable($valeur);
            break;

        default:
          echo "Fatal error : construction SujetPossible invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdSujet($new_idSujet){
    $this->idSujet = $new_idSujet;
  }

  public function setIdDonneeVariable($new_idDonneeVariable){
    $this->idDonneeVariable = $new_idDonneeVariable;
  }

  //Getter//

  public function getIdSujet(){
    return $this->idSujet;
  }

  public function getIdDonneeVariable(){
    return $this->idDonneeVariable;
  }
}

?>
