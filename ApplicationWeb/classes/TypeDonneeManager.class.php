<?php

class TypeDonneeManager
{
    private $db;

    /**
     * Génère une nouvelle instance de TypeDonneeManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une instance de TypeDonnee à partir d'un tableau associatif contenant les données nécessaires à la création
     * de cette instance.
     * @param array $paramsTypeDonnee Un tableau associatif contenant les données nécessaires à la création de cette
     * instance.
     * @return TypeDonnee Une instance de TypeDonnee contenant les donnees du tableau comme valeurs.
     */
    public function createTypeDonneeDepuisTableau($paramsTypeDonnee)
    {
        return new TypeDonnee($paramsTypeDonnee);
    }

    /**
     * Retourne toutes les instances de TypeDonnee stockées dans la base de données, triées par libellé.
     * @return array Un tableau contenant toutes les instances de TypeDonnee stockées dans la base de données, triées
     * par libellé.
     */
    public function getListTypeDonnee()
    {
        $listTypeDonnee = array();
        $req = $this->db->prepare("SELECT idType , libelle FROM type_donnees ORDER BY libelle");
        $req->execute();
        while ($typeDonnee = $req->fetch(PDO::FETCH_OBJ)) {
            $listTypeDonnee[] = new TypeDonnee($typeDonnee);
        }
        $req->closeCursor();
        return $listTypeDonnee;
    }

    /**
     * Récupère l'instance de TypeDonnee correspondant à l'ID passé en paramètre.
     * @param integer $idTypeDonnee L'ID de l'instance de TypeDonnee dont on veut récupérer les données.
     * @return TypeDonnee L'instance de TypeDonnee correspondant à l'ID fourni.
     */
    public function getTypeDonneeById($idTypeDonnee)
    {
        $req = $this->db->prepare("SELECT idType , libelle FROM type_donnees WHERE idType = :idType");
        $req->bindValue(':idType', $idTypeDonnee, PDO::PARAM_INT);
        $req->execute();
        $typeDonnee = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        return new TypeDonnee($typeDonnee);
    }

    /**
     * Enregistre une instance de TypeDonnee dans la base de données.
     * @param TypeDonnee $newTypeDonnee L'instance de TypeDonnee à enregistrer.
     * @return bool L'insertion s'est elle bien déroulée ?
     */
    public function ajouterTypeDonne($newTypeDonnee)
    {
        $req = $this->db->prepare("INSERT INTO type_donnees(libelle) VALUES (:libelle)");
        $req->bindValue(':libelle', $newTypeDonnee->getLibelle(), PDO::PARAM_STR);
        $result = $req->execute();
        $_SESSION['newIdTypeDonne'] = $this->db->lastInsertId();
        $req->closeCursor();
        return $result;
    }
}
