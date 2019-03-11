<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des étudiants</a>
  </li>
  <li class="breadcrumb-item active">Importer des étudiants</li>
</ol>
<form class="needs-validation" novalidate enctype="multipart/form-data" action="#" method="post">
  <div class="input-group mb-3 form-row">
    <div class="custom-file">
      <input type="file" name="fichier" accept=".csv" class="custom-file-input" id="inputGroupFile02">
      <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Selectionner un fichier à importer (doit être un fichier CSV) </label>
    </div>
  </div>
  <input class="btn btn-primary" type="submit" value="Importer le fichier" />
</form>

<?php
/**
* Crée une nouvelle instance d'Utilisateur à partir d'une ligne.
* @param string $ligne La ligne à traiter.
* @param $delimiteur
* @return Utilisateur Une nouvelle instance d'Utilisateur avec les données spécifiées dans la ligne.
*/
function creerUtilisateurAPartirDeLigne($ligne, $delimiteur) {
  $elements = explode($delimiteur, $ligne);
  $attributs = array(
    "estProf" => 0,
    "nom" => $elements[0],
    "prenom" => $elements[1],
    "nomUtilisateur" => $elements[2],
    "motDePasse" => $elements[3],
    "annee" => $elements[4]
  );

  $utilisateur = new Utilisateur($attributs);

  return $utilisateur;
}

/**
* Traite le fichier CSV reçu par le serveur.
* @param string $file - Le contenu du fichier CSV reçu par le serveur.
* @param $utilisateurManager - Le gestionnaire d'Utilisateurs qui va permettre d'ajouter des Utilisateurs.
*/
function traiterFichier($file,$utilisateurManager) {
  $delimiteur = detecterDelimiteur($file);
  $lignes = preg_split("/\\r\\n|\\r|\\n/", substr($file, strpos($file, "\n")+1 ));
  foreach ($lignes as $ligne) {
    if (strlen($ligne) > 0) {
      $utilisateur = creerUtilisateurAPartirDeLigne($ligne, $delimiteur);
      $utilisateurManager->addUtilisateur($utilisateur);
    }
  }
}

/**
* Détecte le délimiteur le plus utilisé dans la première ligne du fichier CSV,
* et retourne celui-ci.
* @param string $file Le fichier CSV, lu dans un string.
* @return string Le délimiteur le plus fréquemment utilisé.
*/
function detecterDelimiteur($file) {
  $delimiteurs = array (
    ';' => 0,
    ',' => 0
  );

  $index = -1;
  if(preg_match("/\\r\\n|\\r|\\n/", $file, $matches, PREG_OFFSET_CAPTURE)) {
    $index = $matches[0][1];
  }

  foreach ($delimiteurs as $delimiteur => &$nombre) {
    $nombre  = count(str_getcsv(substr($file,0, $index), $delimiteur));
  }

  return (array_search(max($delimiteurs), $delimiteurs));
}

//Test de vérification: On vérifie ici si le fichier existe bien, et si on peut le lire
//avant de le traiter.
if (isset($_FILES['fichier'])) {

  if (0 === $_FILES['fichier']['error']) { //on test si une erreur est survenue durant l'import d'un fichier
    if (stristr($_FILES['fichier']['name'],".csv")) {
      $file = file_get_contents($_FILES['fichier']['tmp_name']);
      if ($file === FALSE) {
        ?>
        <div class='row justify-content-center'>
          <div class="col-4 align-self-center alert alert-danger" role="alert">
            <p>Votre fichier semble être corrompu ! Pour proteger l'integrité de la base de données, il n'a pas été importé. !</p>
          </div>
        </div>
        <?php
      } else {
        ?>
        <div class='row justify-content-center'>
          <div class="col-4 align-self-center alert alert-success" role="alert">
            <p>Fichier chargé ! Importation des élèves réussie</p>
          </div>
        </div>
        <?php
        traiterFichier($file,$utilisateurManager);
      }
    } else {
      ?>
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-danger" role="alert">
          <p>Votre fichier n'est pas un fichier csv ! Veuillez importer un fichier correct avant de réessayer !</p>
        </div>
      </div>
      <?php
    }
  } else {
    ?>
    <div class='row justify-content-center'>
      <div class="col-4 align-self-center alert alert-danger" role="alert">
        <p>Il semblerait que vous n'ayez pas sélectionné de fichier ou que l'importation se soit mal passée. Veuillez réessayer !</p>
      </div>
    </div>
    <?php
  }
}

?>
<script src="js/importerEtudiants.js" type="text/javascript"></script>
