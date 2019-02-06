<?php

class ImageVariableManager
{
    private $db;

    /**
     * Retourne une nouvelle instance d'ImageVariableManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ajouterImageVariable($newImage){
      $req = $this->db->prepare(
          "INSERT INTO image_variable(idImage, idSujet, nomFormule) VALUES (:idImage , :idSujet , :nomFormule)"
      );
      $req->bindValue(':idImage', $newImage->getIdImage(), PDO::PARAM_INT);
      $req->bindValue(':idSujet', $newImage->getIdSujet(), PDO::PARAM_INT);
      $req->bindValue(':nomFormule', $newImage->getNomImage(), PDO::PARAM_STR);
      $result = $req->execute();
      $req->closeCursor();
      return $result;
    }

}
