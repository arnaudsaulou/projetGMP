<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des contrôle</a>
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
			  </tr>
			</thead>
			<tbody>
			  <?php
			  //on récupère la liste des énoncés enregistrés
			  $listeEnonce = $enonceManager->recupererListEnonce();
			  foreach ($listeEnonce as $enonce){
				?>
				<tr>
				  <td><a href="index.php?page=8&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce->getIdEnonce()?></a></td>
				  <td><a href="index.php?page=8&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce ->getNomEnonce()?></a></td>
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
