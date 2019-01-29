<?php

class SujetManager {
    private $db;
    private $donneeVariableManager;

    /**
     * SujetManager constructor.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->donneeVariableManager = new DonneeVariableManager($db);
    }

    /**
     * Génère une instance de Sujet à partir d'un tableau associatif contenant les données que doit contenir l'instance.
     * @param array $paramsSujet Un tableau associatif contenant les données que doit contenir l'instance.
     * @return Sujet Une instance de Sujet avec les données du tableau fourni comme valeurs.
     */
    public function createSujetDepuisTableau($paramsSujet)
    {
        return new Sujet($paramsSujet);
    }

    //Cette fonction permet de générer un sujet à partir d'une liste de données variable
    public function generateSujet($listDonneeVariable)
    {
        ini_set('max_execution_time', 0);
        if (!empty($listDonneeVariable)) {

            $numSujet = $this->getLastIdSujet();

            if($numSujet == ''){
              $numSujet = 1;
            } else {
              $numSujet++;
            }

            $req = $this->db->prepare(
                $this->getSQLQueryFromListDonneeVariable($listDonneeVariable)
            );
            $req->execute();

            while ($possibilite = $req->fetch(PDO::FETCH_NUM)) {
                $this->addSujetPossible($numSujet, $possibilite);
                $this->addSujet($numSujet);
                $numSujet++;
            }
            $req->closeCursor();
        }

        unset($_SESSION['lastInsertIdEnonce']);
    }

    /**
     * @param $idSujet
     * @return Sujet
     */
    public function getSujetAvecId($idSujet) {
        $req = $this->db->prepare('SELECT * FROM sujet WHERE idSujet = :idSujet');
        $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
        $req->execute();
        return new Sujet($req->fetch(PDO::FETCH_OBJ));
    }

    //Cette fonction permet de ???
    public function getSQLQueryFromPossibilite($numSujet, $possibilite)
    {
        $selectOn = ' START TRANSACTION;
                      INSERT INTO sujet_possible (idSujet, idDonneeVariable) VALUES';
        for ($i = 0; $i < count($possibilite); $i++) {
            if ($i < count($possibilite) - 1) {
                $selectOn .= '(' . $numSujet . ', ' . $possibilite[$i] . '), ';
            } else {
                $selectOn .= '(' . $numSujet . ', ' . $possibilite[$i] . '); COMMIT;';
            }
        }

        return $selectOn;

    }

    //Cette fonction permet d'ajouter un sujet possible à partir d'un numéro de sujet
    public function addSujetPossible($numSujet, $possibilite)
    {
        if (!empty($numSujet) && !empty($possibilite)) {
            $req = $this->db->prepare($this->getSQLQueryFromPossibilite($numSujet, $possibilite));
            $req->execute();
            $req->closeCursor();
        }
    }

    //TODO: AAAAAAAARGH!
    //Cette fonction permet ???
    public function getSQLQueryFromListDonneeVariable($listDonneeVariable)
    {
        $selectOn = '';
        $join = '';

        for ($i = 0; $i <= count($listDonneeVariable); $i++) {
            if ($i == count($listDonneeVariable) - 1) {
                $selectOn .= 'd' . $i . '.`idDonneeVariable` AS `idDonneeVariableSujet' . $i . '`';
                $join .= '(SELECT * FROM `donnee_variable` WHERE `idType` = ' . $listDonneeVariable[$i] . ') AS d' . $i;
            } else if ($i < count($listDonneeVariable) - 1) {
                $selectOn .= 'd' . $i . '.`idDonneeVariable` AS `idDonneeVariableSujet' . $i . '`, ';
                $join .= '(SELECT * FROM `donnee_variable` WHERE `idType` = ' . $listDonneeVariable[$i] . ') AS d' . $i . ' , ';
            }
        }

        $query = 'SELECT ' . $selectOn . ' FROM ' . $join;
        return $query;
    }

    /**
     * Retourne le nombre d'Enonces stockés dans la base de données.
     * @return integer Le nombre d'Enonces stockés dans la base de données.
     */
    public function countSujet()
    {
        $req = $this->db->prepare("SELECT count(idEnonce) AS total FROM enonce");
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $nbSujet = $res->total;
        $req->closeCursor();
        return $nbSujet;
    }

    /**
     * Récupère tous les Enonces disponibles dans la base de données.
     * @return array Un tableau contenant toutes les instances d'Enonce disponibles dans la base de données.
     */
    public function getListEnonces()
    {
        $req = $this->db->prepare('SELECT idEnonce, enonce FROM enonce ORDER BY idEnonce');
        $req->execute();
        $listeSujet = array();
        while ($sujet = $req->fetch(PDO::FETCH_OBJ)) {
            $listeSujet[] = new Enonce($sujet);
        }
        $req->closeCursor();
        return $listeSujet;
    }

	public function getSujetById($id){
		$req=$this->db->prepare(
			'SELECT idSujet, idEnonce FROM sujet WHERE idSujet=:id'
		);
		$req->bindValue(':id',$id,PDO::PARAM_INT);
		$req->execute();
		$res=$req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();
		return new Sujet($res);
	}


  public function getLastIdSujet(){
    $req = $this->db->prepare('SELECT idSujet FROM sujet_possible ORDER BY idSujet DESC LIMIT 1');
    $req->execute();
    $lastIdSujet = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $lastIdSujet['idSujet'];
  }

  public function addSujet($numSujet)
  {

    $req = $this->db->prepare(
        "INSERT INTO sujet(idSujet, idEnonce) VALUES (:idSujet , :idEnonce)"
    );

    $req->bindValue(':idSujet', $numSujet, PDO::PARAM_INT);
    $req->bindValue(':idEnonce', $_SESSION['lastInsertIdEnonce'], PDO::PARAM_INT);
    $result = $req->execute();
    $req->closeCursor();
  }
}
