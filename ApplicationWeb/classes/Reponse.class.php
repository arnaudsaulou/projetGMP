<?php

class Reponse {

    //Déclarations des variables de la classe Reponse
    private $idReponse;
    private $idUtilisateur;
    private $idSujet;
    private $numReponse;
    private $valeur;
    private $dateReponse;

    //Constructeur de la classe Reponse
    public function __construct($valeurs = array()){
        if(!empty($valeurs)){
            $this->affect($valeurs);
        }
    }

    //Affectation des donnees a un objet Reponse
    private function affect(array $valeurs)
    {
        foreach ((array) $valeurs as $attribut => $valeur) {
            switch ($attribut) {
                case 'idReponse':
                    $this->setIdReponse($valeur);
                    break;
                case 'idUtilisateur':
                    $this->setIdUtilisateur($valeur);
                    break;
                case 'idSujet':
                    $this->setIdSujet($valeur);
                    break;
                case 'numReponse':
                    $this->setNumReponse($valeur);
                    break;
                case 'valeur':
                    $this->setValeur($valeur);
                    break;
                case 'dateReponse':
                    $this->setDateReponse($valeur);
                    break;
                default:
                    echo "Fatal error : construction Reponse invalide";
                    break;
            }
        }
    }


    //Getters//

    public function getIdReponse() {
        return $this->idReponse;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getIdSujet() {
        return $this->idSujet;
    }

    public function getNumReponse() {
        return $this->numReponse;
    }

    public function getValeur() {
        return $this->valeur;
    }

    public function getDateReponse() {
        return $this->dateReponse;
    }



    //Setters//

    public function setIdReponse($idReponse) {
        $this->idReponse = $idReponse;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setIdSujet($idSujet) {
        $this->idSujet = $idSujet;
    }

    public function setNumReponse($numReponse) {
        $this->numReponse = $numReponse;
    }

    public function setValeur($valeur) {
        $this->valeur = $valeur;
    }

    public function setDateReponse($dateReponse) {
        $this->dateReponse = $dateReponse;
    }


}
