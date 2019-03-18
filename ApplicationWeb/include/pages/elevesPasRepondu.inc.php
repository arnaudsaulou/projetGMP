<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Espace gestion</a>
  </li>
  <li class="breadcrumb-item active">Lister les étudiants n'ayant pas répondu à un énoncé</li>
</ol>

<?php if (!isset($_GET['idEnonce'])) { ?>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Liste des énoncés enregistrés
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Numéro</th>
              <th>Titre</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            //on récupère la liste des énoncés enregistrés
            $listeEnonce = $enonceManager->recupererListEnonce();
            foreach ($listeEnonce as $enonce) {
              ?>
              <tr>
                <td>
                  <?php echo $enonce->getIdEnonce() ?>
                </td>
                <td>
                  <?php echo $enonce->getNomEnonce() ?>
                </td>
                <td>
                  <button class="btn btn-secondary" type="button" name="button" onclick="window.location.href='index.php?page=21&idEnonce=<?php echo $enonce->getIdEnonce(); ?>'">Consulter la liste</button>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Numéro</th>
              <th>Titre</th>
              <th>Actions</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
<?php } else {
  $idEnonce = $_GET['idEnonce'];
  $tabEleves = $attribueManager->getListeElevesNAyantPasRepondu($idEnonce);

  if (!empty($tabEleves)) {
    ?>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Liste des étudiants n'ayant pas répondu à l'énoncé sélectionné :
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Année</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($tabEleves as $eleve) { ?>
                <tr>
                  <td><?php echo $eleve->getIdUtilisateur(); ?></td>
                  <td><?php echo $eleve->getNom(); ?></td>
                  <td><?php echo $eleve->getPrenom(); ?></td>
                  <td><?php echo $eleve->getAnnee(); ?></td>
                </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Année</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="attributionConfirme">
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-success" role="alert">
          <p>Soit l'énoncé n'a pas été attribué, soit tous les élèves y ont répondu !</p>
        </div>
      </div>
      <a class="btn btn-link" href="index.php?page=21"><p>Retour à la liste des énoncés</p></a>
    </div>
  <?php }
}
?>
<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
