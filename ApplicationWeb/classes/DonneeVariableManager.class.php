<?php

class DonneeVariableManager {
    private $db;

    /**
     * DonneeVariableManager constructor.
     * @param MyPDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une nouvelle instance de DonneeVariable depuis un tableau.
     * @param array $paramsDonneeVariable Un tableau associatif contenant les données à associer à la DonneeVariable.
     * @return DonneeVariable Une nouvelle instance de DonneeVariable avec les valeurs du tableau comme membres.
     */
    public function createDonneeVariableDepuisTableau($paramsDonneeVariable)
    {
        return new DonneeVariable($paramsDonneeVariable);
    }

    /**
     * Retourne la liste des DonneesVariables à partir d'un ID de type.
     * @param integer $idTypeDonnee L'ID du type des DonneesVariable que l'on souhaite récupérer.
     * @return array Un tableau contenant les instances de DonneeVariable correspondant à l'ID de type associé.
     */
    public function getListOfDonneesVariableByIdTypeDonnee($idTypeDonnee)
    {
        $listDonneeVariable = array();
        $req = $this->db->prepare(
            "SELECT * FROM donnee_variable WHERE idType = :idType"
        );
        $req->bindValue(':idType', $idTypeDonnee, PDO::PARAM_INT);
        $req->execute();
        while ($donneeVariable = $req->fetch(PDO::FETCH_OBJ)) {
            $listDonneeVariable[] = new DonneeVariable($donneeVariable);
        }
        $req->closeCursor();
        return $listDonneeVariable;
    }

    /**
     * Permet d'enregistrer une DonneeVariable dans la base de données.
     * @param DonneeVariable $newDonneeVariable La DonneeVariable à enregistrer.
     * @return bool Indique si l'insertion s'est bien déroulée.
     */
    public function ajouterDonneeVariable($newDonneeVariable)
    {
        $req = $this->db->prepare(
            "INSERT INTO donnee_variable(idType, valeur) VALUES (:idType , :valeur)"
        );
        $req->bindValue(':idType', $newDonneeVariable->getIdType(), PDO::PARAM_INT);
        $req->bindValue(':valeur', $newDonneeVariable->getValeur(), PDO::PARAM_INT);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }

    /**
     * Génère un tableau de données variables à partir d'un tableau représentant un interval.
     * @param array $interval Un tableau contenant une borne inférieure et une borne superieure, ainsi qu'un pas.
     * @return array Un tableau contenant des DonneesVariables.
     */
    public function genererListeDonneeVariableViaInterval($interval)
    {
        $listeDonneesVariables = array();
        for ($valeur = $interval['borneInferieurInterval']; $valeur <= $interval['borneSuperieurInterval']; $valeur += $interval['pasInterval']) {
            $listeDonneesVariables[] = $this->createDonneeVariableDepuisTableau(array('idType' => $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
        }
        return $listeDonneesVariables;
    }

    /**
     * Génère un tableau de données variables à partir d'un tableau de valeurs possibles.
     * @param array $liste Un tableau contenant les différentes valeurs possibles.
     * @return array Un tableau contenant des DonneesVariables.
     */
    public function genererListeDonneeVariableViaListe($liste)
    {
        $listeDonneesVariables = array();
        foreach ($liste as $valeur) {
            $listeDonneesVariables[] = $this->createDonneeVariableDepuisTableau(array('idType' => $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
        }
        return $listeDonneesVariables;
    }
}
