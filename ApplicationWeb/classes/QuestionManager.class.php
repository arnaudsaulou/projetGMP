<?php

class QuestionManager
{
    private $db;

    /**
     * Génère une nouvelle instance de QuestionManager.
     * @param MyPDO $db Une instance de MyPDO.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crée une nouvelle instance de Question depuis un tableau.
     * @param array $paramsQuestion Un tableau associatif contenant les données à associer à la Question.
     * @return Question Une nouvelle instance de Question avec les valeurs du tableau comme membres.
     */
    public function createQuestionDepuisTableau($paramsQuestion)
    {
        return new Question($paramsQuestion);
    }


    /**
     * Stocke une Question dans la base de données.
     * @param Question $newQuestion L'instance de Question à enregistrer.
     * @return bool Est-ce que l'insertion s'est bien déroulée ?
     */
    public function ajouterQuestion($newQuestion)
    {
        $req = $this->db->prepare(
            "INSERT INTO questions(idEnonce, libelle) VALUES (:idEnonce , :libelle)"
        );

        $req->bindValue(':idEnonce', $newQuestion->getIdEnonce(), PDO::PARAM_INT);
        $req->bindValue(':libelle', $newQuestion->getLibelle(), PDO::PARAM_STR);
        $result = $req->execute();
        $req->closeCursor();
        return $result;
    }

    /**
     * Ajoute toutes les instances de Question contenues dans le tableau de SESSION à la base de données.
     * @param integer $lastInsertedIdEnonce Le dernier ID de Question inseré dans la base de données.
     */
    public function ajouterListeQuestion($lastInsertedIdEnonce)
    {
        if (!empty($lastInsertedIdEnonce)) {
            foreach ($_SESSION['tableauQuestionEnonce'] as $question) {
                $question = unserialize($question);
                $question->setIdEnonce($lastInsertedIdEnonce);
                $this->ajouterQuestion($question);
            }
            unset($_SESSION['tableauQuestionEnonce']);
        }
    }

    /**
     * Récupère une instance de Question dans la base de données à partir de son ID.
     * @param integer $idQuestion L'ID de la Question dont on veut récupérer l'instance.
     * @return Question L'instance de Question liée à l'ID fourni.
     */
    public function recupererQuestionViaIdQuestion($idQuestion)
    {
        $req = $this->db->prepare(
            "SELECT idQuestion, idEnonce, libelle FROM questions WHERE idQuestion = :idQuestion"
        );
        $req->bindValue(':idQuestion', $idQuestion, PDO::PARAM_INT);
        $req->execute();
        $question = $this->createQuestionDepuisTableau($req->fetch(PDO::FETCH_OBJ));
        $req->closeCursor();
        return $question;
    }


    /**
     * Récupère la liste de Questions d'un Enonce à partir de son ID.
     * @param integer $idEnonce L'ID de l'Enonce dont on souhaite récupérer les Questions.
     * @return array Un tableau contenant toutes les instances de Questions liées à l'Enonce fourni.
     */
    public function recupererListeQuestionEnonce($idEnonce)
    {
        $req = $this->db->prepare(
            "SELECT idQuestion, idEnonce, libelle FROM questions WHERE idEnonce = :idEnonce"
        );
        $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_INT);
        $req->execute();
        $listeQuestions = array();
        while ($question = $req->fetch(PDO::FETCH_OBJ)) {
            $listeQuestions[] = $this->createQuestionDepuisTableau($question);
        }
        $req->closeCursor();
        return $listeQuestions;
    }
}
