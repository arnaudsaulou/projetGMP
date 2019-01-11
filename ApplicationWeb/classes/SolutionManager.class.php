<?php

class SolutionManager {
    private $db;

    /**
     * Génère une nouvelle instance de SolutionManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une instance de Solution à partir d'un tableau associatif contenant les données nécessaires à la création
     * de cette instance.
     * @param array $paramsSolution Un tableau associatif contenant les données nécessaires à la création de cette
     * instance.
     * @return Solution Une instance de Solution contenant les donnees du tableau comme valeurs.
     */
    public function createSolutionDepuisTableau($paramsSolution)
    {
        return new Solution($paramsSolution);
    }

    /**
     * Ajoute une instance de Solution dans la base de données.
     * @param Solution $newSolution L'instance de Solution à enregistrer dans la base de données.
     * @return bool Est-ce que l'insertion s'est bien déroulée ?
     */
    public function ajouterSolution($newSolution)
    {
        $req = $this->db->prepare(
            "INSERT INTO solutions(idSujet, idQuestion, valeur) VALUES (:idSujet , :idQuestion , :valeur)"
        );
        $req->bindValue(':idSujet', $newSolution->getIdSujet(), PDO::PARAM_INT);
        $req->bindValue(':idQuestion', $newSolution->getIdQuestion(), PDO::PARAM_INT);
        $req->bindValue(':valeur', $newSolution->getValeur(), PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }
}