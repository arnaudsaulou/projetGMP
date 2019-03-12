<?php
if(isset($_GET["annee"]) && isset($_GET["idEnonce"])){?>

  <?php
  $annee = $_GET["annee"];
  $idEnonce = $_GET["idEnonce"];
  ?>


  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Espace gestion</a>
    </li>
    <li class="breadcrumb-item active">Lister les attributions</li>
    <li class="breadcrumb-item active">Exportation des données des sujets correspondant à l'énoncé : <b><?php echo $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getNomEnonce() ?></b> attribués aux élèves de l'année : <b><?php echo $annee; ?></b></li>
  </ol>
  <?php

  $listeTypeDonnee = $enonceManager->getTypeDonneVariablePresentDansEnonce($idEnonce);

  //génération de l'entête
  $entete[0] = 'Numero de Sujet';
  foreach ($listeTypeDonnee as $key => $value) { //génération de l'entête :
    $entete[$key+1] = $value->getLibelle();
  }
  // Les lignes du tableau
  $lignes[] = $entete;

  //génération des données :
  $listeIdSujets = $sujetManager->getIdSujetsAttribueByIdEnonceAndAnnee($idEnonce,$annee);
  foreach ($listeIdSujets as $key => $value) {
    //on parcours chacun des sujets attribués
    $ligneEncours[0] = $value;
    $listeDonneeVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($value);
    foreach ($listeDonneeVariable as $key => $value) {
      //puis chacune des données varibles enregistrées
      $ligneEncours[$key+1] = $value->getValeur();
    }
    $lignes[] = $ligneEncours;
  }

  ?>
  <div class="alert alert-primary">
    Les données ont été chargées, le téléchargement va débuter automatiquement.
  </div>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Données des sujets correspondant à l'énoncé : <b><?php echo $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getNomEnonce() ?></b> attribués aux élèves de l'année : <b><?php echo $annee; ?></b>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <?php foreach ($entete as $key => $value){ ?>
                <th><?php print($value); ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <?php foreach ($entete as $key => $value){ ?>
                <th><?php print($value); ?></th>
              <?php } ?>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($lignes as $key => $ligne) {
              if($key != 0) {
                ?>
                <tr>
                  <?php foreach ($ligne as $key => $value){
                    print("<td>".$value."</td>");
                  } ?>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Mise à jour le : <?php echo date("d/m/Y");?></div>
  </div>

  <?php

  // Paramétrage de l'écriture du futur fichier CSV
  $chemin = 'public/exportDonnees/GMP_DonneesExporte_Catia.csv';
  $delimiteur = ';'; // Pour une tabulation, utiliser $delimiteur = "t";

  // Création du fichier csv (le fichier est vide pour le moment)
  $fichier_csv = fopen($chemin, 'w+');

  // Permet la compatibilité du fichier avec Excel
  fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

  foreach($lignes as $ligne){
    // chaque ligne en cours de lecture est insérée dans le fichier
    // les valeurs présentes dans chaque ligne seront séparées par $delimiteur
    fputcsv($fichier_csv, $ligne, $delimiteur);
  }

  // fermeture du fichier csv
  fclose($fichier_csv);
  ?>
  <meta http-equiv="refresh" content="1; URL=public/exportDonnees/GMP_DonneesExporte_Catia.csv">
  <?php
}else{
  //la page a été obtenue via bidouille dans l'url

  ?><!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Espace gestion</a>
    </li>
    <li class="breadcrumb-item">Lister les attributions</li>
    <li class="breadcrumb-item active">Erreur !</li>
  </ol>

  <div class="alert alert-danger" role="alert">
    Hum... Il semblerait que vous ayez atteint cette page par erreur ! Les données n'ont pas pu être chargées.
  </div>
  <?php

} ?>
<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
