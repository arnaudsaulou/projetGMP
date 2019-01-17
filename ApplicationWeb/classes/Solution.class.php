<?php

class Solution {
    private $idQuestion;
    private $nomFormule;
    private $tableauIdParams;

    /**
     * Génère une nouvelle instance de Solution.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de Solution.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idQuestion':
                    $this->setIdQuestion($valeur);
                    break;
                case 'nomFormule':
                    $this->setNomFormule($valeur);
                    break;
                case 'tableauIdParams':
                    $this->setTableauIdParams($valeur);
                    break;
                default:
                    echo "Fatal error : construction Solution invalide";
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de l'instance de Question associé à cette instance de Solution.
     * @param integer $new_idQuestion Le nouvel ID de l'instance de Question associé à cette instance de Solution.
     */
    public function setIdQuestion($new_idQuestion)
    {
        $this->idQuestion = $new_idQuestion;
    }

    /**
     * Modifie l'ID de l'instance de NomFormule associé à cette instance de Solution.
     * @param integer $new_nomFormule Le nouvel ID de l'instance de NomFormule associé à cette instance de Solution.
     */
    public function setNomFormule($new_nomFormule)
    {
        $this->nomFormule = $new_nomFormule;
    }

    /**
     * Modifie la valeur de tableauIdParams de cette instance de Solution.
     * @param string $new_tableauIdParams La nouvelle valeur de cette instance de Solution.
     */
    public function setTableauIdParams($new_tableauIdParams)
    {
        $this->tableauIdParams = $new_tableauIdParams;
    }

    /**
     * Retourne l'ID de l'instance de Question associé à cette instance de Solution.
     * @return integer L'ID de l'instance de Question associé à cette instance de Solution.
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * Retourne l'ID de l'instance de nomFormule associé à cette instance de Solution.
     * @return integer Le nom de nomFormule associé à cette instance de Solution.
     */
    public function getNomFormule()
    {
        return $this->nomFormule;
    }

    /**
     * Retourne le tableauIdParams de cette instance de Solution.
     * @return string Le tableauIdParams de cette instance de Solution.
     */
    public function getTableauIdParams()
    {
        return $this->tableauIdParams;
    }
}
