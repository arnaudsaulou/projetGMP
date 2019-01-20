<?php
$idEtudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION['log'])->getIdUtilisateur();
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);
$idSujet = $attribue[0]->getIdSujet();
$idEnonce = $sujetManager->getSujetAvecId($idSujet)->getIdEnonce();
$enonce = $enonceManager->recupererEnonceViaIdEnonce($idEnonce);
echo $enonce->getEnonce();