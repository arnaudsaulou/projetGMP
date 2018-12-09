
<h1> Liste de etudiant enregistrees</h1>
Il y a
<?php echo $userManager->countEtudiants();
?>
 etudiants enregistrés

	<table>
		<tr class="enTete">
			<th>Numero</th>
			<th>Nom</th>
			<th>Prenom</th>
		</tr>

	<?php
	$listeEtudiants =$userManager->getListEtudiants();
	foreach ($listeEtudiants as $etudiant){
		?>

		<tr>
			<td><?php echo $etudiant->getIdUtilisateur()?></td>
			<td><?php echo $etudiant ->getNom()?></td>
			<td><?php echo $etudiant ->getPrenom()?></td>
		</tr>
	<?php } ?>
	</table>
