<?php

class EnonceManager {
    private $db;

    /**
     * Génère une nouvelle instance de EnonceManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une nouvelle instance de Enonce depuis un tableau.
     * @param array $paramsEnonce Un tableau associatif contenant les données à associer à l'Enonce.
     * @return Enonce Une nouvelle instance de Enonce avec les valeurs du tableau comme membres.
     */
    public function createEnonceDepuisTableau($paramsEnonce)
    {
        return new Enonce($paramsEnonce);
    }

    /**
     * Ajoute une instance d'Enonce à la base de données.
     * @param Enonce $newEnonce L'Enonce à ajouter à la base de données.
     * @return bool Est-ce que l'insertion s'est bien déroulée ?
     */
    public function ajouterEnonce($newEnonce)
    {
        $req = $this->db->prepare(
            "INSERT INTO enonce(nomEnonce, enonce) VALUES (:nomEnonce , :enonce)"
        );
        $req->bindValue(':nomEnonce', $newEnonce->getNomEnonce(), PDO::PARAM_STR);
        $req->bindValue(':enonce', $newEnonce->getEnonce(), PDO::PARAM_STR);
        $result = $req->execute();
        $this->lastInsertId = $this->db->lastInsertId();
        $req->closeCursor();

        $questionManager = new QuestionManager($this->db);
        $questionManager->ajouterListeQuestion($this->lastInsertId);
        
        return $result;
    }

    /**
     * Retourne un tableau contenant toutes les instances d'Enonce contenues dans la base de données.
     * @return array Un tableau contenant toutes les instances d'Enonce contenues dans la base de données.
     */
    public function recupererListEnonce()
    {
        $listeEnonce = array();
        $req = $this->db->prepare("SELECT idEnonce, nomEnonce, enonce FROM enonce");
        $req->execute();
        while ($enonce = $req->fetch(PDO::FETCH_OBJ)) {
            $listeEnonce[] = $this->createEnonceDepuisTableau($enonce);
        };
        $req->closeCursor();
        return $listeEnonce;
    }

    /**
     * Récupère une instance d'Enonce à partir de son ID.
     * @param integer $idEnonce L'ID de l'Enonce dont on veut récupérer l'instance.
     * @return Enonce L'instance d'Enonce associée à l'ID fourni.
     */
    public function recupererEnonceViaIdEnonce($idEnonce)
    {
        $req = $this->db->prepare("SELECT idEnonce, nomEnonce, enonce FROM enonce WHERE idEnonce = :idEnonce");
        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_STR);
        $req->execute();
        $enonce = $req->fetch(PDO::FETCH_OBJ);
        $enonce = $this->createEnonceDepuisTableau($enonce);
        $req->closeCursor();
        return $enonce;
    }

    /**
     * Retourne le nombre d'instances d'Enonce enregistrés dans la base de données.
     * @return integer Le nombre d'instances d'Enonce enregistrés dans la base de données.
     */
    public function compterEnonce()
    {
        $req = $this->db->prepare(
			"SELECT count(idEnonce) AS total FROM enonce"
		);
        $req->execute();
        $nbEnonce = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $nbEnonce['total'];
    }


}
