<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Gestion des contrôle</a>
  </li>
  <li class="breadcrumb-item active">Liste des énoncés enregistrés</li>
</ol>

<!-- affichage du nombre d'énoncé présent dans la base de données -->
<p> Il y a <?php echo $enonceManager->compterEnonce();?> énoncé(s) enregistré(s)</p>

<table>
  <tr class="enTete">
    <th>Numéro</th>
    <th>Titre</th>
  </tr>

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
</table>
