<?php

class DonneeCalculee {
    private $idType;
    private $nomFormule;
    private $tableauIdParams;

    /**
     * Retourne une nouvelle instance de DonneeCalculee.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de DonneeCalculee.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idType':
                    $this->setIdType($valeur);
                    break;

                case 'nomFormule':
                    $this->setNomFormule($valeur);
                    break;

                case 'tableauIdParams':
                    $this->setTableauIdParams($valeur);
                    break;
            }
        }
    }

    /**
     * Modifie l'ID du type de cette instance de DonneeCalculee.
     * @param integer $new_idType Le nouvel ID du type de cette instance de DonneeCalculee.
     */
    public function setIdType($new_idType)
    {
        $this->idType = $new_idType;
    }

    /**
     * Modifie le nom de Formule à utiliser de cette instance de DonneeCalculee.
     * @param integer $new_nomFormule Le nouveau nom de formule de cette instance de DonneeCalculee.
     */
    public function setNomFormule($new_nomFormule)
    {
        $this->nomFormule = $new_nomFormule;
    }

    /**
     * Modifie le tableauIdParams de cette instance de DonneeCalculee.
     * @param mixed $new_tableauIdParams La nouveau tableau d'id de cette instance de DonneeCalculee.
     */
    public function setTableauIdParams($new_tableauIdParams)
    {
        $this->tableauIdParams = $new_tableauIdParams;
    }

    /**
     * Retourne l'ID du type de cette instance de DonneeCalculee.
     * @return mixed L'ID du type de cette instance de DonneeCalculee.
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Retourne le nom de formule de cette instance de DonneeCalculee.
     * @return mixed Le nom de formule de cette instance de DonneeCalculee.
     */
    public function getNomFormule()
    {
        return $this->nomFormule;
    }

    /**
     * Retourne le tableauIdParams de cette instance de DonneeCalculee.
     * @return mixed Le tableauIdParams de cette instance de DonneeCalculee.
     */
    public function getTableauIdParams()
    {
        return $this->tableauIdParams;
    }
}
