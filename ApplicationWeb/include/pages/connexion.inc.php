
<div class="container">
  <div class="card card-login mx-auto mt-5"><?php
  if (empty($_POST)){
    if(isset($_SESSION['co'])){
      ?>
      Vous êtes déjà connecté, vous allez être redirigé dans 2 secondes !
      <meta http-equiv="refresh" content="2; URL=index.php">
      <?php
    }else {
      ?>

      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="#" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Identifiant" required="required" autofocus="autofocus">
              <label for="inputLogin">Identifiant</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="required">
              <label for="inputPassword">Mot de passe</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Valider">
        </form>
      </div>


      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>



      <?php
    }
  }else{
    $utilisateur = $utilisateurManager->getUtilisateurByLogin($_POST['login']);
    if($utilisateur != null){
      if($utilisateur -> checkPassword($_POST['password'])){
        
        // le mot de passe est OK
        $_SESSION['co'] = $utilisateur->getPrenom() . " " . $utilisateur->getNom();
        $_SESSION['droits'] = $utilisateur->getEstProf();
        $connexion_en_cours = true;
        ?>
        <div class="card-header"><i class="fa fa-hourglass" style="color:green"></i>
          <span class="card-body">Connexion réussie !</span>
        </div>
        <div class="card-body">

          <a class="btn btn-primary btn-block" href="index.html">Cliquez ici si vous n'êtes pas redirigé</a>
        </div>
        <meta http-equiv="refresh" content="1; URL=index.php?page=0">
        <?php
      }else{
        // le login n'est pas OK
        ?>
        <div class="card-header"><i class="fa fa-exclamation-triangle" style="color:red"></i>
          <span class="card-body">Identifiant ou Mot de passe incorrect !</span>
        </div>
        <div class="card-body">

          <a class="btn btn-primary btn-block" href="index.php">Recommencer</a>
        </div>
        <?php
      }

    }else{
      // le mot de passe n'est pas OK
      ?>
      <div class="card-header"><i class="fa fa-exclamation-triangle" style="color:red"></i>
        <span class="card-body">Identifiant ou Mot de passe incorrect !</span>
      </div>
      <div class="card-body">

        <a class="btn btn-primary btn-block" href="index.php">Recommencer</a>
      </div>
      <?php
    }



  }
  ?>
</div>
</div>
