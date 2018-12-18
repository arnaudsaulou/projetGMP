<?php
class TypeDonneeManager {

	//Conctructeur
	public function __construct($db){
		$this->db = $db;
	}

	//Fonction permettant de créer un objet TypeDonnee à partir d'un tableau
	public function createTypeDonneeDepuisTableau($paramsTypeDonnee){
		return new TypeDonnee($paramsTypeDonnee);
	}

	//Fonction permettant de récupérer la liste des objet TypeDonnee
  public function getTypeDonnee(){
			$listTypeDonnee= array();

      $req = $this->db->prepare(
        "SELECT * FROM type_donnees ORDER BY libelle"
      );

      $req->execute();

			while($typeDonnee  = $req->fetch(PDO::FETCH_OBJ)){
				$listTypeDonnee[] = new TypeDonnee($typeDonnee);
			}

			$req->closeCursor();

			return $listTypeDonnee;
  }

  //Fonction permettant de récupérer un objet TypeDonnee grace à un id
  public function getTypeDonneeById($idTypeDonnee){
    if(!empty($idTypeDonnee)){
      $req = $this->db->prepare(
        "SELECT * FROM type_donnees WHERE idType = :idType"
      );

      $req->bindValue(':idType',$idTypeDonnee,PDO::PARAM_INT);

      $req->execute();

      $typeDonnee = $req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();

      return new TypeDonnee($typeDonnee);

    }
  }

	//Fonction permettant d'ajouter un nouvel objet TypeDonnee
	public function ajouterTypeDonne($newTypeDonnee){
		if(!empty($newTypeDonnee)){
			$req = $this->db->prepare(
				"INSERT INTO `type_donnees`(`libelle`) VALUES (:libelle)"
			);

			$req->bindValue(':libelle',$newTypeDonnee->getLibelle(),PDO::PARAM_STR);

			$result = $req->execute();

			$_SESSION['newIdTypeDonne'] = $this->db->lastInsertId();

			$req->closeCursor();

			return $result;

		}
	}

}

?>
