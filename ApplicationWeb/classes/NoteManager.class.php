<?php
class NoteManager{
	private $db;

	//Constructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Cette fonction permet d'ajouter une note à la base de données
	public function addNote($Note){
		$req=$this->db->prepare
		(' INSERT INTO note (idUtilisateur, idSujet, numNote, note)
		VALUES (:idUtilisateur, :idSujet, :numNote, :note) ');

		$req->bindValue(':idUtilisateur',$Note->getIdUtilisateur(),PDO::PARAM_STR);
		$req->bindValue(':idSujet',$Note->getIdSujet(),PDO::PARAM_STR);
		$req->bindValue(':numNote',$Note->getNumNote(),PDO::PARAM_STR);
		$req->bindValue(':note',$Note->getNote(),PDO::PARAM_STR);

		$req->execute();
	}


	//Cette fonction permet de récupérer une note à partir de l'identifiant d'un étudiant
	public function getNoteByIdEtudiant($id){
		$req=$this->db->prepare
		('SELECT idUtilisateur, idSujet, numNote, note FROM note WHERE idUtilisateur = :id');
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();

		$listeNote=array();

		while($note=$req->fetch(PDO::FETCH_OBJ)){
			$listeNote[]=new Note($note);
		};

		return $listeNote;
		$req->closeCursor();
	}

}
