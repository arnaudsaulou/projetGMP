
<?php
if (empty($_POST)){
  if(isset($_SESSION['co'])){
    ?>
    Vous êtes déjà connecté, vous allez être redirigé dans 2 secondes !
    <meta http-equiv="refresh" content="2; URL=index.php?page=0">
    <?php
  }else {
    ?>
    <div>
      <h1>Pour vous connecter</h1>
      <form class="connexion" action="#" method="post">
        <div>
          <div>
            <label> Nom d'utilisateur:</label>
          </div>
          <div>
            <input type="text" name="login" size="4" required>
          </div>
        </div>
        <div>
          <div>
            <label>Mot de passe:</label>
          </div>
          <div>
            <input type="password" name="password" size="4" required>
          </div>
        </div>
        <div>
          <input class="button" type="submit" value="Valider" />
        </div>
      </form>
    </div>

    <?php
  }
}else{
  $utilisateur = $utilisateurManager->getUtilisateurByLogin($_POST['login']);
  if($utilisateur != null){
    if($utilisateur -> checkPassword($_POST['password'])){
      // le mot de passe est OK
      $_SESSION['co'] = $utilisateur->getNomUtilisateur();
      $_SESSION['droits'] = $utilisateur->getEstProf();
      ?>
      <h1>Connexion Réussie</h1>
      Vous allez etre redirigé dans 2 secondes !
      <meta http-equiv="refresh" content="2; URL=index.php?page=0">
      <?php
    }else{
      // le login n'est pas OK
      ?>
      <img src="Ressources/erreur.png" alt="connexion echouee">
      Login ou Mot de passe incorrect !
      <?php
    }

  }else{
    // le mot de passe n'est pas OK
    ?>
    <img src="Ressources/erreur.png" alt="connexion echouee">
    Login ou Mot de passe incorrect !
    <?php
  }



}
?>
