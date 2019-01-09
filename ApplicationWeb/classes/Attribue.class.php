<?php

class Attribue {
    private $idUtilisateur;
    private $idSujet;
    private $dateAttribution;
    private $dateLimite;

    /**
     * Retourne une nouvelle instance d'Attribue.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de Attribue.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idUtilisateur':
                    $this->setIdUtilisateur($valeur);
                    break;
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'dateAttribution':
                    $this->setDateAttribution($valeur);
                    break;
                case 'dateLimite':
                    $this->setDateLimite($valeur);
                    break;
            }
        }
    }

    /**
     * Retourne l'ID de l'Utilisateur attribué à cet instance.
     * @return integer L'ID de l'Utilisateur attribué à cet instance.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Retourne l'ID du Sujet attribué à cet instance.
     * @return integer L'ID du Sujet attribué à cet instance.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Retourne la date d'attribution du sujet au sujet de cette instance.
     * @return string La date d'attribution du sujet au sujet de cette instance.
     */
    public function getDateAttribution()
    {
        return $this->dateAttribution;
    }

    /**
     * Retourne la date limite de réponse au sujet de cette instance.
     * @return string La date limite de réponse au sujet de cette instance.
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * Modifie l'ID de l'Utilisateur attribué à cet instance.
     * @param integer $valeur Le nouvel ID de l'Utilisateur attribué à cet instance.
     */
    public function setIdUtilisateur($valeur)
    {
        $this->idUtilisateur = $valeur;
    }

    /**
     * Modifie l'ID du Sujet attribué à cet instance.
     * @param integer $valeur Le nouvel ID du Sujet attribué à cet instance.
     */
    public function setIdSujet($valeur)
    {
        $this->idUtilisateur = $valeur;
    }

    /**
     * Modifie la date d'attribution du sujet de cette instance.
     * @param string $valeur La nouvelle date d'attribution du sujet de cette instance.
     */
    public function setDateAttribution($valeur)
    {
        $this->dateAttribution = $valeur;
    }

    /**
     * Modifie la date limite de réponse au sujet de cette instance.
     * @param string $valeur La nouvelle date limite de réponse au sujet de cette instance.
     */
    public function setDateLimite($valeur)
    {
        $this->dateLimite = $valeur;
    }
}