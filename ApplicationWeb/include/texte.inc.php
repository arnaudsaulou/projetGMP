<div class="texte">
    <?php
    if (!empty($_GET["page"])){
        $page=$_GET["page"];
    }
    else{
        $page=0;
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
        include("pages/attribuerSujet.inc.php");
        break;

        case 7:
        // inclure ici la page
        include_once('pages/consulterListeEnonces.inc.php');
        break;

        case 8:
        // inclure ici la page
        include_once('pages/consulterDetailEnonce.inc.php');
        break;

        case 9:
        // inclure ici la page
        include_once('pages/accueil.inc.php');
        break;

        case 10:
        // inclure ici la page
        include_once('pages/afficherNote.inc.php');
        break;

        case 12:
        // inclure ici la page
        include_once('pages/repondreControleDemo.inc.php');
        break;

        case 100:
        // inclure ici la page
        include_once('pages/page1.php');
        break;

        default :     include_once('pages/accueil.inc.php');
    }

    ?>
</div>
</div>
