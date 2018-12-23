<?php
class Attribue {

	//Déclarations des variables de la classe Attribue
	private $idUtilisateur;
	private $idSujet;
	private $dateAttribution;
	private $dateLimite;

	//Constructeur de la classe Attribue
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affect($valeurs);
		}
  }

	//Affectation des donnees a un objet Attribue
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

	//Getters//

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



	//Setters//

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
