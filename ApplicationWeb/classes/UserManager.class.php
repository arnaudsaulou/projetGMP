utilisateurun utilisateur<?php

class UserManager{

  public function __construct($db){
    $this->db = $db;
  }

  //fonction permettant d'jouter un utilisateur (prof ou élève)
  public function addUtilisateur($User){
    $req=$this ->db->prepare
    ('INSERT INTO utilisateur (estProf,nom,prenom,nomUtilisateur,motDePasse)
    VALUES (:estProf,:nom,:prenom,:login,:pwd)');

    $req ->bindValue(':estProf',$User->getEstProf(),PDO::PARAM_STR);
    $req ->bindValue(':nom',$User->getNom(),PDO::PARAM_STR);
    $req ->bindValue(':prenom',$User->getPrenom(),PDO::PARAM_STR);
    $req ->bindValue(':login',$User->getNomUtilisateur(),PDO::PARAM_STR);
    $req ->bindValue(':pwd',$User->getMotDePasse(),PDO::PARAM_STR);

    $req->execute();
  }

  //fonction permettant de lister tous les utilisateurs (prof ET élèves)
  public function getList(){

    $req = $this->db->prepare('SELECT idUtilisateur,estProf,nom,prenom FROM utilisateur ORDER BY nom');
    $req->execute();

    $listeUser=array();

    while($user=$req->fetch(PDO::FETCH_OBJ)){
      $listeUser[]=new Utilisateur($user);
    }
    return $listeUser;
    $req->closeCursor();
  }

  //fonction permettant de compter le nombre d'utilisateurs enregistrés (prof ET élèves)
  public function countUtilisateurs(){
    $res=array();
    $req = $this->db->prepare("SELECT count(idUtilisateur) as total FROM utilisateur");
    $req->execute();
    $res = $req->fetch(PDO::FETCH_OBJ);
    $nbUser=$res->total;
    return $nbUser;
    $req-> closeCursor();
  }

  //fonction permettant de recuperer un utilisateur à partir d'un nom d'utilisateur
  public function getUtilisateurByLogin($login){
    $req=$this ->db->prepare
    ("SELECT idUtilisateur,nom,prenom,nomUtilisateur,motDePasse  FROM utilisateur where per_login = :login");
    $req ->bindValue(':login',$login,PDO::PARAM_STR);
    $req->execute();
    $resu = $req->fetch(PDO::FETCH_OBJ);
    return new Utilisateur($resu);
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
        'SELECT idUtilisateur,nom, prenom,nomUtilisateur, motDePasse FROM utilisateur where idUtilisateur= :id'
      );
      $req->bindValue(':id',$id,PDO::PARAM_STR);
      $req->execute();

      $res=$req->fetch(PDO::FETCH_OBJ);
      return new Utilisateur($res);
      $req->closeCursor();
    }
  }




  }
