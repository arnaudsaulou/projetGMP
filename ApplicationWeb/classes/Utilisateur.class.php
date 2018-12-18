<?php
class Utilisateur {
  private $idUtilisateur;
  private $estProf;
  private $nom;
  private $prenom;
  private $nomUtilisateur;
  private $motDePasse;
  private $annee;

  /**
  * Génère une nouvelle instance d'Utilisateur.
  * @param array contient les attributs d'un utilisateur
  */
  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affect($valeurs);
    }
  }

  //affectation des valeurs du tableau aux différents attributs
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

  //cette fonction renvoi true si le mot de passe saisie est le meme que celui enregistre
  public function checkPassword($mdpSaisi){
    //TODO : Faire le hashage des mots de passe
    $password =$mdpSaisi;
    return ($password == $this-> getMotDePasse());
  }


  /**
  * Récupère l'annee d'utilisateur de l'Utilisateur.
  * @return integer L'annee d'utilisateur de l'Utilisateur.
  */
  public function getAnnee()
  {
    return $this->annee;
  }

  /**
  * Modifie l'annee d'utilisateur de l'Utilisateur.
  * @param integer $annee La nouvelle annee d'utilisateur de l'Utilisateur.
  */
  public function setAnnee($annee)
  {
    $this->annee = $annee;
  }

}
