<?php
include_once ('fonctionsAffichageEnonce.inc.php');

//Récupération de l'Attribue.
$idEtudiant = $_SESSION['id'];
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

if (!isset($_POST['idSujet'])) {
    //TODO: Partie Bastien avec Datatables ici
} else {
    //Récupération de l'Enonce.
    $idSujet = $_POST['idSujet'];
    $idEnonce = $sujetManager->getSujetAvecId($idSujet)->getIdEnonce();
    $enonce = $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getEnonce();

    //Récupération des données variables
    $listeDonneeVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($idSujet);

    //Substitution et affichage de l'énoncé et des pourcentages.
    insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonce);
    //Ajout des réponses si elles existent.
    insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant, $solutionManager);
    //
    //Desactiver les inputs
    desactiverTousLesInputs($enonce);

    echo $enonce;
}



