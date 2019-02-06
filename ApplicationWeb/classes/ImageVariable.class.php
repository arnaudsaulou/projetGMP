<?php

class ImageVariable {
    private $idImage;
    private $idSujet;
    private $nomImage;

    /**
     * Retourne une nouvelle instance d'ImageVariable.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de ImageVariable.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idImage':
                    $this->setIdImage($valeur);
                    break;
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'nomImage':
                    $this->setNomImage($valeur);
                    break;
            }
        }
    }


    public function getIdImage()
    {
        return $this->idImage;
    }

    public function getIdSujet()
    {
        return $this->idSujet;
    }

    public function getNomImage()
    {
        return $this->nomImage;
    }


    public function setIdImage($new_idImage)
    {
        $this->idImage = $new_idImage;
    }

    public function setIdSujet($new_idSujet)
    {
        $this->idSujet = $new_idSujet;
    }

    public function setNomImage($new_nomImage)
    {
        $this->nomImage = $new_nomImage;
    }

}
