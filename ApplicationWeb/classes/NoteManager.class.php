<?php
class NoteManager{
	private $db;

    /**
     * Génère une nouvelle instance de NoteManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
	public function __construct($db){
		$this->db = $db;
	}

    /**
     * Ajoute une instance de Note à la base de données.
     * @param Note $Note L'instance de Note à enregistrer.
     * @return bool Est-ce que l'insertion s'est bien déroulée ?
     */
	public function addNote($Note){
		$req=$this->db->prepare
		(' INSERT INTO note (idUtilisateur, idSujet, numNote, note)
		VALUES (:idUtilisateur, :idSujet, :numNote, :note) ');
		$req->bindValue(':idUtilisateur',$Note->getIdUtilisateur(),PDO::PARAM_STR);
		$req->bindValue(':idSujet',$Note->getIdSujet(),PDO::PARAM_STR);
		$req->bindValue(':numNote',$Note->getNumNote(),PDO::PARAM_STR);
		$req->bindValue(':note',$Note->getNote(),PDO::PARAM_STR);
		$result = $req->execute();
		return $result;
	}

    /**
     * Retourne toutes les instances de Notes dans la base de données liées à l'ID Utilisateur fourni.
     * @param integer $id L'ID de l'Utilisateur dont on veut récupérer les notes.
     * @return array Un tableau contenant toutes les instances de Notes de l'Utilisateur correspondant à l'ID fourni.
     */
	public function getNoteByIdEtudiant($id){
		$req=$this->db->prepare
        ('SELECT idUtilisateur, idSujet, numNote, note FROM note WHERE idUtilisateur = :id');
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();
		$listeNote=array();
		while($note=$req->fetch(PDO::FETCH_OBJ)){
			$listeNote[]=new Note($note);
		};
        $req->closeCursor();
		return $listeNote;
	}
}
