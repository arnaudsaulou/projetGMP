<?php

class Note
{
    private $idUtilisateur;
    private $idSujet;
    private $numNote;
    private $note;
	private $date;

    /**
     * Retourne une nouvelle instance de Note.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de Note.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idUtilisateur' :
                    $this->setUtilisateur($valeur);
                    break;
                case 'idSujet' :
                    $this->setIdSujet($valeur);
                    break;
                case 'numNote' :
                    $this->setNumNote($valeur);
                    break;
                case 'note' :
                    $this->setNote($valeur);
                    break;
				case 'dateReponse' :
                    $this->setDateReponse($valeur);
                    break;
            }
        }
    }

    /**
     * Retourne l'ID de l'instance d'Utilisateur associé à cette Note.
     * @return integer L'ID de l'instance d'Utilisateur associé à cette Note.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Retourne l'ID du Sujet attribué à cette instance de Note.
     * @return integer L'ID du Sujet attribué à cette instance de Note.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Retourne le numéro de cette instance de Note.
     * @return integer Le numéro de cette instance de Note.
     */
    public function getNumNote()
    {
        return $this->numNote;
    }

    /**
     * Retourne la Note obtenue par l'Utilisateur pour le Sujet donné.
     * @return integer La Note obtenue par l'Utilisateur pour le Sujet donné.
     */
    public function getNote()
    {
        return $this->note;
    }

	/**
     * Retourne la date obtenue par l'Utilisateur pour le Sujet donné.
     * @return integer La Note obtenue par l'Utilisateur pour le Sujet donné.
     */
	public function getDateReponse()
    {
        return $this->dateReponse;
    }

    /**
     * Modifie l'ID de l'instance d'Utilisateur associé à cette Note.
     * @param integer $idUtilisateur Le nouvel ID de l'instance d'Utilisateur associé à cette Note.
     */
    public function setUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Modifie l'ID du Sujet attribué à cette instance de Note.
     * @param integer $idSujet Le nouvel ID du Sujet attribué à cette instance de Note.
     */
    public function setIdSujet($idSujet)
    {
        $this->idSujet = $idSujet;
    }

    /**
     * Modifie le numéro de cette instance de Note.
     * @param integer $numNote Le nouveau numéro de cette instance de Note.
     */
    public function setNumNote($numNote)
    {
        $this->numNote = $numNote;
    }

    /**
     * Modifie la valeur de cette instance de Note.
     * @param integer $note La Note obtenue par l'Utilisateur pour le Sujet donné.
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

	/**
     * Modifie la valeur de cette instance de Note.
     * @param integer $note La Note obtenue par l'Utilisateur pour le Sujet donné.
     */
    public function setDateReponse($dateReponse)
    {
        $this->dateReponse = $dateReponse;
    }
}
