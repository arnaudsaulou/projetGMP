<?php

class SujetPossible {
    private $idSujet;
    private $idDonneeVariable;

    /**
     * Génère une nouvelle instance de SujetPossible.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de SujetPossible.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'idDonneeVariable':
                    $this->setIdDonneeVariable($valeur);
                    break;
                default:
                    echo "Fatal error : construction SujetPossible invalide";
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance de SujetPossible.
     * @param integer $new_idSujet Le nouvel ID de cette instance de SujetPossible.
     */
    public function setIdSujet($new_idSujet)
    {
        $this->idSujet = $new_idSujet;
    }

    /**
     * Modifie l'ID de la DonneeVariable référencée par ce SujetPossible.
     * @param integer $new_idDonneeVariable Le nouvel ID de la DonneeVariable référencée par ce SujetPossible.
     */
    public function setIdDonneeVariable($new_idDonneeVariable)
    {
        $this->idDonneeVariable = $new_idDonneeVariable;
    }

    /**
     * Retourne l'ID de cette instance de SujetPossible.
     * @return integer L'ID de cette instance de SujetPossible.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * Retourne l'ID correspondant à la DonneeVariable référencée par ce SujetPossible.
     * @return integer L'ID correspondant à la DonneeVariable référencée par ce SujetPossible.
     */
    public function getIdDonneeVariable()
    {
        return $this->idDonneeVariable;
    }
}
