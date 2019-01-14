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
     * Retourne une nouvelle instance d'Utilisateur.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance d'Utilisateur.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
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
                    echo "Fatal error : construction Utilisateur invalide  :  " . $attribut . "<br>";
                    break;
            }
        }
    }

    /**
     * Retourne l'ID de cette instance d'Utilisateur.
     * @return integer L'ID de cette instance d'Utilisateur.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Retourne si l'Utilisateur est un professeur ou un étudiant.
     * @return boolean L'Utilisateur est professeur (true) un étudiant (false)
     */
    public function getEstProf()
    {
        return $this->estProf;
    }

    /**
     * Retourne le nom de famille de cette instance.
     * @return string Le nom de famille de cette instance.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Retourne le prénom de cette instance.
     * @return string Le prénom de cette instance.
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Retourne le nom d'Utilisateur de cette instance.
     * @return string Le nom d'Utilisateur de cette instance.
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Retourne le mot de passe (crypté) de cette instance.
     * @return string Le mot de passe (crypté) de cette instance.
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Retourne en quelle année est cet Utilisateur.
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Modifie l'ID de cette instance d'Utilisateur.
     * @param integer $idUtilisateur Le nouvel ID de cette instance.
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Modifie le booléen indiquant si l'Utilisateur est un professeur.
     * @param boolean $estProf Est-ce que cette instance est un professeur ?
     */
    public function setEstProf($estProf)
    {
        $this->estProf = $estProf;
    }

    /**
     * Modifie le nom de cette instance.
     * @param string $nom Le nouveau nom (de famille) de cette instance.
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Modifie le prénom de cette instance.
     * @param string $prenom Le nouveau prénom de cette instance.
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Modifie le nom d'utilisateur de cette instance.
     * @param string $nomUtilisateur Le nouveau nom d'utilisateur de cette instance.
     */
    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    /**
     * Modifie le mot de passe de cette instance. Note: pour des raisons de sécurité, le mot de passe
     * doit être crypté avant !
     * @param string $motDePasse Le nouveau mot de passe (crypté) de l'Utilisateur.
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * Modifie l'année de cette instance.
     * @param $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * Retourne si le mot de passe saisi est le même que le mot de passe actuel de cette instance.
     * @param string $mdpSaisi Le mot de passe saisi par l'Utilisateur.
     * @return bool true si les mots de passes correspondent, false dans les autres cas.
     */
    public function checkPassword($mdpSaisi)
    {
        //TODO : Faire le hashage des mots de passe
        return ($mdpSaisi == $this->getMotDePasse());
    }
}