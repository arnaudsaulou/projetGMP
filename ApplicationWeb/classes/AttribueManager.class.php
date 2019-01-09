<?php

class AttribueManager {
    private $db;

    /**
     * Retourne une nouvelle instance d'AttribueManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Stocke un Attribue dans la base de données.
     * @param $Attribue L'instance d'Attribue à enregistrer.
     */
    public function addAttribue($Attribue)
    {
        $req = $this->db->prepare
        ('INSERT INTO attribue (idUtilisateur,idSujet,dateAttribution,dateLimite)
		VALUES (:idUtilisateur,:idSujet,:dateAttribution,:dateLimite)');
        $req->bindValue(':idUtilisateur', $Attribue->getIdUtilisateur(), PDO::PARAM_STR);
        $req->bindValue(':idSujet', $Attribue->getIdSujet(), PDO::PARAM_STR);
        $req->bindValue(':dateAttribution', $Attribue->getDateAttribution(), PDO::PARAM_STR);
        $req->bindValue(':dateLimite', $Attribue->getIdUtilisateur(), PDO::PARAM_STR);
        $req->execute();
    }

    /**
     * Retourne une instance d'Attribue à partir de son idUtilisateur et son idSujet.
     * @param $idUtilisateur L'id de l'Utilisateur de l'Attribue à récupérer.
     * @param $idSujet L'id du Sujet de l'Attribue à récupérer.
     * @return Attribue Une instance d'Attribue correspondant aux paramètres spécifiés.
     */
    public function getAttribueById($idUtilisateur, $idSujet)
    {
        $req = $this->db->prepare(
            'SELECT idUtilisateur,idSujet,dateAttribution, dateLimite
						FROM attribue WHERE idUtilisateur= :idUtilisateur && idSujet= :idSujet'
        );
        $req->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
        $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
        $req->execute();
        $attribue = $req->fetch(PDO::FETCH_OBJ);
        return new Attribue($attribue);
        $req->closeCursor();
    }
}
