<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Espace gestion</a>
  </li>
  <li class="breadcrumb-item active">Liste des énoncés enregistrés</li>
</ol>

<!-- affichage du nombre d'énoncé présent dans la base de données -->
<p> Il y a <?php echo $enonceManager->compterEnonce();?> énoncé(s) enregistré(s)</p>
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Liste des énoncés enregistrés
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr >
            <th>Numéro</th>
            <th>Titre</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //on récupère la liste des énoncés enregistrés
          $listeEnonce = $enonceManager->recupererListEnonce();
          foreach ($listeEnonce as $enonce){
            ?>
            <tr>
              <td><a href="index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce->getIdEnonce()?></a></td>
              <td><a href="index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce ->getNomEnonce()?></a><?php if($enonceManager->checkUnfinishedCorrectionById($enonce->getIdEnonce())){ ?>
                <span class="badge badge-danger">Correction manquante</span> <?php
              }?></td>
              <td>
                  <input class="btn <?php if($enonceManager->checkUnfinishedCorrectionById($enonce->getIdEnonce())){
                    echo "btn-danger";
                  }else {
                    echo "btn-secondary";
                  }?>" value="Corriger" type="button" name="options" id="option1" autocomplete="off" onclick="window.location.href='index.php?page=9&idEnonce=<?php echo $enonce->getIdEnonce()?>'">
                  <input class="btn btn-secondary" type="button" value="Télécharger au format PDF" onclick="genererPDF(<?php echo $enonce->getIdEnonce()?>)">
                  <input class="btn btn-secondary" type="button" value="Tester" >
                  <input class="btn btn-secondary" type="button" value="Afficher" onclick="window.location.href='index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>'">
                  <input class="btn btn-secondary" type="button" value="Attribuer" onclick="window.location.href='index.php?page=6'">
              </td>

            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Mise à jour le : <?php echo date("d/m/Y");?></div>
</div>
<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
<script src="packages/pdf/jspdf.min.js"></script>
