<?php

class UtilisateurManager{
  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  //fonction permettant d'jouter un utilisateur (prof ou élève)
  public function addUtilisateur($Utilisateur){
    $req=$this ->db->prepare
    ('INSERT INTO utilisateur (estProf,nom,prenom,nomUtilisateur,motDePasse)
    VALUES (:estProf,:nom,:prenom,:login,:pwd)');

    $req ->bindValue(':estProf',$Utilisateur->getEstProf(),PDO::PARAM_STR);
    $req ->bindValue(':nom',$Utilisateur->getNom(),PDO::PARAM_STR);
    $req ->bindValue(':prenom',$Utilisateur->getPrenom(),PDO::PARAM_STR);
    $req ->bindValue(':login',$Utilisateur->getNomUtilisateur(),PDO::PARAM_STR);
    $req ->bindValue(':pwd',$Utilisateur->getMotDePasse(),PDO::PARAM_STR);

    $req->execute();
  }

  //fonction permettant de lister tous les utilisateurs (prof ET élèves)
  public function getList(){

    $req = $this->db->prepare('SELECT idUtilisateur,estProf,nom,prenom FROM utilisateur ORDER BY nom');
    $req->execute();

    $listeUtilisateur=array();

    while($Utilisateur=$req->fetch(PDO::FETCH_OBJ)){
      $listeUtilisateur[]=new Utilisateur($Utilisateur);
    }
    return $listeUtilisateur;
    $req->closeCursor();
  }

  //fonction permettant de lister tous les étudiants
  public function getListEtudiants(){

    $req = $this->db->prepare('SELECT idUtilisateur,estProf,nom,prenom FROM utilisateur WHERE estProf = 0 ORDER BY nom');
    $req->execute();

    $listeUtilisateur=array();

    while($Utilisateur=$req->fetch(PDO::FETCH_OBJ)){
      $listeUtilisateur[]=new Utilisateur($Utilisateur);
    }
    return $listeUtilisateur;
    $req->closeCursor();
  }

  //fonction permettant de compter le nombre d'utilisateurs enregistrés (prof ET élèves)
  public function countUtilisateurs(){
    $res=array();
    $req = $this->db->prepare("SELECT count(idUtilisateur) AS total FROM utilisateur");
    $req->execute();
    $res = $req->fetch(PDO::FETCH_OBJ);
    $nbUtilisateur=$res->total;
    return $nbUtilisateur;
    $req-> closeCursor();
  }

  //fonction permettant de compter le nombre d'étudiants enregistrés
  public function countEtudiants(){
    $res=array();
    $req = $this->db->prepare("SELECT count(idUtilisateur) AS total FROM utilisateur WHERE estProf = 0");
    $req->execute();
    $res = $req->fetch(PDO::FETCH_OBJ);
    $nbUtilisateur=$res->total;
    return $nbUtilisateur;
    $req-> closeCursor();
  }

  //fonction permettant de recuperer un utilisateur à partir d'un nom d'utilisateur
  public function getUtilisateurByLogin($login){
    $req=$this ->db->prepare
    ("SELECT idUtilisateur,estProf,nom,prenom,nomUtilisateur,motDePasse  FROM utilisateur WHERE nomUtilisateur = :login");
    $req ->bindValue(':login',$login,PDO::PARAM_STR);
    $req->execute();
    $resu = $req->fetch(PDO::FETCH_OBJ);
    if($resu!=null){
    return new Utilisateur($resu);
  } else {
    return null;
  }
    $req -> closeCursor();
  }

  //fonction permettant de verifier si un utilisateur correspondant à une id est un étudiant
  public function estEtudiantByid($id){

    if(isset($id)){

      $req = $this->db->prepare(
        'SELECT idUtilisateur FROM etudiant WHERE idUtilisateur = :id'
      );
      $req->bindValue(':id',$id,PDO::PARAM_STR);
      $req->execute();
      return $req->fetch(PDO::FETCH_OBJ);
      $req->closeCursor();
    }
  }

  //fonction permettant de recuperer un utilisateur à partir d'une id
  public function getUtilisateurById($id){

    if(isset($id)){

      $req=$this->db->prepare(
        'SELECT idUtilisateur,estProf,nom, prenom, nomUtilisateur, motDePasse FROM utilisateur WHERE idUtilisateur= :id'
      );
      $req->bindValue(':id',$id,PDO::PARAM_STR);
      $req->execute();

      $res=$req->fetch(PDO::FETCH_OBJ);
      return new Utilisateur($res);
      $req->closeCursor();
    }
  }

  //fonction permettant de calculer la moyenne générale d'un étudiant passé en parametre
  public function calculerMoyenne($etudiant){

    if(isset($etudiant)){
      $res = array();
      $id = $etudiant ->getIdUtilisateur();
      $req=$this->db->prepare(
        'SELECT AVG(note) AS moyenne FROM `note` WHERE idUtilisateur = :id'
      );
      $req->bindValue(':id',$id,PDO::PARAM_STR);
      $req->execute();
      $res=$req->fetch(PDO::FETCH_OBJ);
      $moyenne = $res->moyenne;
      return $moyenne;
      $req->closeCursor();
    }
  }



}
