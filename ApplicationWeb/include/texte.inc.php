<div class="texte">
  <?php


  if (!empty($_GET["page"])) {
    $page = $_GET["page"];
  } else {
    $page = 0;
  }

  if (!isset($_SESSION['droits'])) {
    $page = 3; // si la personne n'est pas connectée elle est redirigée vers la page de connexion
  }

  switch ($page) { //pour chaque cas on test si la personne a les droits d'acceder à la page

    case 0:
    // Page d'accueil
    if ($_SESSION['droits'] == 1) {
      include_once('pages/accueil.inc.php');
    }
    else{
      include_once('pages/accueilEtudiant.inc.php');
    }
    break;
    // inclure ici l'affichage de la liste des étudiants
    case 1:
    if ($_SESSION['droits'] == 1) {
      include("pages/afficherEtudiants.inc.php");
    }
    break;

    case 2:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page permettant l'iportation des étudiants
      include_once('pages/importerEtudiants.inc.php');
    }
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
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page permettant de generer un sujet
      include("pages/creerEnonce.inc.php");
    }
    break;

    case 6:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page
      include("pages/attribuerSujet.inc.php");
    }
    break;

    case 7:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page
      include_once('pages/consulterListeEnonces.inc.php');
    }
    break;

    case 8:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page
      include_once('pages/afficherReponses.inc.php');
    }
    break;

    case 9:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page
      include_once('pages/corrigerEnonce.inc.php');
    }
    break;

    case 10:
    if ($_SESSION['droits'] == 0) {
      // inclure ici la page
      include_once('pages/afficherNote.inc.php');
    }
    break;

    case 11:
    if ($_SESSION['droits'] == 1) {
      // inclure ici la page
      include_once('pages/afficherAttributionSujet.inc.php');
    }
    break;

    case 12:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/supprimerEtudiants.inc.php');
    }
    break;

    case 13:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/supprimerPromotion.inc.php');
    }
    break;

    case 14:
    include_once('pages/parametre.inc.php');
    break;

    case 15:
    if ($_SESSION['droits'] == 0) {
      include_once('pages/repondreSujet.inc.php');
    }
    break;

    case 16:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/afficherDetailsReponse.inc.php');
    }
    break;

    case 17:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/consulterDetailEnonce.inc.php');
    }
    break;

    case 18:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/imprimerSujet.inc.php');
    }
    break;

    case 19:
    if ($_SESSION['droits'] == 1) {
      include_once('pages/previewFichierPdf.inc.php');
    }
    break;

    default :
    include_once('pages/accueil.inc.php');
  }

  ?>
</div>
