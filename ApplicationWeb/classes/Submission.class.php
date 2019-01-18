<?php

class Submission
{
    private $promo;
    private $prenom;
    private $nom;
    private $idSujet;
    private $titreEnonce;
    private $dateAttribution;
    private $dateSubmission;
    private $note;
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
                case 'promo':
                    $this->setPromo($valeur);
                    break;
                case 'prenom':
                    $this->setPrenom($valeur);
                    break;
                case 'nom':
                    $this->setNom($valeur);
                    break;
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'titreEnonce':
                    $this->setTitreEnonce($valeur);
                    break;
                case 'dateAttribution':
                    $this->setDateAttribution($valeur);
                    break;
                case 'dateSubmission':
                    $this->setDateSubmission($valeur);
                    break;
                case 'note':
                    $this->setNote($valeur);
                    break;
            }
        }
    }

    /**
     * Modifie la promotion attribué à cette instance.
     * @param string $valeur La nouvelle promotion attribuée à cette instance.
     */
    public function setPromo($valeur)
    {
        $this->promo = $valeur;
    }

    /**
     * Modifie le prénom attribué à cette instance.
     * @param string $valeur le nouveau prénom attribué à cette instance.
     */
    public function setPrenom($valeur)
    {
        $this->prenom = $valeur;
    }

    /**
     * Modifie le nom attribué à cette instance.
     * @param string $valeur le nouveau nom attribué à cette instance.
     */
    public function setNom($valeur)
    {
        $this->nom = $valeur;
    }

    /**
     * Modifie l'id du sujet attribué à cette instance.
     * @param integer $valeur la nouvelle id de sujet attribué à cette instance.
     */
    public function setIdSujet($valeur)
    {
        $this->dateLimite = $valeur;
    }

    /**
     * Modifie le titre d'énoncé attribué à cette instance.
     * @param string $valeur le nouveau titre d'énoncé attribué à cette instance.
     */
    public function setTitreEnonce($valeur)
    {
        $this->titreEnonce = $valeur;
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
     * Modifie la date de réponse au sujet de cette instance.
     * @param string $valeur La nouvelle date de réponse au sujet de cette instance.
     */
    public function setDateSubmission($valeur)
    {
        $this->dateSubmission = $valeur;
    }

    /**
     * Modifie la note associée à cette instance.
     * @param integer $valeur la nouvelle note associée à cette instance.
     */
    public function setNote($valeur)
    {
        $this->note = $valeur;
    }

    /**
     * Retourne le titre d'énoncé attribué à cette instance.
     * @return string titre d'énoncé attribué à cette instance.
     */
    public function getTitreEnonce()
    {
        return $this->titreEnonce;
    }

    /**
     * Retourne la promotion attribué à cette instance.
     * @return string la promotion attribué à cette instance.
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Retourne le prenom attribué à cette instance.
     * @return string le prenom attribué à cette instance.
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Retourne le nom attribué à cette instance.
     * @return string le nom attribué à cette instance.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Retourne l'ID du Sujet attribué à cette instance.
     * @return integer $valeur Le nouvel ID du Sujet attribué à cette instance.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Retourne la date d'attribution du sujet de cette instance.
     * @return string $valeur La nouvelle date d'attribution du sujet de cette instance.
     */
    public function getDateAttribution()
    {
        return $this->dateAttribution;
    }

    /**
     * Retourne la date de réponse au sujet de cette instance.
     * @return string $valeur La nouvelle date de réponse au sujet de cette instance.
     */
    public function getDateSubmission()
    {
        return $this->dateSubmission;
    }

    /**
     * Retourne la note associée cette instance.
     * @return integer $valeur Le nouveau cooldown de réponse au sujet de cette instance.
     */
    public function getNote()
    {
        return $this->note;
    }


}
