<?php

class Note {

	//Déclarations des variables de la classe Note
	private $idUtilisateur;
	private $idSujet;
	private $numNote;
	private $note;


	//Constructeur de la classe Note
	public function __construct($valeur = array()){
		if(!empty($valeur)){
			$this->affect($valeur);
		}
	}

	//Affectation des donnees a un objet Note
	public function affect($donnees){
		foreach ((array) $donnees as $attribut => $valeur) {
			switch ($attribut) {

			    case 'idUtilisateur' :
				$this->setUtilisateur($valeur);
				break;

				case 'idSujet' :
				$this->setIdSujet($valeur);
				break;

				case 'numNote' :
				$this->setNumNote($valeur);
				break;

				case 'note' :
				$this->setNote($valeur);
				break;

				default :
				echo "Fatal error : construction Utilisateur invalide";
				break;
			}
		}
	}


	//Getters//

	public function getUtilisateur(){
		return $this->idUtilisateur;

	}
	public function getIdSujet(){
		return $this->idSujet;

	}
	public function getNumNote(){
		return $this->numNote;

	}
	public function getNote(){
		return $this->note;

	}



	//Setters//
	
	public function setUtilisateur($idUtilisateur){
		$this->idUtilisateur=$idUtilisateur;

	}
	public function setIdSujet($idSujet){
		$this->idSujet=$idSujet;

	}
	public function setNumNote($numNote){
		$this->numNote=$numNote;

	}
	public function setNote($note){
		$this->note=$note;

	}

}
