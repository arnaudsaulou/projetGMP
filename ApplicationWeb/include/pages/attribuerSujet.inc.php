<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des contrôle</a>
  </li>
  <li class="breadcrumb-item active">Attribution des sujets</li>
</ol>
<?php
if($enonceManager->checkUnfinishedCorrection()){
  ?>
  <div class="attributionError">
    <div class='row justify-content-center'>
      <div class="col-4 align-self-center alert alert-danger" role="alert">
        <p>Il est impossible d'attribuer des sujets aux élèves tant qu'un énoncé est dépourvu de correction.</p>
      </div>
    </div>
    <a class="btn btn-link" href="index.php?page=6"><p>Retour</p></a>
  </div>
  <?php
}
else {
  if( empty($_POST['choix_promotion'])){
    ?>
    <form class="form-row"  action="#" method="POST">
      <div class="col-md-4 mb-3">
        <label for="choixPromo">Promotion :</label>
        <select class="form-control" id="choixPromo" name="choix_promotion">
          <option value="1"> Année 1</option>
          <option value="2"> Année 2</option>
        </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="choixDateLimite">Date limite de réponse :</label>
        <input class="form-control" id="choixDateLimite" required type="date" name="date_limite" value="<?php echo date("Y-m-d"); ?>">
      </div>

      <div class="col-md-4 mb-3">
        <label for="choixCooldown">Temps d'attente entre chaque réponse :</label>
        <select class="form-control" id="choixCooldown" name="choix_cooldown">
          <option value="1"> 1 jour</option>
          <option value="2"> 2 jours</option>
          <option value="3"> 3 jours</option>
          <option value="4"> 4 jours</option>
          <option value="5"> 5 jours</option>
          <option value="6"> 6 jours</option>
          <option value="7"> 1 semaine </option>
          <option value="14"> 2 semaines </option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-12 mb-3">
        <label for="choixSujet">Liste des énoncé : <?php echo $enonceManager->compterEnonce();?> énoncé(s) a/ont été trouvé :</label>
        <select class="form-control" id="choixSujet" name="choix_sujet">
          <?php
          $listEnonce = $enonceManager->recupererListEnonce();
          foreach ($listEnonce as $enonce){
            echo $enonce->getIdEnonce();
            ?>
            <option value="<?php echo $enonce->getIdEnonce();?>"><?php echo $enonceManager->recupererEnonceViaIdEnonce($enonce->getIdEnonce())->getNomEnonce(); ?></option>
            <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <button class="btn btn-primary" type="submit">Confirmer</button>
    </div>
  </form>


  <?php
}
else if(isset($_POST['choix_promotion'])){

  $enonceChoisi = $_POST['choix_sujet'];
  $anneeChoisi = $_POST['choix_promotion'];

  $idMaxSujet = $attribueManager->getIdSujetMaximumByIdEnonce($enonceChoisi);
  $idMinSujet = $attribueManager->getIdSujetMinimumByIdEnonce($enonceChoisi);

  $listEtudiant = $utilisateurManager->recupererPromotionEtudiante($anneeChoisi);
  $nbEtudiants = $utilisateurManager->recupererNbEtudiantsPromotion($anneeChoisi);
  $nbSujets = $idMaxSujet - $idMinSujet;
  $count = 0;

  if(intval($nbEtudiants) < $nbSujets) {
    foreach ($listEtudiant as $etudiant) {

      $table = $attribueManager->getUniqueIdSujet($anneeChoisi);
      $idSujetAlea = (int) rand($idMinSujet ,$idMaxSujet);

      while(in_array($idSujetAlea, $table)){
        $idSujetAlea = rand($idMinSujet ,$idMaxSujet );
      }

      $attribuerSujet = new Attribue(array('idUtilisateur' => $etudiant->getIdUtilisateur(),
      'idSujet' => $idSujetAlea,
      'dateAttribution' => date("Y-m-d"),
      'dateLimite' => $_POST["date_limite"],
      'cooldown' => $_POST["choix_cooldown"],
    ));

    if($attribueManager->countNombreDeFoisQuunSujetAEteAttribueAUnEtudiant($etudiant->getIdUtilisateur(), $enonceChoisi) < 1){
      $attribueManager->addAttribue($attribuerSujet);
    }
    else{
      $count = $count+ 1;
    }
  }
  if($count >0){
    ?>
    <div class="attributionError">
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-warning" role="alert">
          <p>L'attribution s'est déroulée sans erreur mais <?php echo $count ?> étudiants avaient déjà reçu le sujet.</p>
        </div>
      </div>
      <a class="btn btn-link" href="index.php?page=6"><p>Retour</p></a>
    </div>
    <?php
  } else {
    ?>
    <div class="attributionConfirme">
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-success" role="alert">
          <p>Les sujets ont été attribués avec succès !</p>
        </div>
      </div>
      <a class="btn btn-link" href="index.php?page=6"><p>Retour</p></a>
    </div>
    <?php
  }
}else{
  ?>
  <div class="attributionError">
    <div class='row justify-content-center'>
      <div class="col-4 align-self-center alert alert-danger" role="alert">
        <p>Les sujets n'ont pas pu être attribués à la promotion car il y a plus d'étudiants que de sujets disponibles !</p>
      </div>
    </div>
    <a class="btn btn-link" href="index.php?page=6"><p>Retour</p></a>
  </div>
  <?php
}
?>

<?php
}
}
?>
