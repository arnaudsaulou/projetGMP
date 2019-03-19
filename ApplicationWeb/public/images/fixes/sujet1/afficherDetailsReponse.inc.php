*<?php
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
    <li class="breadcrumb-item">Lister les réponses des élèves</li>
    <li class="breadcrumb-item active">Réponses reçues sur l'énoncé : <b><?php echo $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getNomEnonce() ?></b> par les élèves de l'année : <b><?php echo $annee; ?></b></li>
  </ol>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Liste des réponses des étudiants
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Nombre réponse</th>
              <th>Meilleur note</th>
              <th>Date première réponse</th>
              <th>Date dernière réponse</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Nombre réponse</th>
              <th>Meilleur note</th>
              <th>Date première réponse</th>
              <th>Date dernière réponse</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $listeStatReponse = $utilisateurManager->getStatReponseEtudiantParAnneeEtEnonce($annee, $idEnonce);
            foreach ($listeStatReponse as $reponse) {
              if($reponse->nbReponses != 0){
                ?>
                <tr>
                  <td><?php echo $reponse->nom;?></td>
                  <td><?php echo $reponse->prenom;?></td>
                  <td><?php echo $reponse->nbReponses;?></td>
                  <td><?php echo $reponse->meilleureNote;?></td>
                  <td><?php echo $reponse->premiereRep;?></td>
                  <td><?php echo $reponse->derniereRep;?></td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Page level plugin CSS-->
  <link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- scripts for this page-->
  <script src="js/callDatatables.js"></script>
  <script src="packages/datatables/jquery.dataTables.js"></script>
  <script src="packages/datatables/dataTables.bootstrap4.js"></script>
<?php }else{
//la page a été obtenue via bidouille dans l'url

?><!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Espace gestion</a>
  </li>
  <li class="breadcrumb-item">Lister les réponses des élèves</li>
  <li class="breadcrumb-item active">Erreur !</li>
</ol>

<div class="alert alert-danger" role="alert">Hum... Il semblerait que vous ayez atteint cette page par erreur ! Les données n'ont pas pu être chargés.

</div>
<?php

} ?>
