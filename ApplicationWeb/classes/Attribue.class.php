<?php
class Attribue {
	private $idUtilisateur;
	private $idSujet;
	private $dateAttribution;
	private $dateLimite;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affect($valeurs);
		}
    }
	
	public function affect($donnees){
		foreach ((array) $donnees as $attribut => $valeur) {
			switch ($attribut) {

				case 'idUtilisateur':
				$this->setIdUtilisateur($valeur);
				break;
				
				case 'idSujet':
				$this->setIdSujet($valeur);
				break;
				
				case 'dateAttribution':
				$this->setDateAttribution($valeur);
				break;
				
				case 'dateLimite':
				$this->setDateLimite($valeur);
				break;
			}
		
		}
	}
	
	public function getIdUtilisateur(){
	return $this->idUtilisateur;
	
	}
	
	public function getIdSujet(){
	return $this->idSujet;
	
	}
	
	public function getDateAttribution(){
	return $this->dateAttribution;
	
	}
	
	public function getDateLimite(){
	return $this->dateLimite;
	
	}
	
	public function setIdUtilisateur($valeur){
     $this->idUtilisateur = $valeur;
	
	}
	
	public function setIdSujet($valeur){
     $this->idUtilisateur = $valeur;
  
	}
	
	public function setDateAttribution($valeur){
     $this->dateAttribution = $valeur;
  
	}
	
	public function setDateLimite($valeur){
     $this->setDateLimite = $valeur;
  
	}
}

?>