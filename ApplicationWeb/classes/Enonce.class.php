<?php

class Enonce {
    private $idEnonce;
    private $nomEnonce;
    private $enonce;

    /**
     * Retourne une nouvelle instance d'Enonce.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance d'Enonce.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idEnonce':
                    $this->setIdEnonce($valeur);
                    break;
                case 'enonce':
                    $this->setEnonce($valeur);
                    break;
                case 'nomEnonce':
                    $this->setNomEnonce($valeur);
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance d'Enonce.
     * @param integer $new_idEnonce Le nouvel ID de cette instance d'Enonce.
     */
    public function setIdEnonce($new_idEnonce)
    {
        $this->idEnonce = $new_idEnonce;
    }

    /**
     * Modifie le corps de cette instance d'Enonce.
     * @param string $new_enonce Le nouveau corps de cette instance d'Enonce.
     */
    public function setEnonce($new_enonce)
    {
        $this->enonce = $new_enonce;
    }

    /**
     * Modifie le nom de cette instance d'Enonce.
     * @param string $new_nomEnonce Le nouveau nom de cette instance d'Enonce.
     */
    public function setNomEnonce($new_nomEnonce)
    {
        $this->nomEnonce = $new_nomEnonce;
    }

    /**
     * Retourne l'ID de cette instance d'Enonce.
     * @return integer L'ID de cette instance d'Enonce.
     */
    public function getIdEnonce()
    {
        return $this->idEnonce;
    }

    /**
     * Retourne le corps de cette instance d'Enonce.
     * @return string Le corps de cette instance d'Enonce.
     */
    public function getEnonce()
    {
        return $this->enonce;
    }

    /**
     * Retourne le nom de cette instance d'Enonce.
     * @return string Le nom de cette instance d'Enonce.
     */
    public function getNomEnonce()
    {
        return $this->nomEnonce;
    }
}
