<?php
include_once ('fonctionsAffichageEnonce.inc.php');

//Récupération de l'Attribue.
$idEtudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION['log'])->getIdUtilisateur();
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

    //Substitution et affichage de l'énoncé et TODO: Ajout des pourcentages de différences.
    insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonce);
    //Ajout des réponses si elles existent.
    insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant);
    //
    //Desactiver les inputs
    desactiverTousLesInputs($enonce);

    echo $enonce;
}



