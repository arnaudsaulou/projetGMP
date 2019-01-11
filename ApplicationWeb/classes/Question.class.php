<?php

class Question {
    private $idQuestion;
    private $idEnonce;
    private $libelle;

    /**
     * Génère une nouvelle instance de Question.
     * @param array $valeurs Un tableau associatif contenant les données à associer à cette instance.
     */
    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affect($valeurs);
        }
    }

    /**
     * Associe les données d'un tableau associatif à cette instance de Question.
     * @param array $donnees Un tableau associatif contenant des données à associer à cette instance.
     */
    public function affect($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'idQuestion':
                    $this->setIdQuestion($valeur);
                    break;

                case 'idEnonce':
                    $this->setIdEnonce($valeur);
                    break;

                case 'libelle':
                    $this->setLibelle($valeur);
                    break;

                default:
                    echo "Fatal error : construction Question invalide";
                    break;
            }
        }
    }

    /**
     * Modifie l'ID de cette instance de Question.
     * @param integer $new_idQuestion Le nouvel ID de cette instance de Question.
     */
    public function setIdQuestion($new_idQuestion)
    {
        $this->idQuestion = $new_idQuestion;
    }

    /**
     * Modifie l'ID de l'Enonce associé à cette Question.
     * @param integer $new_idEnonce Le nouvel ID de l'Enonce associé à cette Question.
     */
    public function setIdEnonce($new_idEnonce)
    {
        $this->idEnonce = $new_idEnonce;
    }

    /**
     * Modifie le libellé de cette instance de Question.
     * @param string $new_libelle Le nouveau libellé de cette instance.
     */
    public function setLibelle($new_libelle)
    {
        $this->libelle = $new_libelle;
    }

    /**
     * Retourne l'ID de cette instance de Question.
     * @return integer L'ID de cette instance de Question.
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * Retourne l'ID de l'Enonce associé à cette Question.
     * @return integer L'ID de l'Enonce associé à cette Question.
     */
    public function getIdEnonce()
    {
        return $this->idEnonce;
    }

    /**
     * Retourne le libellé de cette instance de Question.
     * @return string Le libellé de cette instance de Question.
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}