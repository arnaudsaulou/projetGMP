<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Gestion des étudiants</a>
  </li>
  <li class="breadcrumb-item active">Lister les étudiants</li>
</ol>

<!-- affichage du nombre d'étudiant présent dans la base de données -->
<p> Il y a <?php echo $utilisateurManager->countEtudiants();?> étudiants enregistrés</p>

<table>
  <tr class="enTete">
    <th>Numéro</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Moyenne</th>
  </tr>

  <?php
  //on récupère la liste des étudiants enregistrés
  $listeEtudiants =$utilisateurManager->getListEtudiants();
  foreach ($listeEtudiants as $etudiant){
    ?>
    <tr>
      <td><?php echo $etudiant->getIdUtilisateur()?></td>
      <td><?php echo $etudiant ->getNom()?></td>
      <td><?php echo $etudiant ->getPrenom()?></td>
      <td><?php echo $utilisateurManager ->calculerMoyenne($etudiant)?></td>
    </tr>
    <?php
  }
  ?>
</table>
