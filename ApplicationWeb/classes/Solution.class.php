<?php

class Solution {
    private $idSujet;
    private $idQuestion;
    private $valeur;

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
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'idQuestion':
                    $this->setIdQuestion($valeur);
                    break;
                case 'libelle':
                    $this->setValeur($valeur);
                    break;
                default:
                    echo "Fatal error : construction Solution invalide";
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de l'instance de Sujet associé à cette instance de Solution.
     * @param integer $new_idSujet Le nouvel ID de l'instance de Sujet associé à cette instance de Solution.
     */
    public function setIdSujet($new_idSujet)
    {
        $this->idSujet = $new_idSujet;
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
     * Modifie la valeur de cette instance de Solution.
     * @param string $new_valeur La nouvelle valeur de cette instance de Solution.
     */
    public function setValeur($new_valeur)
    {
        $this->valeur = $new_valeur;
    }

    /**
     * Retourne l'ID de l'instance de Sujet associé à cette instance de Solution.
     * @return integer L'ID de l'instance de Sujet associé à cette instance de Solution.
     */
    public function getIdSujet()
    {
        return $this->idSujet;
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
     * Retourne la valeur de cette instance de Solution.
     * @return string La valeur de cette instance de Solution.
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}