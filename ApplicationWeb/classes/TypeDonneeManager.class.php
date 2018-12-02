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

}

?>
