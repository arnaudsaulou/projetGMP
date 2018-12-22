<?php

class SujetPossibleManager{

	private $db;
	private $donneeVariableManager;

  //Conctructeur
	public function __construct($db){
		$this->db = $db;
		$this->donneeVariableManager = new DonneeVariableManager($db);
	}

	//Fonction permettant de créer un objet SujetPossible à partir d'un tableau
	public function createSujetPossibleDepuisTableau($paramsSujetPossible){
		return new SujetPossible($paramsSujetPossible);
	}

	//fonction permettant de lister tous les donnée variable via l'id du sujet
  public function recuperListeDonneeVariableViaIdSujet($idSujet){

    if(!empty($idSujet)){

      $req = $this->db->prepare(
        'SELECT `idDonneeVariable` , `idType` , `valeur` FROM `donnees_variable` WHERE `idDonneeVariable` IN
          ( SELECT `idDonneeVariable` FROM `sujet_possible` WHERE `idSujet` = :idSujet)
        ');

      $req->bindValue(":idSujet", $idSujet, PDO::PARAM_INT);

      $req->execute();

      $listeDonneeVariable=array();

      while($donneeVariable = $req->fetch(PDO::FETCH_OBJ)){
        $listeDonneeVariable[] = new DonneeVariable($donneeVariable);
      }

      $req->closeCursor();

      return $listeDonneeVariable;
    }
  }


  //fonction permettant de lister tous les donnée variable via l'id du sujet
  public function recuperListeValeurDonneeVariableViaIdSujet($listeIdTypeDonnee, $idSujet){

    if(!empty($listeIdTypeDonnee) && !empty($idSujet)){

      $listeDonneeVariable = $this->recuperListeDonneeVariableViaIdSujet($idSujet);
      $listeValeur = array();

      foreach ($listeIdTypeDonnee as $idTypeDonnee) {

        $compteur = 0;
        $trouve = FALSE;

      while($compteur < count($listeDonneeVariable) - 1 && !$trouve){

            if($idTypeDonnee == $listeDonneeVariable[$compteur]->getIdType()){
              $listeValeur[] = $listeDonneeVariable[$compteur]->getValeur();
              $trouve = TRUE;
            }

            $compteur++;
          }
      }
      return $listeValeur;
    }
  }

}

?>
