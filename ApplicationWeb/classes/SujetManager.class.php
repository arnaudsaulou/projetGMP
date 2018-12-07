<?php

class SujetManager{

	private $db;
	private $donneeVariableManager;

  //Conctructeur
	public function __construct($db){
		$this->db = $db;
		$this->donneeVariableManager = new DonneeVariableManager($db);
	}

	//Fonction permettant de créer un objet Sujet à partir d'un tableau
	public function createSujetDepuisTableau($paramsSujet){
		return new Sujet($paramsSujet);
	}

	public function generateSujet($listDonneeVariable){

		if(!empty($listDonneeVariable)){

			$req = $this->db->prepare(
				$this->getSQLQueryFromListDonneeVariable($listDonneeVariable)
			);

			$req->execute();

			$req->closeCursor();

		}
	}


  public function getSQLQueryFromListDonneeVariable($listDonneeVariable){
    $selectOn = '';
    $join = '';

    for($i=0; $i <= count($listDonneeVariable); $i++){

      if($i == count($listDonneeVariable) - 1){
        $selectOn = $selectOn.'d'.$i.'.`idDonneeVariable` AS `idDonneeVariableSujet'.$i.'`';
      } else if ($i < count($listDonneeVariable) - 1) {
        $selectOn = $selectOn.'d'.$i.'.`idDonneeVariable` AS `idDonneeVariableSujet'.$i.'`, ';
      }


      if($i == count($listDonneeVariable) - 1){
        $join = $join.
        '(SELECT * FROM `donnees_variable` WHERE `idType` = '.($i+1).') AS d'.$i;
      } else if ($i < count($listDonneeVariable) -1) {
        $join = $join.
        '(SELECT * FROM `donnees_variable` WHERE `idType` = '.($i+1).') AS d'.$i.' , ';
      }

    }

    $query = 'CREATE VIEW sujet1 AS ( SELECT '.$selectOn.' FROM '.$join.')';

    return $query;
  }


}

?>
