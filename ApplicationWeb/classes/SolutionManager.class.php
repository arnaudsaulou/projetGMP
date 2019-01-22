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
            "INSERT INTO solutions(idQuestion, nomFormule, tableauIdParams) VALUES (:idQuestion , :nomFormule , :tableauIdParams)"
        );
        $req->bindValue(':idQuestion', $newSolution->getIdQuestion(), PDO::PARAM_INT);
        $req->bindValue(':nomFormule', $newSolution->getNomFormule(), PDO::PARAM_STR);
        $req->bindValue(':tableauIdParams', $newSolution->getTableauIdParams(), PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }

    /**
     * Récupère l'instance de Solution ayant les idSujet et idQuestion passés en paramètres.
     * @param integer $idQuestion L'ID de la Question à laquelle la Solution désirée répond.
     * @return Solution L'instance de Solution ayant les idSujet et idQuestion passés en paramètres.
     */
    public function recupererSolution($idQuestion) {
        $req = $this->db->prepare('SELECT * FROM solutions WHERE idQuestion = :idQuestion');
        $req->bindValue(':idQuestion', $idQuestion, PDO::PARAM_INT);
        $req->execute();
        $solution = new Solution($req->fetch(PDO::FETCH_OBJ));
        $req->closeCursor();
        return $solution;
    }

}
