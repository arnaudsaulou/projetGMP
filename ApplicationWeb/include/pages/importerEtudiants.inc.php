<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des étudiants</a>
  </li>
  <li class="breadcrumb-item active">Importer des étudiants</li>
</ol>

<form class="needs-validation" novalidate enctype="multipart/form-data" action="#" method="post">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label class="custom-file-label" for="customFileLang">Selectionner un fichier &agrave; importer (doit être un fichier CSV) </label>
      <input type="file" name="fichier" accept=".csv" required class="custom-file-input" id="customFileLang" lang="fr">
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
  $file = file_get_contents($_FILES['fichier']['tmp_name']);
  if ($file === FALSE) {
    echo "<p>Une erreur est survenue. Veuillez reessayer.</p>";
  } else {
    traiterFichier($file,$utilisateurManager);
  }
}
