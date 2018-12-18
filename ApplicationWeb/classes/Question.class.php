<?php

class Question{

  //Déclarations des variables de la classe Question
  private $idQuestion;
  private $libelle;

  //Constructeur de la classe Question
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet Question
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'idQuestion':
          $this->setIdQuestion($valeur);
          break;

        case 'libelle':
            $this->setLibelle($valeur);
            break;

        default:
          echo "Fatal error : construction Question invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdQuestion($new_idQuestion){
    $this->idQuestion = $new_idQuestion;
  }

  public function setLibelle($new_libelle){
    $this->libelle = $new_libelle;
  }

  //Getter//

  public function getIdQuestion(){
    return $this->idQuestion;
  }

  public function getLibelle(){
    return $this->libelle;
  }

}

?>
