<?php

class UtilisateurManager
{
    private $db;

    /**
     * Retourne une nouvelle instance de UtilisateurManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Enregistre un Utilisateur dans la base de données.
     * @param Utilisateur $Utilisateur L'utilisateur à enregistrer.
     */
    public function addUtilisateur($Utilisateur)
    {
        $req = $this->db->prepare
        ('INSERT INTO utilisateur (estProf,nom,prenom,nomUtilisateur,motDePasse)
    VALUES (:estProf,:nom,:prenom,:login,:pwd)');
        $req->bindValue(':estProf', $Utilisateur->getEstProf(), PDO::PARAM_STR);
        $req->bindValue(':nom', $Utilisateur->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $Utilisateur->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':login', $Utilisateur->getNomUtilisateur(), PDO::PARAM_STR);
        $req->bindValue(':pwd', $Utilisateur->getMotDePasse(), PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * Retourne un tableau contenant tous les utilisateurs du système (professeurs & élèves).
     * @return array Un tableau contenant tous les utilisateurs du système (professeurs & élèves).
     */
    public function getList()
    {
        $req = $this->db->prepare('SELECT idUtilisateur,estProf,nom,prenom FROM utilisateur ORDER BY nom');
        $req->execute();
        $listeUtilisateur = array();
        while ($Utilisateur = $req->fetch(PDO::FETCH_OBJ)) {
            $listeUtilisateur[] = new Utilisateur($Utilisateur);
        }
        $req->closeCursor();
        return $listeUtilisateur;
    }

    /**
     * Retourne un tableau contenant tous les élèves.
     * @return array Un tableau contenant tous les élèves.
     */
    public function getListEtudiants()
    {
        $req = $this->db->prepare('SELECT idUtilisateur,estProf,nom,prenom FROM utilisateur WHERE estProf = 0 ORDER BY nom');
        $req->execute();

        $listeUtilisateur = array();

        while ($Utilisateur = $req->fetch(PDO::FETCH_OBJ)) {
            $listeUtilisateur[] = new Utilisateur($Utilisateur);
        }
        $req->closeCursor();
        return $listeUtilisateur;
    }

    /**
     * Retourne le nombre d'utilisateurs enregistrés dans la base de données.
     * @return integer Le nombre d'utilisateurs enregistrés dans la base de données.
     */
    public function countUtilisateurs()
    {
        $req = $this->db->prepare("SELECT count(idUtilisateur) AS total FROM utilisateur");
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $nbUtilisateur = $res->total;
        $req->closeCursor();
        return $nbUtilisateur;
    }

    /**
     * Retourne le nombre d'étudiants enregistrés dans la base de données.
     * @return integer Le nombre d'étudiants enregistrés dans la base de données.
     */
    public function countEtudiants()
    {
        $req = $this->db->prepare("SELECT count(idUtilisateur) AS total FROM utilisateur WHERE estProf = 0");
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $nbUtilisateur = $res->total;
        $req->closeCursor();
        return $nbUtilisateur;
    }

    /**
     * @param string $login Le nom d'utilisateur de l'Utilisateur à récupérer.
     * @return Utilisateur|null L'instance d'Utilisateur liée au login passé en paramètre, ou null s'il n'existe pas.
     */
    public function getUtilisateurByLogin($login)
    {
        $req = $this->db->prepare
        ("SELECT idUtilisateur,estProf,nom,prenom,nomUtilisateur,motDePasse  FROM utilisateur WHERE nomUtilisateur = :login");
        $req->bindValue(':login', $login, PDO::PARAM_STR);
        $req->execute();
        $resu = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        if ($resu != null) {
            return new Utilisateur($resu);
        } else {
            return null;
        }
    }

    /**
     * Determine si un Utilisateur est un etudiant à partir de son ID.
     * @param integer $id L'ID de l'Utilisateur à contrôler.
     * @return mixed
     */
    public function estEtudiantById($id)
    {
        $req = $this->db->prepare(
            'SELECT idUtilisateur FROM etudiant WHERE idUtilisateur = :id'
        );
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $res;
    }

    /**
     * Retourne une instance d'Utilisateur à partir de son ID.
     * @param integer $id L'ID de l'Utilisateur à récupérer.
     * @return Utilisateur L'instance d'Utilisateur associé à cet ID.
     */
    public function getUtilisateurById($id)
    {
        $req = $this->db->prepare(
            'SELECT idUtilisateur,estProf,nom, prenom, nomUtilisateur, motDePasse FROM utilisateur WHERE idUtilisateur= :id'
        );
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        return new Utilisateur($res);
    }

    /**
     * Calcule la moyenne d'un Etudiant.
     * @param Utilisateur $etudiant L'etudiant dont on souhaite récupérer la moyenne.
     * @return double La moyenne d'un Etudiant.
     */
    public function calculerMoyenne($etudiant)
    {
        $id = $etudiant->getIdUtilisateur();
        $req = $this->db->prepare(
            'SELECT AVG(note) AS moyenne FROM note WHERE idUtilisateur = :id'
        );
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        $moyenne = $res->moyenne;
        $req->closeCursor();
        return $moyenne;
    }
}
