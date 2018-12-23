<?php
class Utilisateur {

  //Déclarations des variables de la classe Utilisateur
  private $idUtilisateur;
  private $estProf;
  private $nom;
  private $prenom;
  private $nomUtilisateur;
  private $motDePasse;
  private $annee;

  //Constructeur de la classe Utilisateur
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //Affectation des donnees a un objet Utilisateur
  public function affect($donnees){
    foreach ((array) $donnees as $attribut => $valeur) {
      switch ($attribut) {

        case 'idUtilisateur':
        $this->setIdUtilisateur($valeur);
        break;

        case 'estProf':
        $this->setEstProf($valeur);
        break;

        case 'nom':
        $this->setNom($valeur);
        break;

        case 'prenom':
        $this->setPrenom($valeur);
        break;

        case 'nomUtilisateur':
        $this->setNomUtilisateur($valeur);
        break;

        case 'motDePasse':
        $this->setMotDePasse($valeur);
        break;

        case 'annee':
        $this->setAnnee($valeur);
        break;

        default:
        echo "Fatal error : construction Utilisateur invalide  :  ".$attribut."<br>";
        break;
      }
    }
  }



  //Getters//

  public function getIdUtilisateur() {
    return $this->idUtilisateur;
  }

  public function getEstProf() {
    return $this->estProf;
  }

  public function getNom() {
    return $this->nom;
  }

  public function getPrenom() {
    return $this->prenom;
  }

  public function getNomUtilisateur() {
    return $this->nomUtilisateur;
  }

  public function getMotDePasse() {
    return $this->motDePasse;
  }

  public function getAnnee() {
    return $this->annee;
  }



  //Setters

  public function setIdUtilisateur($idUtilisateur) {
    $this->idUtilisateur = $idUtilisateur;
  }

  public function setEstProf($estProf) {
    $this->estProf = $estProf;
  }

  public function setNom($nom) {
    $this->nom = $nom;
  }

  public function setPrenom($prenom) {
    $this->prenom = $prenom;
  }

  public function setNomUtilisateur($nomUtilisateur) {
    $this->nomUtilisateur = $nomUtilisateur;
  }

  public function setMotDePasse($motDePasse) {
    $this->motDePasse = $motDePasse;
  }

  public function setAnnee($annee) {
    $this->annee = $annee;
  }


  //Cette fonction renvoi true si le mot de passe saisie est le meme que celui enregistre
  public function checkPassword($mdpSaisi){
    //TODO : Faire le hashage des mots de passe
    $password =$mdpSaisi;
    return ($password == $this-> getMotDePasse());
  }

}
