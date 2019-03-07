<?php

class ReponseManager
{
    private $db;

    /**
     * Crée une nouvelle instance de ReponseManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Enregistre une Réponse dans la base de données.
     * @param Reponse $reponse La réponse à enregistrer.
     * @return bool Si l'insertion s'est bien déroulée.
     */
    public function enregistrerReponse($reponse)
    {
        $sql = $this->db->prepare("INSERT INTO reponses VALUES(0, :idUtilisateur, :idSujet, :idQuestion, :valeur, :dateReponse)");
        $sql->bindValue(":idUtilisateur", $reponse->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(":idSujet", $reponse->getIdSujet(), PDO::PARAM_INT);
        $sql->bindValue(":idQuestion", $reponse->getIdQuestion(), PDO::PARAM_INT);
        $sql->bindValue(":valeur", $reponse->getValeur(), PDO::PARAM_STR);
        $sql->bindValue(":dateReponse", $reponse->getDateReponse(), PDO::PARAM_STR);
        $resultat = $sql->execute();
        $sql->closeCursor();
        return $resultat;
    }

    /**
     * Supprime toutes les instances de Réponse liées à l''Utilisateur ayant l'id spécifié.
     * @param integer $id L'ID représentant l'Utilisateur dont on veut supprimer les instances de Réponse.
     */
    public function supprimerReponsesAvecIdEtudiant($id)
    {
        $req = $this->db->prepare("DELETE FROM reponses WHERE idUtilisateur = :id");
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * Vérifie l'existence dans la base de données d'une Réponse à la question numeroQuestion du sujet idSujet
     * pour l'utilisateur idUtilisateur.
     * @param integer $idSujet L'identifiant unique du Sujet concerné.
     * @param integer $numeroQuestion Le numéro de la question concernée.
     * @param integer $idUtilisateur L'identifiant unique de l'Utilisateur concerné.
     * @return bool Un booléen indiquant s'il existe au moins une Réponse pour les paramètres donnés.
     */
    public function verifierExistenceReponse($idSujet, $numeroQuestion, $idUtilisateur)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM reponses WHERE idSujet = :idSujet AND idUtilisateur = :idUtilisateur AND idQuestion = :numeroQuestion");
        $sql->bindValue(":idSujet", $idSujet, PDO::PARAM_INT);
        $sql->bindValue(":numeroQuestion", $numeroQuestion, PDO::PARAM_INT);
        $sql->bindValue(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
        $sql->execute();
        $resultat = $sql->fetch();
        $sql->closeCursor();
        return ($resultat > 0);
    }

    /**
     * Récupère la Réponse d'un Utilisateur donné, pour une question et un sujet donnés, la plus récente dans la base
     * de données.
     * @param integer $idSujet L'identifiant unique du Sujet concerné.
     * @param integer $numeroQuestion Le numéro de la question concernée.
     * @param integer $idUtilisateur L'identifiant unique de l'Utilisateur concerné.
     * @return Reponse L'instance de Réponse la plus récente correspondant aux critères.
     */
    public function recupererReponseLaPlusRecente($idSujet, $numeroQuestion, $idUtilisateur)
    {
        $sql = $this->db->prepare("SELECT * FROM reponses WHERE idSujet = :idSujet AND idUtilisateur = :idUtilisateur AND idQuestion = :numeroQuestion ORDER BY dateReponse DESC LIMIT 1");
        $sql->bindValue(":idSujet", $idSujet, PDO::PARAM_INT);
        $sql->bindValue(":numeroQuestion", $numeroQuestion, PDO::PARAM_INT);
        $sql->bindValue(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
        $sql->execute();
        $resultatRequete = $sql->fetch(PDO::FETCH_OBJ);
        $sql->closeCursor();
        return new Reponse($resultatRequete);
    }

    /**
     * Récupère la liste des controles disponible pour un étudiant.
     * @param integer $idEtudiant , l'ID de l'étudiant.
     * @return array Le tableau des controles disponible pour un étudiant.
     */
    public function getListControleDisponible($idEtudiant)
    {
        $req = $this->db->prepare(
            'SELECT s.idSujet,
      nomEnonce,
      cooldown,
      (SELECT MAX(note) FROM note WHERE idUtilisateur = :idUtilisateur AND idSujet=s.idSujet) as meilleureNote,
      (SELECT COUNT(DISTINCT dateReponse) FROM reponses WHERE idUtilisateur = :idUtilisateur AND idSujet=s.idSujet) as nbReponses,
      (SELECT MAX(dateReponse) FROM reponses WHERE idUtilisateur = :idUtilisateur AND idSujet=s.idSujet) as derniereRep,
      ADDDATE((SELECT MAX(dateReponse) FROM reponses WHERE idUtilisateur = :idUtilisateur AND idSujet=s.idSujet), INTERVAL cooldown DAY) as tempsAttente
      FROM enonce e
      JOIN sujet s ON e.idEnonce=s.idEnonce
      JOIN attribue a ON s.idSujet=a.idSujet
      WHERE a.idUtilisateur = :idUtilisateur
      ');
        $req->bindValue(":idUtilisateur", $idEtudiant, PDO::PARAM_INT);
        $req->execute();
        $listeControleDispo = array();
        while ($controle = $req->fetch(PDO::FETCH_OBJ)) {
            $listeControleDispo[] = $controle;
        }
        $req->closeCursor();
        return $listeControleDispo;
    }

    /**
     * Compte le nombre de réponses envoyées par un utilisateur sur un sujet en particulier
     * @param integer $idUtilisateur L'identifiant unique de l'Utilisateur concerné.
     * @param integer $idSujet L'identifiant unique du sujet concerné.
     * @return integer le nombre de réponses envoyées par l'utilisateur
     */
    public function countNombreDeReponse($idUtilisateur, $idSujet)
    {
        $sql = $this->db->prepare("SELECT COUNT(DISTINCT dateReponse) FROM enonce e JOIN sujet s ON e.idEnonce=s.idEnonce JOIN reponses r ON r.idSujet=s.idSujet WHERE idUtilisateur = :idUtilisateur and  s.idSujet = :idSujet");
        $sql->bindValue(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
        $sql->bindValue(":idSujet", $idSujet, PDO::PARAM_INT);
        $sql->execute();
        $resultat = $sql->fetch();
        $sql->closeCursor();
        return $resultat;
    }


    /**
     * Récupère le nombre de réponse recues sur tout les controles confondus et sur tout les étudiants confondus sur les x derniers jours.
     * @param integer $nbJours Le nombre de jours dans le passé sur lesquels on doit chercher les réponses
     * @return array Un tableau contenant le nombre de réponses par jour
     */
    public function getNbReponses($nbJours)
    {
        $dateDuJour = date("Y-m-d");
        $listeNbRep = array();
        while ($nbJours >= 0) {
            $dateVoulue = new DateTime('-' . $nbJours . ' day');
            $dateVoulue = $dateVoulue->format('Y-m-d');
            $nbJours--;
            $req = $this->db->prepare('SELECT COUNT( note) as nombre FROM note WHERE dateReponse = :dateVoulue');
            $req->bindValue(":dateVoulue", $dateVoulue, PDO::PARAM_STR);
            $req->execute();
            $listeNbRep[] = $req->fetch(PDO::FETCH_OBJ)->nombre;
        }
        $req->closeCursor();
        return $listeNbRep;
    }

    public function supprimerReponsesViaIdSujet($idSujet) {
        $req = $this->db->prepare("DELETE FROM reponses WHERE idSujet = :idSujet");
        $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }
}
