<?php

class Sujet {
    private $idSujet;
    private $idEnonce;

    /**
     * Génère une nouvelle instance de Sujet.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de Sujet.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array) $donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'idEnonce':
                    $this->setIdEnonce($valeur);
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance de Sujet.
     * @param integer Le nouvel ID de ce Sujet.
     */
    public function setIdSujet($new_idSujet)
    {
        $this->idSujet = $new_idSujet;
    }

    /**
     * Modifie l'ID de l'Enonce associé à ce Sujet.
     * @param integer $new_idEnonce Le nouvel ID de l'Enonce associé à ce Sujet.
     */
    public function setIdEnonce($new_idEnonce)
    {
        $this->idEnonce = $new_idEnonce;
    }

    /**
     * Retourne l'ID de cette instance de Sujet.
     * @return integer L'ID de l'Enonce associé à ce Sujet.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Retourne l'ID de l'Enonce associé à ce Sujet.
     * @return integer L'ID de l'Enonce associé à ce Sujet.
     */
    public function getIdEnonce()
    {
        return $this->idEnonce;
    }
}