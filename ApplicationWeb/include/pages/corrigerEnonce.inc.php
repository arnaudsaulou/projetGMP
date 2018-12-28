<h3>Corriger l'énoncé n°<?php echo $_GET['idEnonce']; ?></h3>

<div>

  <h4>Liste des questions de l'énoncé</h4>

  <ul>

    <?php
      $listeQuestions = $questionManager->recupererListeQuestionD1Enonce($_GET['idEnonce']);

      foreach ($listeQuestions as $key => $question) {
    ?>
        <li>
          <?php echo ($key+1).')'.' '.$question->getLibelle(); ?>
        </li>
    <?php
      }
    ?>

  </ul>

</div>


<div>

  <h4>Liste des type de données de l'énoncé</h4>

  <ul>

    <?php
      $listeTypeDonnee = $typeDonneeManager->getTypeDonnee();

      foreach ($listeTypeDonnee as $key => $typeDonnee) {
    ?>
        <li>
          <?php echo ($key+1).')'.' '.$typeDonnee->getLibelle(); ?>
        </li>
    <?php
      }
    ?>

  </ul>

</div>


<div>

  <h4>Liste des formules enregistrées</h4>

  <ul>

    <?php

      $dirname = "./formules";
      $dir = opendir($dirname);

      while ($file = readdir($dir)) {
        if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
          $file = str_replace(".php", "", $file);
          echo "<li>".$file."<li>";
        }
      }

      closedir($dir);

    ?>

  </ul>

</div>
