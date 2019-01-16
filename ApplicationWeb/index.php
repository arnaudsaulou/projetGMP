<?php
session_start();

require('include/config.inc.php');
require('include/autoLoad.inc.php');

//Managers ici
$db = new MyPDO();
$donneeVariableManager = new DonneeVariableManager($db);
$typeDonneeManager = new TypeDonneeManager($db);
$enonceManager = new EnonceManager($db);
$sujetManager = new SujetManager($db);
$sujetPossibleManager = new SujetPossibleManager($db);
$utilisateurManager = new UtilisateurManager($db);
$noteManager = new NoteManager($db);
$reponseManager = new ReponseManager($db);
$attribueManager = new AttribueManager($db);
$questionManager = new QuestionManager($db);
$solutionManager = new SolutionManager($db);
$submissionManager = new SubmissionManager($db);

require_once("include/header.inc.php");
require_once("include/menu.inc.php");
require_once("include/texte.inc.php");
require_once("include/footer.inc.php");
