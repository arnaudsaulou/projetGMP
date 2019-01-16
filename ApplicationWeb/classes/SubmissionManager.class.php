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
        $req = $this->db->prepare('SELECT estProf,nom,prenom FROM utilisateur ORDER BY nom');
        $req->execute();
        $listeSubmission = array();
        while ($Submission = $req->fetch(PDO::FETCH_OBJ)) {
            $listeSubmission[] = new Submission($Submission);
        }
        $req->closeCursor();
        return $listeSubmission;
    }


}
