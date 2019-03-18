<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des étudiants</a>
  </li>
  <li class="breadcrumb-item active">Gérer les étudiants</li>
</ol>

<?php if (!isset($_POST['id_etumdp']) && !isset($_POST['id_etusupr'])) { ?>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Séléctionnez l'étudiant à supprimer
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Année</th>
              <th>Réinitialiser mot de passe ?</th>
              <th>Supprimer ?</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Année</th>
              <th>Réinitialiser mot de passe ?</th>
              <th>Supprimer ?</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $listeEtudiants = $utilisateurManager->getListEtudiants();
            foreach ($listeEtudiants as $etudiant) {
              ?>
              <tr>
                <td><?php echo $etudiant->getIdUtilisateur() ?></td>
                <td><?php echo $etudiant->getNom() ?></td>
                <td><?php echo $etudiant->getPrenom() ?></td>
                <td><?php echo $etudiant->getAnnee() ?></td>
                <td>
                  <a href="#" onclick="changerMDP(<?php echo $etudiant->getIdUtilisateur() ?>);"><i class="fas fa-lock-open"></i></a>
                </td>
                <td>
                  <a href="#" onclick="supprimer(<?php echo $etudiant->getIdUtilisateur() ?>);"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <script type="text/javascript">
    function supprimer(valeur) {
      document.formSupprimerEtudiant.id_etusupr.value = valeur;
      $('#supprModal').modal('show');
    }
    function changerMDP(valeur) {
      document.formMdpEtudiant.id_etumdp.value = valeur;
      $('#mdpModal').modal('show');
    }
    </script>
  </div>

  <!-- Modal Suppression -->
  <div class="modal fade" id="supprModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment supprimer l'étudiant ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Appuyer sur "Supprimer" pour confirmer.</div>
        <div class="modal-footer">
          <form id="formSupprimerEtudiant" name="formSupprimerEtudiant" method="post" action="#">
            <input id="id_etusupr" name="id_etusupr" type="hidden" value="">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <input class="btn btn-danger" type="submit" value="Supprimer">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal reset mdp -->
  <div class="modal fade" id="mdpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment réinitialiser le mot de passe de l'étudiant ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Le mot de passe de l'étudiant sera défini sur "password"</div>
        <div class="modal-footer">
          <form id="formMdpEtudiant" name="formMdpEtudiant" method="post" action="#">
            <input id="id_etumdp" name="id_etumdp" type="hidden" value="">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <input class="btn btn-danger" type="submit" value="Réinitialiser">
          </form>
        </div>
      </div>
    </div>
  </div>

<?php } else {
  if(!isset($_POST['id_etumdp'])){
    $noteManager->supprimerNotesAvecIdEtudiant($_POST['id_etusupr']);
    $reponseManager->supprimerReponsesAvecIdEtudiant($_POST['id_etusupr']);
    $attribueManager->supprimerAttribueAvecIdEtudiant($_POST['id_etusupr']);
    $utilisateurManager->supprimerUtilisateurAvecId($_POST['id_etusupr']);
    ?>
    <div class="suppressionConfirme">
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-success" role="alert">
          <p>L'étudiant a bien été supprimé !</p>
        </div>
      </div>
      <a class="btn btn-link" href="index.php?page=12"><p>Retour</p></a>
    </div>

  <?php } else{
    $utilisateurManager->resetMdp($_POST['id_etumdp']);
?>
<div class="suppressionConfirme">
  <div class='row justify-content-center'>
    <div class="col-4 align-self-center alert alert-success" role="alert">
      <p>Le mot de passe a bien été enregistré !</p>
    </div>
  </div>
  <a class="btn btn-link" href="index.php?page=12"><p>Retour</p></a>
</div>
<?php
  }
} ?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
