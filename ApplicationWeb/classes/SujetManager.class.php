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

		ini_set('max_execution_time', 0);

		if(!empty($listDonneeVariable)){

			$numSujet = 1;

			$req = $this->db->prepare(
				$this->getSQLQueryFromListDonneeVariable($listDonneeVariable)
			);

			$req->execute();

			while($possibilite  = $req->fetch(PDO::FETCH_NUM)){

				$this->addSujetPossible($numSujet,$possibilite);

				$numSujet++;
			}

			$req->closeCursor();

		}
	}

	public function getSQLQueryFromPossibilite($numSujet, $possibilite){

		$selectOn = 'INSERT INTO sujet_possible (idSujet, idDonneeVariable, numDonneeVariable) VALUES  ';

		for ($i=0; $i < count($possibilite); $i++) {
			if($i < count($possibilite) - 1){
				$selectOn = $selectOn.'('.$numSujet.', '.$possibilite[$i].', '.($i+1).'), ';
			} else {
				$selectOn = $selectOn.'('.$numSujet.', '.$possibilite[$i].', '.($i+1).')';
			}
		}

		return $selectOn;

	}

	public function addSujetPossible($numSujet, $possibilite){
		if(!empty($numSujet) && !empty($possibilite)){

			$req = $this->db->prepare(
				$this->getSQLQueryFromPossibilite($numSujet, $possibilite)
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

    $query = 'SELECT '.$selectOn.' FROM '.$join;

    return $query;
  }


}

?>
