<?php

class SujetManager
{
  private $db;
  private $donneeVariableManager;
  private $sujetPossibleManager;
  private $insertIntoSujetPossible = '';
  private $insertIntoSujet = '';

  /**
  * SujetManager constructor.
  * @param MyPDO $db Une instance de MyPDO.
  */
  public function __construct($db)
  {
    $this->db = $db;
    $this->donneeVariableManager = new DonneeVariableManager($db);
    $this->sujetPossibleManager = new SujetPossibleManager($db);
  }

  /**
  * Génère une instance de Sujet à partir d'un tableau associatif contenant les données que doit contenir l'instance.
  * @param array $paramsSujet Un tableau associatif contenant les données que doit contenir l'instance.
  * @return Sujet Une instance de Sujet avec les données du tableau fourni comme valeurs.
  */
  public function createSujetDepuisTableau($paramsSujet)
  {
    return new Sujet($paramsSujet);
  }

  //Cette fonction permet de générer un sujet à partir d'une liste de données variable
  public function generateSujet($listDonneeVariable, $coheranceSujet)
  {
    ini_set('max_execution_time', 0);
    if (!empty($listDonneeVariable)) {
      $numSujet = $this->sujetPossibleManager->getLastIdSujet();
      if ($numSujet == '') {
        $numSujet = 1;
      } else {
        $numSujet++;
      }

      $req = $this->db->prepare(
        $this->getSQLQueryFromListDonneeVariable($listDonneeVariable)
      );
      $req->execute();

      $tabSujetIncoherants = $this->getSujetsIncoherant($coheranceSujet);

      $this->insertIntoSujetPossible = "";
      $this->insertIntoSujet = "";
      ini_set('memory_limit', '1024M');
      while ($possibilite = $req->fetch(PDO::FETCH_NUM)) {

        $containsAllValues = false;
        $y = 0;

        for ($i=0; $i < count($possibilite); $i++) {
          $possibiliteValeur[$i] = $this->donneeVariableManager->getDonneesVariableById($possibilite[$i])->getValeur();
        }

        while ($y < count($tabSujetIncoherants) && !$containsAllValues) {
          $containsAllValues = !array_diff_assoc($possibiliteValeur, $tabSujetIncoherants[$y]);
          $y++;
        }

        if(!$containsAllValues){
          for ($i = 0; $i < count($possibilite); $i++) {
            $this->insertIntoSujetPossible .= '(' . $numSujet . ', ' . $possibilite[$i] . '),';
          }
          $this->insertIntoSujet .= '(' . $numSujet . ', ' . $_SESSION['lastInsertIdEnonce'] . '),';
          $numSujet++;
        }
      }
      $req->closeCursor();
      $this->insertIntoSujetPossible = rtrim($this->insertIntoSujetPossible, ',');
      $this->insertIntoSujetPossible = 'START TRANSACTION;
      INSERT INTO sujet_possible (idSujet, idDonneeVariable) VALUES ' . $this->insertIntoSujetPossible .';
      COMMIT;';
      $this->addSujetPossible();
      $this->addSujet();
    }
  }

  public function getSujetsIncoherant($coheranceSujet){
    $ligne = 0; // compteur de ligne
    $fic = fopen("./formules/coheranceSujets/".$coheranceSujet.".csv", "a+");
    $tabSujetIncoherants = array();
    while($tab = fgetcsv($fic,0,';')){
      $champs = count($tab);//nombre de champ dans la ligne en question

      if($ligne == 0){
        $ligne ++;
      } else {
        //affichage de chaque champ de la ligne en question
        $tabSujetIncoherants[] = $tab;
        $ligne ++;
      }
    }

    return $tabSujetIncoherants;
  }

  public function sujetExiste($idSujet)
  {
    $req = $this->db->prepare('SELECT COUNT(*) as sujetExiste FROM sujet WHERE idSujet = :idSujet');
    $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
    $req->execute();
    $res = $req->fetchColumn();
    $req->closeCursor();
    return $res;
  }

