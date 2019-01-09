<?php

class Note
{
    private $idUtilisateur;
    private $idSujet;
    private $numNote;
    private $note;

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
                default :
                    echo "Fatal error : construction Utilisateur invalide";
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * @return mixed
     */
    public function getNumNote()
    {
        return $this->numNote;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param $idUtilisateur
     */
    public function setUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setIdSujet($idSujet)
    {
        $this->idSujet = $idSujet;
    }

    public function setNumNote($numNote)
    {
        $this->numNote = $numNote;
    }

    /**
     * Modifie la valeur de cette instance de Note.
     * @param $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }
}
