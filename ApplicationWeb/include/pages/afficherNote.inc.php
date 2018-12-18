<?php
if ($_SESSION['droits']==0){ ?>
<h1>note des élève</h1>
	<?php 
	$etudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION["co"]);
	$idEtudiant=$etudiant->getIdUtilisateur();
	echo "<h1> Note de l'élève ".$etudiant->getNom()." ". $etudiant->getPrenom()." </h1>";
	$listeNoteEtudiant=$noteManager->getNoteByIdEtudiant($idEtudiant); 
	
	
	?>
<table>
		<tr class="enTete">
			
			<th>numero de sujet</th>
			<th>Nummero Note</th>
			<th>date d'attribution</th>
			<th>note</th>
			
		</tr>
	<?php foreach($listeNoteEtudiant as $note){
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
<?php	
}
?>