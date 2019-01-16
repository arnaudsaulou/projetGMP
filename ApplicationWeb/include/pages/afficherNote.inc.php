
<?php
$etudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION["log"]);
$idEtudiant=$etudiant->getIdUtilisateur();
$listeNoteEtudiant=$noteManager->getNoteByIdEtudiant($idEtudiant);

?>

<h2>Note de l'élève <?php echo $_SESSION['co'] ?></h2>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Liste des étudiants enregistrés</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Sujet</th>
							<th>Date de réponse</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($listeNoteEtudiant as $note){

							$sujet=$sujetManager->getSujetById($note->getIdSujet());
							$enonce=$enonceManager->recupererEnonceViaIdEnonce($sujet->getIdEnonce());

							?>
							
							<tr>

								<td><?php echo $enonce->getNomEnonce(); ?> </td>
								<td><?php echo $note->getDateReponse(); ?></td>
								<td><?php echo $note->getNote(); ?></td>

							</tr>

							<?php

						} ?>
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
