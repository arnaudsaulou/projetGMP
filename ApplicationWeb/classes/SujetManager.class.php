<?php

class SujetManager{

  //Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet Sujet à partir d'un tableau
	public function createSujetDepuisTableau($paramsSujet){
		return new Sujet($paramsSujet);
	}

  public function getSQLQueryFromListDonneeVariable($listIdDonneeVariable){

    $this->recursive(count($listIdDonneeVariable),$listIdDonneeVariable);

  }


  public function recursive($iteration, $listIdDonneeVariable){
    $this->toto($listIdDonneeVariable);
    echo "Sujet : ".$iteration." DonneeVariable : <br/>";

    if($iteration != 0){
      $this->recursive($iteration - 1,$listIdDonneeVariable);
    }
  }


  public function toto($listIdTypeDonnee){

    $donneeVariableManager = new DonneeVariableManager($this->db);

    foreach ($listIdTypeDonnee as $idTypeDonnee) {

      $listOfDonneeVariable = $donneeVariableManager->getListOfDonneesVariableByIdTypeDonnee($idTypeDonnee);

      foreach ($listOfDonneeVariable as $donneeVariable) {
        echo $donneeVariable->getValeur()."<br/>";
      }

    }
  }


















  // //TODO OK SI ON FAIT UNE VIEW POUR CHAQUE SUJET
  // public function getSQLQueryFromListDonneeVariable($listDonneeVariable){
  //   $selectOn = '';
  //   $join = '';
  //
  //   for($i=0; $i <= count($listDonneeVariable); $i++){
  //
  //     if($i == count($listDonneeVariable) - 1){
  //       $selectOn = $selectOn.'d'.$i.'.`idDonneeVariable`';
  //     } else if ($i < count($listDonneeVariable) - 1) {
  //       $selectOn = $selectOn.'d'.$i.'.`idDonneeVariable` , ';
  //     }
  //
  //
  //     if($i == count($listDonneeVariable) - 1){
  //       $join = $join.
  //       '(SELECT * FROM `donnees_variable` WHERE `idType` = '.($i+1).') AS d'.$i;
  //     } else if ($i < count($listDonneeVariable) -1) {
  //       $join = $join.
  //       '(SELECT * FROM `donnees_variable` WHERE `idType` = '.($i+1).') AS d'.$i.' , ';
  //     }
  //
  //   }
  //
  //   $query = 'SELECT '.$selectOn.' FROM '.$join;
  //
  //   return $query;
  // }


}

?>