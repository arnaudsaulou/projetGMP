<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];}
	else
	{$page=0;
	}

switch ($page) {

case 0:
	// Page d'accueil
	include_once('pages/accueil.inc.php');
	break;
	// inclure ici l'affichage de la liste des étudiants
case 1:
	include("pages/afficherEtudiants.inc.php");
  break;

case 2:
	// inclure ici la page permettant l'iportation des étudiants
	include_once('pages/importerEtudiants.inc.php');
  break;

case 3:
	// inclure ici la page de connexion
	include_once('pages/connexion.inc.php');
  break;

case 4:
	// inclure ici la page de deconnexion
	include_once('pages/deconnexion.inc.php');
  break;

case 5:
	// inclure ici la page permettant de generer un sujet
  include("pages/creerEnonce.inc.php");
	break;

case 6:
	// inclure ici la page
	include("pages/genererSujet.inc.php");
  break;

case 7:
	// inclure ici la page
	include_once('pages/accueil.inc.php');
  break;

case 8:
	// inclure ici la page
	include_once('pages/accueil.inc.php');
  break;

case 9:
	// inclure ici la page
	include_once('pages/accueil.inc.php');
	break;

case 10:
	// inclure ici la page
	include_once('pages/accueil.inc.php');
	break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
