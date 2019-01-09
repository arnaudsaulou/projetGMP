<?php

class DonneeVariable {
    private $idDonneeVariable;
    private $idType;
    private $valeur;

    /**
     * Retourne une nouvelle instance de DonneeVariable.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de DonneeVariable.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idDonneeVariable':
                    $this->setIdDonneeVariable($valeur);
                    break;

                case 'idType':
                    $this->setIdType($valeur);
                    break;

                case 'valeur':
                    $this->setValeur($valeur);
                    break;

                default:
                    echo "Fatal error : construction DonneeVariable invalide";
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance de DonneeVariable.
     * @param integer $new_idDonneeVariable Le nouvel ID de cette instance de DonneeVariable.
     */
    public function setIdDonneeVariable($new_idDonneeVariable)
    {
        $this->idDonneeVariable = $new_idDonneeVariable;
    }

    /**
     * Modifie l'ID du type de cette instance de DonneeVariable.
     * @param integer $new_idType Le nouvel ID du type de cette instance de DonneeVariable.
     */
    public function setIdType($new_idType)
    {
        $this->idType = $new_idType;
    }

    /**
     * Modifie la valeur de cette instance de DonneeVariable.
     * @param mixed $new_valeur La nouvelle valeur de cette instance de DonneeVariable.
     */
    public function setValeur($new_valeur)
    {
        $this->valeur = $new_valeur;
    }

    /**
     * Retourne l'ID de cette instance de DonneeVariable.
     * @return mixed L'ID de cette instance de DonneeVariable.
     */
    public function getIdDonneeVariable()
    {
        return $this->idDonneeVariable;
    }

    /**
     * Retourne l'ID du type de cette instance de DonneeVariable.
     * @return mixed L'ID du type de cette instance de DonneeVariable.
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Retourne la valeur de cette instance de DonneeVariable.
     * @return mixed La valeur de cette instance de DonneeVariable.
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}