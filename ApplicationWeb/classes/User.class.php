<?php
class Utilisateur {
    private $idUtilisateur;
    private $estProf;
    private $nom;
    private $prenom;
    private $nomUtilisateur;
    private $motDePasse;

    /**
     * Génère une nouvelle instance d'Utilisateur.
     * @param integer $idUtilisateur L'id de l'Utilisateur. Attribué par la Base de Données.
     * @param integer $estProf Booléen indiquant si l'Utilisateur est un Professeur.
     * @param string $nom Le nom de l'Utilisateur.
     * @param string $prenom Le prénom de l'Utilisateur.
     * @param string $nomUtilisateur Le nom d'utilisateur de l'Utilisateur.
     * @param string $motDePasse - Le mot de passe crypté de l'Utilisateur.
     */
    public function __construct($idUtilisateur, $estProf, $nom, $prenom, $nomUtilisateur, $motDePasse)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->estProf = $estProf;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->nomUtilisateur = $nomUtilisateur;
        $this->motDePasse = $motDePasse;
    }

    /**
     * Retourne l'identifiant de l'Utilisateur.
     * @return integer L'identifiant de l'Utilisateur.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Modifie l'identifiant de l'Utilisateur.
     * @param integer $idUtilisateur Le nouvel identifiant de l'Utilisateur.
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Retourne l'indicateur spécifiant si l'Utilisateur est un professeur ou non.
     * @return integer L'Utilisateur est un professeur ou non ?
     */
    public function getEstProf()
    {
        return $this->estProf;
    }

    /**
     * Modifie l'indicateur spécifiant si l'Utilisateur est un professeur ou non.
     * @param integer $estProf L'Utilisateur est un professeur ou non ?
     */
    public function setEstProf($estProf)
    {
        $this->estProf = $estProf;
    }

    /**
     * Récupère le nom de l'Utilisateur.
     * @return string Le nom de l'Utilisateur.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Modifie le nom de l'Utilisateur.
     * @param string $nom Le nouveau nom de l'Utilisateur.
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Récupère le prénom de l'Utilisateur.
     * @return string Le prénom de l'Utilisateur.
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Modifie le prénom de l'Utilisateur.
     * @param string $prenom Le nouveau prénom de l'Utilisateur.
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Récupère le nom d'utilisateur de l'Utilisateur.
     * @return string Le nom d'utilisateur de l'Utilisateur.
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Modifie le nom d'utilisateur de l'Utilisateur.
     * @param string $nomUtilisateur Le nouveau nom d'utilisateur de l'Utilisateur.
     */
    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    /**
     * Récupère le mot de passe (crypté) de l'Utilisateur.
     * @return string Le mot de passe (crypté) de l'Utilisateur.
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Modifie le mot de passe (crypté) de l'Utilisateur.
     * @param string $motDePasse Le nouveau mot de passe de l'Utilisateur.
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }
}