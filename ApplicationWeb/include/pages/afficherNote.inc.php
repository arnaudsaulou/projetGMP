
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
	  <li class="breadcrumb-item">
	    <a href="#">Afficher mes résultats</a>
	  </li>
	</ol>

</br>

	<?php
		$etudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION["co"]);
		$idEtudiant=$etudiant->getIdUtilisateur();
		$listeNoteEtudiant=$noteManager->getNoteByIdEtudiant($idEtudiant);
	?>

	<h2>Note de l'élève <?php echo $etudiant->getNom() . " " . $etudiant->getPrenom(); ?></h2>

<table>
		<tr class="enTete">

			<th>Numero de sujet</th>
			<th>Nummero Note</th>
			<th>Date d'attribution</th>
			<th>Note</th>

		</tr>
<?php
	foreach($listeNoteEtudiant as $note){
			$attribue=$attribueManager->getAttribueById($idEtudiant,$note->getIdSujet());
?>

		<tr>

			<td><?php echo $note->getIdSujet(); ?> </td>
			<td><?php echo $note->getNumNote(); ?></td>
			<td><?php echo $attribue->getDateAttribution(); ?></td>
			<td><?php echo $note->getNote(); ?> </td>

		</tr>
			<?php } ?>

	</table>
