<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des contrôle</a>
  </li>
  <li class="breadcrumb-item active">Attribution des sujets</li>
</ol>

<?php
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
      <label for="choixSujet">Liste des sujets : <?php echo $sujetManager->countSujet();?> sujet(s) a/ont été trouvé :</label>
      <select class="form-control" id="choixSujet" name="choix_sujet">
        <?php
        $listSujets = $sujetManager->getListEnonces();
        foreach ($listSujets as $sujet){
          echo $sujet->getIdEnonce();
          ?>
          <option value="<?php echo $sujet->getIdEnonce();?>">Contrôle n° <?php echo $sujet->getIdEnonce(); ?> de Mécanique</option>
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

  if($attribueManager->countNombreDeSujetAttribuerAUnEtudiant($etudiant->getIdUtilisateur(), $enonceChoisi) < 1){
    $attribueManager->addAttribue($attribuerSujet);
  }

}
?>

<script type="text/javascript">
$(document).ready(function() {
  $('#confirmerModal').modal('show');
});

document.getElementById("myButton").onclick = function(){
  location.href="index.php?page=6";
};
</script>



<?php
}
?>

<div class="modal fade" id="confirmerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Un sujet aléatoire a été ou  est déjà attribué à tout les étudiants ! </h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Appuyer sur "Continuer" pour attribuer d'autres sujets.</div>
      <div class="modal-footer">
        <form id="formConfirmAttribution" name="formConfirmAttribution" method="post" action="#">
          <button id="myButton" onclick="location.href = 'index.php?page=6';" class="btn btn-secondary" type="button" data-dismiss="modal">Continuer</button>
        </form>
      </div>
    </div>
  </div>
</div>
