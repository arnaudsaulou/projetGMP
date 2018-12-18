<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">

  <title>Projet GMP</title>

  <link rel="stylesheet" type="text/css" href="css/resetStyle.css" />
  <link rel="stylesheet" type="text/css" href="css/stylesheetProjetGMP.css" />
</head>

<body>
  
  <div class="header">
    <h1 class="titrePrincipal">Bienvenue sur le site du Projet GMP</h1>

    <?php
    if(isset($_SESSION['co'])){ //Test si l'utilisateur est connecté ou non
      ?>
      <div class="messageConnexion">
        <?php
        echo "  <h2>Connecté en tant que ".$_SESSION['co']." </h2>"
        ?>
      </div>
      <a href="index.php?page=4"><button type="button" name="button" class="grosButtonInverse">Deconnexion</button></a>
    <?php }
    else {
      ?>
      <a href="index.php?page=3"><button type="button" name="button" class="grosButtonInverse">Connexion</button></a>
      <?php
    } ?>

  </div>
