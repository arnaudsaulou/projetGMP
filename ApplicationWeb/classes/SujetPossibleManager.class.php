<?php

class SujetPossibleManager {
    private $db;
    private $donneeVariableManager;

    /**
     * Génère une nouvelle instance de SujetPossibleManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->donneeVariableManager = new DonneeVariableManager($db);
    }

    /**
     * Crée une nouvelle instance de SujetPossible depuis un tableau.
     * @param array $paramsSujetPossible Un tableau associatif contenant les données à associer au SujetPossible.
     * @return SujetPossible Une nouvelle instance de Enonce avec les valeurs du tableau comme membres.
     */
    public function createSujetPossibleDepuisTableau($paramsSujetPossible)
    {
        return new SujetPossible($paramsSujetPossible);
    }

    /**
     * Récupère toutes les instances de DonneeVariable liées à l'instance de Sujet fournie.
     * @param integer $idSujet L'instance de Sujet dont on veut récupérer toutes les instances de DonneeVariable.
     * @return array Un tableau contenant toutes les instances de DonneeVariable liées à l'instance de Sujet fournie.
     */
    public function recuperListeDonneeVariableViaIdSujet($idSujet)
    {
        $req = $this->db->prepare(
            'SELECT idDonneeVariable, idType, valeur FROM donnee_variable WHERE idDonneeVariable IN
          ( SELECT idDonneeVariable FROM sujet_possible WHERE idSujet = :idSujet)
        ');
        $req->bindValue(":idSujet", $idSujet, PDO::PARAM_INT);
        $req->execute();
        $listeDonneeVariable = array();
        while ($donneeVariable = $req->fetch(PDO::FETCH_OBJ)) {
            $listeDonneeVariable[] = new DonneeVariable($donneeVariable);
        }
        $req->closeCursor();
        return $listeDonneeVariable;
    }
}
