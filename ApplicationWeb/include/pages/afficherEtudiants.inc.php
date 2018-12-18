
<h1> Liste des étudiants enregistrés</h1>
Il y a
<?php echo $utilisateurManager->countEtudiants();
?>
 étudiants enregistrés

	<table>
		<tr class="enTete">
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prenom</th>
      <th>Moyenne</th>
		</tr>

	<?php
	$listeEtudiants =$utilisateurManager->getListEtudiants();
	foreach ($listeEtudiants as $etudiant){
		?>
		<tr>
			<td><?php echo $etudiant->getIdUtilisateur()?></td>
			<td><?php echo $etudiant ->getNom()?></td>
			<td><?php echo $etudiant ->getPrenom()?></td>
      <td><?php echo $utilisateurManager ->calculerMoyenne($etudiant)?></td>
		</tr>
	<?php } ?>
	</table>
