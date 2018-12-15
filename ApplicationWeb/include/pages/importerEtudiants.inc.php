<form enctype="multipart/form-data" action="#" method="post">
  <label for="fichier">Fichier &agrave; importer (doit être un fichier CSV): </label>
  <input name="fichier" type="file" accept=".csv" required />
  <input class="button" type="submit" value="Importer le fichier" />
</form>

<?php
/**
* Crée une nouvelle instance d'Utilisateur à partir d'une ligne.
* @param string $ligne La ligne à traiter.
* @return Utilisateur Une nouvelle instance d'Utilisateur avec les données spécifiées dans la ligne.
*/
function creerUtilisateurAPartirDeLigne($ligne) {
  $elements = explode(',', $ligne);
  $attributs = array(
    "estProf" => 0,
    "nom" => $elements[0],
    "prenom" => $elements[1],
    "nomUtilisateur" => $elements[2],
    "motDePasse" => $elements[3]
  );

  $utilisateur = new Utilisateur($attributs);

  return $utilisateur;
}

/**
* Traite le fichier CSV reçu par le serveur.
* @param string $file - Le contenu du fichier CSV reçu par le serveur.
*/
function traiterFichier($file) {
  $utilisateurManager = new UtilisateurManager(new MyPDO());

  //Création d'un tableau de ligne. L'expression régulière est faite pour supporter
  //tous les retours à la ligne possibles (Linux/Mac/Windows)
  $lignes = preg_split("/\\r\\n|\\r|\\n/", $file);
  foreach ($lignes as $ligne) {

    //On ignore toutes les lignes vides (Oui, Excel/Calc peuvent générer des lignes vides)
    if (strlen($ligne) > 0) {
      $utilisateur = creerUtilisateurAPartirDeLigne($ligne);
      $utilisateurManager->addUtilisateur($utilisateur);
    }
  }
}

//Test de vérification: On vérifie ici si le fichier existe bien, et si on peut le lire
//avant de le traiter.
if (isset($_FILES['fichier'])) {
  $file = file_get_contents($_FILES['fichier']['tmp_name']);
  if ($file === FALSE) {
    echo "<p>Une erreur est survenue. Veuillez r&eacute;essayer s'il vous pla&icirc;t.</p>";
  } else {
    traiterFichier($file);
  }
}