  /**
  * @param $idSujet
  * @return Sujet
  */
  public function getSujetAvecId($idSujet)
  {
    $req = $this->db->prepare('SELECT * FROM sujet WHERE idSujet = :idSujet');
    $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
    $req->execute();
    return new Sujet($req->fetch(PDO::FETCH_OBJ));
  }


  //Cette fonction permet d'ajouter un sujet possible à partir d'un numéro de sujet
  public function addSujetPossible()
  {
    $req = $this->db->prepare($this->insertIntoSujetPossible);
    $req->execute();
    $req->closeCursor();
  }


  public function getSQLQueryFromListDonneeVariable($listDonneeVariable)
  {
    $insertIntoSujetPossible = '';
    $join = '';

    for ($i = 0; $i <= count($listDonneeVariable); $i++) {
      if ($i == count($listDonneeVariable) - 1) {
        $insertIntoSujetPossible .= 'd' . $i . '.`idDonneeVariable` AS `idDonneeVariableSujet' . $i . '`';
        $join .= '(SELECT * FROM `donnee_variable` WHERE `idType` = ' . $listDonneeVariable[$i] . ') AS d' . $i;
      } else if ($i < count($listDonneeVariable) - 1) {
        $insertIntoSujetPossible .= 'd' . $i . '.`idDonneeVariable` AS `idDonneeVariableSujet' . $i . '`, ';
        $join .= '(SELECT * FROM `donnee_variable` WHERE `idType` = ' . $listDonneeVariable[$i] . ') AS d' . $i . ' , ';
      }
    }

    $query = 'SELECT ' . $insertIntoSujetPossible . ' FROM ' . $join;
    return $query;
  }

  public function getIdSujetsByIdEnonce($idEnonce) {
    $req = $this->db->prepare('SELECT idSujet FROM sujet WHERE idEnonce = :idEnonce');
    $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_STR);
    $req->execute();
    $listeSujets = array();
    while ($sujet = $req->fetch(PDO::FETCH_ASSOC)) {
      $listeSujets[] = new Sujet($sujet);
    }
    $req->closeCursor();
    return $listeSujets;
  }


  public function getIdSujetsAttribueByIdEnonceAndAnnee($idEnonce,$annee) {
    $req = $this->db->prepare('SELECT s.idSujet FROM attribue a
      join utilisateur u on a.idUtilisateur = u.idUtilisateur
      join sujet s on a.idSujet = s.idSujet
      WHERE idEnonce = :idEnonce and annee = :annee');
      $req->bindValue(':idEnonce', $idEnonce, PDO::PARAM_STR);
      $req->bindValue(':annee', $annee, PDO::PARAM_STR);
      $req->execute();
      $liste = array();
      while ($id = $req->fetch(PDO::FETCH_NUM)) {
        $liste[] = $id[0];
      }
      $req->closeCursor();
      return $liste;
    }


    public function getSujetById($id)
    {
      $req = $this->db->prepare(
        'SELECT idSujet, idEnonce FROM sujet WHERE idSujet=:id'
      );
      $req->bindValue(':id', $id, PDO::PARAM_INT);
      $req->execute();
      $res = $req->fetch(PDO::FETCH_OBJ);
      $req->closeCursor();
      return new Sujet($res);
    }

    public function addSujet()
    {

      $this->insertIntoSujet = rtrim($this->insertIntoSujet, ',');

      $req = $this->db->prepare(
        " START TRANSACTION;
        INSERT INTO sujet(idSujet, idEnonce) VALUES " . $this->insertIntoSujet . ";
        COMMIT;"
      );

      $result = $req->execute();
      $req->closeCursor();
    }

    /**
    * @param $idSujet
    * @return bool
    */
    public function supprimerSujet($idSujet) {
      $req = $this->db->prepare("DELETE FROM sujet WHERE idSujet = :idSujet");
      $req->bindValue(':idSujet', $idSujet, PDO::PARAM_STR);
      $result = $req->execute();
      $req->closeCursor();
      return $result;
    }
  }
