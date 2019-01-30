<?php

class SubmissionManager
{
  private $db;

  /**
  * Retourne une nouvelle instance de SubmissionManager.
  * @param MyPDO $db Une instance de MyPDO.
  */
  public function __construct($db)
  {
    $this->db = $db;
  }

  /**
  * Retourne un tableau contenant les submission effectuées par tout les eleves sur tout les sujets confondus
  * @return array le tableau des submissions
  */
  public function getList()
  {
    $req = $this->db->prepare('SELECT distinct annee as promo,nom,prenom,a.idSujet as idSujet,nomEnonce as titreEnonce,a.dateAttribution as dateAttribution,dateReponse as dateSubmission,note, a.dateLimite as dateLimite FROM utilisateur u join note n on n.idUtilisateur = u.idUtilisateur join attribue a on a.idUtilisateur = n.idUtilisateur join sujet s on s.idSujet = n.idSujet join enonce e on e.idEnonce = s.idEnonce where a.idUtilisateur = n.idUtilisateur and a.idSujet = n.idSujet');
    $req->execute();
    $listeSubmission = array();
    while ($Submission = $req->fetch(PDO::FETCH_OBJ)) {
      $listeSubmission[] = new Submission($Submission);
    }
    $req->closeCursor();
    return $listeSubmission;
  }


}
