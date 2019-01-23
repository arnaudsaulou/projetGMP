<?php

class DonneeCalculeeManager {
    private $db;

    /**
     * DonneeCalculeeManager constructor.
     * @param MyPDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une nouvelle instance de DonneeCalculee depuis un tableau.
     * @param array $paramsDonneeCalculee Un tableau associatif contenant les données à associer à la DonneeCalculee.
     * @return DonneeCalculee Une nouvelle instance de DonneeCalculee avec les valeurs du tableau comme membres.
     */
    public function createDonneeCalculeeDepuisTableau($paramsDonneeCalculee)
    {
        return new DonneeCalculee($paramsDonneeCalculee);
    }


    /**
     * Permet d'enregistrer une DonneeCalculee dans la base de données.
     * @param DonneeCalculee $newDonneeCalculee La DonneeCalculee à enregistrer.
     * @return bool Indique si l'insertion s'est bien déroulée.
     */
    public function ajouterDonneeCalculee($newDonneeCalculee)
    {
        $req = $this->db->prepare(
            "INSERT INTO donnee_calculee(idType, nomFormule, tableauIdParams) VALUES (:idType , :nomFormule , :tableauIdParams)"
        );
        $req->bindValue(':idType', $newDonneeCalculee->getIdType(), PDO::PARAM_INT);
        $req->bindValue(':nomFormule', $newDonneeCalculee->getNomFormule(), PDO::PARAM_STR);
        $req->bindValue(':tableauIdParams', $newDonneeCalculee->getTableauIdParams(), PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }
    //
    // /**
    //  * Génère un tableau de données Calculees à partir d'un tableau représentant un interval.
    //  * @param array $interval Un tableau contenant une borne inférieure et une borne superieure, ainsi qu'un pas.
    //  * @return array Un tableau contenant des DonneesCalculees.
    //  */
    // public function genererListeDonneeCalculeeViaInterval($interval)
    // {
    //     $listeDonneesCalculees = array();
    //     for ($valeur = $interval['borneInferieurInterval']; $valeur <= $interval['borneSuperieurInterval']; $valeur += $interval['pasInterval']) {
    //         $listeDonneesCalculees[] = $this->createDonneeCalculeeDepuisTableau(array('idType' => $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
    //     }
    //     return $listeDonneesCalculees;
    // }
    //
    // /**
    //  * Génère un tableau de données Calculees à partir d'un tableau de valeurs possibles.
    //  * @param array $liste Un tableau contenant les différentes valeurs possibles.
    //  * @return array Un tableau contenant des DonneesCalculees.
    //  */
    // public function genererListeDonneeCalculeeViaListe($liste)
    // {
    //     $listeDonneesCalculees = array();
    //     foreach ($liste as $valeur) {
    //         $listeDonneesCalculees[] = $this->createDonneeCalculeeDepuisTableau(array('idType' => $_SESSION['newIdTypeDonne'], 'valeur' => $valeur));
    //     }
    //     return $listeDonneesCalculees;
    // }
    //
    //
    // /**
    //  * Retourne un objet DonneeCalculee à partir de son ID.
    //  * @param integer $idDonneeCalculee L'ID de la DonneeCalculee dont on veut le ID du type.
    //  * @return integer Un objet DonneeCalculee associé à l'id passée en paramètre.
    //  */
    // function recupererDonneeCalculeeViaIdDonneeCalculee($idDonneeCalculee)
    // {
    //     $req = $this->db->prepare(
    //         "SELECT idTyp FROM donnee_Calculee WHERE idDonneeCalculee = :idDonneeCalculee"
    //     );
    //     $req->bindValue(':idDonneeCalculee', $idDonneeCalculee, PDO::PARAM_INT);
    //     $donneeCalculee = new DonneeCalculee($req->fetch(PDO::FETCH_OBJ));
    //     $req->closeCursor();
    //
    //     return $donneeCalculee;
    // }
    //
    //
    // function recupererValeurDonneCalculeeViaTableauIdDonneeCalculee($tableauIdDonneeCalculee){
    //
    //   $tableauValeurDonneCalculee = array();
    //   foreach ($tableauIdDonneeCalculee as $idDonneeCalculee) {
    //     $donneeCalculee = $this->recupererDonneeCalculeeViaIdDonneeCalculee($idDonneeCalculee);
    //     $tableauValeurDonneCalculee[] = $donneeCalculee->getValeur();
    //   }
    //
    //   return $tableauValeurDonneCalculee;
    // }
}
