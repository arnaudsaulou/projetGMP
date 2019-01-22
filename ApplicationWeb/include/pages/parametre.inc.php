
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a >Parametre</a>
  </li>
</ol>
<?php
$utilisateur=$utilisateurManager->getUtilisateurByLogin($_SESSION["log"]);
if (empty($_POST)){

  ?>

  <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Changer le mot de passe
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-header">
        <form  action="#" class="px-4 py-3" method="post">
          <div class="form-group">
            <label for="ancienMDP">Ancien mot de passe</label>
            <input type="password" class="form-control" id="ancienMDP" name="ancienMDP" required >
          </div>
          <div class="form-group">
            <label for="nouveauMDP">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="nouveauMDP" name="nouveauMDP" required>
          </div>
          <div class="form-group">
            <label for="confirmerMDP">Confirmer mot de passe</label>
            <input type="password" class="form-control" id="confirmerMDP" name="confirmerMDP" required>
          </div>
          <input type="submit" class="btn btn-primary" value="Valider">
        </form>

      </div>
    </div>
    <?php
  }else{

    if ($_POST['ancienMDP']==$utilisateur->getMotDePasse() && $_POST['nouveauMDP']==$_POST['confirmerMDP']){

      $utilisateurManager->changerMotDePasse($_POST['nouveauMDP'],$_SESSION['id']);
      ?>
      <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-success" role="alert">
          <p>Votre mot de passe a bien été changé</p>
        </div>
      </div>
      <?php
    }else{
      
      echo "<div class='row justify-content-center'>
      <div class=' col-9 align-self-center alert alert-danger' role='alert'>
      <p>Erreur: ce n'est pas le bon mot de passe ou le mot de passe de confirmation et le nouveau mot de passe sont différents</p>
      </div>
      </div>";
    }
    ?>

    <?php
  }
  ?>
