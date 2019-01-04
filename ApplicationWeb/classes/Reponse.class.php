<?php

class Reponse
{
    private $idReponse;
    private $idUtilisateur;
    private $idSujet;
    private $numReponse;
    private $valeur;
    private $dateReponse;

    /**
     * Génère une nouvelle instance de Réponse.
     * @param array $valeurs Un tableau associatif contenant les valeurs à assigner.
     */
    public function __construct($valeurs = array()){
        if(!empty($valeurs)){
            $this->affect($valeurs);
        }
    }

    /**
     * Affecte les données d'un tableau associatif à cette instance de Réponse.
     * @param array $valeurs Le tableau dans lequel récupérer les valeurs.
     */
    private function affect(array $valeurs)
    {
        foreach ((array) $valeurs as $attribut => $valeur) {
            switch ($attribut) {
                case 'idReponse':
                    $this->setIdReponse($valeur);
                    break;
                case 'idUtilisateur':
                    $this->setIdUtilisateur($valeur);
                    break;
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'numReponse':
                    $this->setNumReponse($valeur);
                    break;
                case 'valeur':
                    $this->setValeur($valeur);
                    break;
                case 'dateReponse':
                    $this->setDateReponse($valeur);
                    break;
                default:
                    echo "Fatal error : construction Reponse invalide";
                    break;
            }
        }
    }

    /**
     * Retourne l'identifiant unique de la Réponse.
     * @return integer L'identifiant unique de la Réponse.
     */
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * Modifie l'identifiant unique de la Réponse.
     * @param integer $idReponse Le nouvel identifiant unique de la Réponse.
     */
    public function setIdReponse($idReponse)
    {
        $this->idReponse = $idReponse;
    }

    /**
     * Retourne l'identifiant unique de l'Utilisateur ayant saisi la Réponse.
     * @return integer L'identifiant unique de l'Utilisateur ayant saisi la Réponse.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Modifie l'identifiant unique de l'Utilisateur ayant saisi la Réponse.
     * @param integer $idUtilisateur Le nouvel identifiant unique de l'Utilisateur ayant saisi la Réponse.
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Retourne l'identifiant unique du Sujet associé à cette Réponse.
     * @return integer L'identifiant unique du Sujet associé à cette Réponse.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Modifie l'identifiant unique du Sujet associé à cette Réponse.
     * @param integer $idSujet Le nouvel identifiant unique du Sujet associé à cette Réponse.
     */
    public function setIdSujet($idSujet)
    {
        $this->idSujet = $idSujet;
    }

    /**
     * Retourne le numéro de la question liée à cette Réponse.
     * @return integer Le numéro de la question liée à cette Réponse.
     */
    public function getNumReponse()
    {
        return $this->numReponse;
    }

    /**
     * Modifie le numéro de la question liée à cette Réponse.
     * @param integer $numReponse Le nouveau numéro de la question liée à cette Réponse.
     */
    public function setNumReponse($numReponse)
    {
        $this->numReponse = $numReponse;
    }

    /**
     * Retourne ce que l'Utilisateur a saisi comme réponse.
     * @return string La réponse saisie.
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Modifie la valeur de la réponse saisie.
     * @param string $valeur La nouvelle valeur de la réponse.
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

    /**
     * Retourne la date de saisie de la Réponse.
     * @return string La date de saisie de la Réponse.
     */
    public function getDateReponse()
    {
        return $this->dateReponse;
    }

    /**
     * Modifie la date de saisie de la Réponse. Format Attendu: AAAA-MM-JJ
     * @param string $dateReponse La nouvelle date de saisie de la Réponse.
     */
    public function setDateReponse($dateReponse)
    {
        $this->dateReponse = $dateReponse;
    }
}

