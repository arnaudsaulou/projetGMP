<?php

class TypeDonnee {
    private $idType;
    private $libelle;

    /**
     * Génère une nouvelle instance de TypeDonnee.
     * @param array $valeurs
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de TypeDonnee.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ((array)$donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idType':
                    $this->setIdType($valeur);
                    break;
                case 'libelle':
                    $this->setLibelle($valeur);
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance de TypeDonnee.
     * @param integer $new_idType Le nouvel ID de cette instance de TypeDonnee.
     */
    public function setIdType($new_idType)
    {
        $this->idType = $new_idType;
    }

    /**
     * Modifie le libellé de cette instance de TypeDonnee.
     * @param string $new_libelle Le nouveau libellé de cette instance.
     */
    public function setLibelle($new_libelle)
    {
        $this->libelle = $new_libelle;
    }

    /**
     * Retourne l'ID de cette instance de TypeDonnee.
     * @return integer L'ID de cette instance de TypeDonnee.
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Retourne le libellé de cette instance de TypeDonnee.
     * @return string Le libellé de cette instance de TypeDonnee.
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}