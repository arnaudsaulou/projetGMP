<?php

class TypeDonnee{

  //Déclarations des variables de la classe TypeDonnee
  private $idType;
  private $libelle;

  //Constructeur de la classe TypeDonnee
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet TypeDonnee
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {

        case 'idType':
            $this->setIdType($valeur);
            break;

        case 'libelle':
            $this->setLibelle($valeur);
            break;

        default:
          echo "Fatal error : construction TypeDonnee invalide";
          break;
      }
    }
  }

  //Setter//

  public function setIdType($new_idType){
    $this->idType = $new_idType;
  }

  public function setLibelle($new_libelle){
    $this->libelle = $new_libelle;
  }

  //Getter//

  public function getIdType(){
    return $this->idType;
  }

  public function getLibelle(){
    return $this->libelle;
  }
}

?>
