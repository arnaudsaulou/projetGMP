<?php

class AttribueManager
{
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
     * @param Attribue $Attribue L'instance d'Attribue à enregistrer.
     */
    public function addAttribue($Attribue)
    {
        $req = $this->db->prepare(
            'INSERT INTO attribue(idUtilisateur,idSujet,dateAttribution,dateLimite,cooldown)
		VALUES (:idUtilisateur,:idSujet,:dateAttribution,:dateLimite,:cooldown)');
        $req->bindValue(':idUtilisateur', $Attribue->getIdUtilisateur(), PDO::PARAM_STR);
        $req->bindValue(':idSujet', $Attribue->getIdSujet(), PDO::PARAM_STR);
        $req->bindValue(':dateAttribution', $Attribue->getDateAttribution(), PDO::PARAM_STR);
        $req->bindValue(':dateLimite', $Attribue->getDateLimite(), PDO::PARAM_STR);
        $req->bindValue(':cooldown', $Attribue->getCooldown(), PDO::PARAM_STR);
        $req->execute();
    }

    /**
     * Retourne une instance d'Attribue à partir de son idUtilisateur et son idSujet.
     * @param integer $idUtilisateur L'id de l'Utilisateur de l'Attribue à récupérer.
     * @param integer $idSujet L'id du Sujet de l'Attribue à récupérer.
     * @return Attribue Une instance d'Attribue correspondant aux paramètres spécifiés.
     */
    public function getAttribueById($idUtilisateur, $idSujet)
    {
        $req = $this->db->prepare(
            'SELECT idUtilisateur,idSujet,dateAttribution, dateLimite, cooldown
						FROM attribue WHERE idUtilisateur= :idUtilisateur && idSujet= :idSujet'
        );
        $req->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
        $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
        $req->execute();
        $attribue = new Attribue($req->fetch(PDO::FETCH_OBJ));
        return $attribue;
        $req->closeCursor();
    }

    /**
     * @param $idEtudiant
     * @return array
     */
    public function getAttribuePourEtudiant($idEtudiant) {
        $req = $this->db->prepare(
            'SELECT idSujet,dateAttribution, dateLimite
						FROM attribue WHERE idUtilisateur = :idUtilisateur');
        $req->bindValue(':idUtilisateur', $idEtudiant, PDO::PARAM_STR);
        $req->execute();
        $listeAttribue = array();
        while ($res = $req->fetch(PDO::FETCH_OBJ)) {
            $listeAttribue[] = new Attribue($res);
        }
        $req->closeCursor();
        return $listeAttribue;
    }

    /**
     * Supprime toutes les instances de Attribue liées à l''Utilisateur ayant l'id spécifié.
     * @param integer $id L'ID représentant l'Utilisateur dont on veut supprimer les instances d'Attribue.
     */
    public function supprimerAttribueAvecIdEtudiant($id)
    {
        $req = $this->db->prepare("DELETE FROM attribue WHERE idUtilisateur = :id");
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * Retourne un tableau avec la liste de tous les Utilisateurs n'ayant pas répondu au Sujet spécifié.
     * @param integer $idSujet L'ID du Sujet dont on veut récupérer les élèves n'ayant pas répondu.
     * @return array Un tableau avec toutes les instances d'Utilisateur n'ayant pas répondu au sujet.
     */
    public function getListeElevesNAyantPasRepondu($idSujet)
    {
        $req = $this->db->prepare(
             'SELECT idUtilisateur FROM utilisateur WHERE estProf = 0 AND idUtilisateur NOT IN (
                SELECT idUtilisateur FROM reponses WHERE idSujet = :idSujet
                HAVING COUNT(idUtilisateur) > 0
            ) AND idUtilisateur IN (
                SELECT idUtilisateur FROM attribue WHERE idSujet = :idSujet
            )
        ');
        $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
        $req->execute();
        $listeEleves = array();
        while ($eleve = $req->fetch(PDO::FETCH_OBJ)) {
            $listeEleves[] = $eleve;
        }
        $req->closeCursor();
        return $listeEleves;
    }

    /**
     * Retourne le plus petit identifiant d'un sujet par énoncé
     * @param integer $idEnonce L'ID de l'énoncé dont on veut récupérer le plus petit id.
     * @return integer
     */
    public function getIdSujetMinimumByIdEnonce($idEnonce)
    {
        $req = $this->db->prepare(
          'SELECT MIN(idSujet) as idSujetMin FROM sujet WHERE idEnonce = :idEnonce
				');

        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_INT);
        $req->execute();
        $idSujet = $req->fetch(PDO::FETCH_OBJ);
        $idSujetMin = $idSujet->idSujetMin;
        $req->closeCursor();
        return $idSujetMin;
    }

    /**
     * Retourne le plus grand identifiant d'un sujet par énoncé
     * @param integer $idEnonce L'ID de l'énoncé dont on veut récupérer le plus grand id.
     * @return integer
     */
    public function getIdSujetMaximumByIdEnonce($idEnonce)
    {
        $req = $this->db->prepare(
          'SELECT MAX(idSujet) as idSujetMax FROM sujet WHERE idEnonce = :idEnonce
				');

        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_INT);
        $req->execute();
        $idSujet = $req->fetch(PDO::FETCH_OBJ);
        $idSujetMax = $idSujet->idSujetMax;
        $req->closeCursor();
        return $idSujetMax;
    }

    /**
     * Retourne le nombre de sujet attribué à un étudiant enregistrés dans la base de données.
     * @param integer $idEtudiant, l'ID de l'étudiant
     * @return integer Le nombre de sujet attribué à un étudiant enregistrés dans la base de données.
     */
    public function countNombreDeSujetAttribuerAUnEtudiant($idEtudiant)
    {
        $req = $this->db->prepare("SELECT count(idSujet) AS total FROM attribue WHERE idUtilisateur = :idEtudiant");
        $req->bindValue(':idEtudiant', $idEtudiant, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $nbSujet = $res->total;
        $req->closeCursor();
        return $nbSujet;
    }

    /**
     * Retourne la liste des id des sujets déjà attribué aux étudiants.
     * @return integer la liste des id des sujets déjà attribué aux étudiants.
     */
    public function getUniqueIdSujet($annee)
    {
      $req = $this->db->prepare("SELECT idSujet FROM attribue a JOIN utilisateur u ON a.idUtilisateur = u.idUtilisateur WHERE annee = :annee ");
      $req->bindValue(':annee', $annee, PDO::PARAM_STR);
      $req->execute();
      $listeIdSujet = array();
      while ($idSujet = $req->fetch(PDO::FETCH_ASSOC)) {
           $listeIdSujet[] = (int) $idSujet['idSujet'];
      }
      $req->closeCursor();
      return $listeIdSujet;
    }

    /**
     * Retourne un tableau contenant toutes les instances d'Attributions.
     * @return array Un tableau contenant toutes les instances d'Attributions.
     */
    public function getListAttribution()
    {
      $req = $this->db->prepare('SELECT DISTINCT annee, nomEnonce, dateAttribution, dateLimite, cooldown, s.idEnonce FROM attribue a JOIN utilisateur u ON a.idUtilisateur = u.idUtilisateur JOIN sujet s ON s.idSujet = a.idSujet JOIN enonce e ON s.idEnonce = e.idEnonce ');
      $req->execute();

      $listeAttribution = array();
      while ($attribu = $req->fetch(PDO::FETCH_OBJ)) {
          $listeAttribution[] = $attribu;
      }
      $req->closeCursor();
      return $listeAttribution;
    }

    public function getAnneeByIdUtilisateur($idUtilisateur)
    {
      $req = $this->db->prepare("SELECT  annee FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
      $req->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
      $req->execute();
      $res = $req->fetch(PDO::FETCH_ASSOC);
      $req->closeCursor();
      return $res['annee'];

    }

}
