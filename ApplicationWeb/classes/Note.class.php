<?php

class Note {
	private $idUtilisateur;
	private $idSujet;
	private $numNote;
	private $note;
	
	public function __construct($valeur = array()){
		if(!empty($valeur)){
			$this->affect($valeur);
		}
	}
	
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