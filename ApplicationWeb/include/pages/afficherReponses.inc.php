<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des contrôles</a>
  </li>
  <li class="breadcrumb-item active">Lister les réponses reçues</li>

</ol>
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Liste des réponses reçues
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Promo de l'élève</th>
            <th>Nom de l'élève</th>
            <th>Prénom de l'élève</th>
            <th>Numéro de sujet</th>
            <th>Titre de l'énoncé</th>
            <th>Date d'attribution</th>
            <th>Date de réponse</th>
            <th>Note</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Promo de l'élève</th>
            <th>Nom de l'élève</th>
            <th>Prénom de l'élève</th>
            <th>Numéro de sujet</th>
            <th>Titre de l'énoncé</th>
            <th>Date d'attribution</th>
            <th>Date de réponse</th>
            <th>Note</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          //on récupère la liste des submissions enregistrés
          $listeSubmissions = $submissionManager->getList();
          foreach ($listeSubmissions as $Submission) {
            ?>
            <tr>
              <td><?php echo $Submission->getPromo()." A" ?></td>
              <td><?php echo $Submission->getNom() ?></td>
              <td><?php echo $Submission->getPrenom() ?></td>
              <td><?php echo $Submission->getIdSujet()?></td>
              <td><?php echo $Submission->getTitreEnonce()?></td>
              <td><?php echo $Submission->getDateAttribution()?></td>
              <td><?php echo $Submission->getDateSubmission()?></td>
              <td><?php echo $Submission->getNote()?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
