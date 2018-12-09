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
	// Affichage de la liste des étudiants
case 1:
	include("pages/afficherEtudiants.inc.php");
  break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/listerPersonnes.inc.php');
  break;

case 3:
	// inclure ici la page modifier personnes
	include_once('pages/modifierPersonnes.inc.php');
  break;

case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
  break;

//
// Parcours
//
case 5:
	// inclure ici la page ajouter parcours
    include("pages/ajouterParcours.inc.php");
    break;

case 6:
	// inclure ici la page liste des parcours
	include("pages/listerParcours.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	include("pages/ajouterVille.inc.php");
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/listerVilles.inc.php");
    break;

//
// Trajets
//
case 9:
	// inclure ici la page proposer trajet uniuquement si l'utilisateur est connecté
		if(!empty($_SESSION['numeroPersonneConnecte']) && !empty($_SESSION['loginPersonneConnecte'])){
			include_once('pages/proposerTrajet.inc.php');
		} else {
			include_once('pages/accueil.inc.php');
		}
    break;
case 10:
	// inclure ici la page rechercher trajet uniuquement si l'utilisateur est connecté
		if(!empty($_SESSION['numeroPersonneConnecte']) && !empty($_SESSION['loginPersonneConnecte'])){
			include_once('pages/chercherTrajet.inc.php');
		} else {
			include_once('pages/accueil.inc.php');
		}
    break;

case 11:
	// inclure ici la page de connexion
	include_once('pages/connexion.inc.php');
    break;

case 12:
	// inclure ici la page de déconnexion uniuquement si l'utilisateur est connecté
	if(!empty($_SESSION['numeroPersonneConnecte']) && !empty($_SESSION['loginPersonneConnecte'])){
		include_once('pages/deconnexion.inc.php');
	} else {
		include_once('pages/accueil.inc.php');
	}
    break;

case 13:
	// inclure ici la page de detail d'une personne
	if(isset($_GET['numPersonneRecherchee'])){
		include_once('pages/detailPersonne.inc.php');
	}
		break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
