<?php

class EnonceManager
{
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
        $_SESSION['lastInsertIdEnonce'] = $this->lastInsertId;

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


    public function getTypeDonneVariablePresentDansEnonce($idEnonce)
    {
        $listeTypeDonnee = array();
        $req = $this->db->prepare(
            "  SELECT DISTINCT t.idType , t.libelle FROM type_donnee t INNER JOIN donnee_variable dv ON t.idType = dv.idType
      INNER JOIN sujet_possible sp ON sp.idDonneeVariable = dv.idDonneeVariable WHERE sp.idSujet IN
      (SELECT s.idSujet FROM sujet s WHERE s.idEnonce = :idEnonce)"
        );
        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_INT);
        $req->execute();
        while ($typeDonnee = $req->fetch(PDO::FETCH_OBJ)) {
            $listeTypeDonnee[] = new TypeDonnee($typeDonnee);
        };
        $req->closeCursor();
        return $listeTypeDonnee;
    }


    /**
     * Retourne true si le nombre d'énoncés corrigés diffère du nombre total d'énoncé
     * @return boolean true si le nombre d'énoncés corrigés diffère du nombre total d'énoncé
     */
    public function checkUnfinishedCorrection()
    {
        $req = $this->db->prepare(" SELECT count(DISTINCT q.idEnonce) AS nb FROM enonce e JOIN questions q ON q.idEnonce = e.idEnonce JOIN solutions s ON s.idQuestion = q.idQuestion");
        $req->execute();
        $nbCorrections = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $nbEnonce = $this->compterEnonce();
        return $nbCorrections['nb'] != $nbEnonce;
    }


    /**
     * Retourne true si l'enonce dont l'id est passée en parametre n'a pas de correction
     * @param integer - l'id de l'énoncé à verifier
     * @return boolean - true si l'enonce dont l'id est passée en parametre n'a pas de correction
     */
    public function checkUnfinishedCorrectionById($idEnonce)
    {
        $req = $this->db->prepare(" SELECT count(DISTINCT q.idEnonce) AS nb FROM enonce e JOIN questions q ON q.idEnonce = e.idEnonce JOIN solutions s ON s.idQuestion = q.idQuestion WHERE e.idEnonce = :idEnonce ");
        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_STR);
        $req->execute();
        $nbCorrections = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $nbCorrections['nb'] != 1;
    }

    /**
     * @param $idEnonce
     * @return bool
     */
    public function supprimerEnonce($idEnonce) {
        $req = $this->db->prepare("DELETE FROM enonce WHERE idEnonce = :idEnonce");
        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }

}
