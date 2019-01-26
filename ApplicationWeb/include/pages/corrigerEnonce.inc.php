<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    <?php
    if(empty($_SESSION['lastInsertIdEnonce'])){
    ?>
      Corriger l'énoncé n°<?php echo $_GET['idEnonce']; ?>
    <?php
    } else {
    ?>
      Corriger l'énoncé n°<?php echo $_SESSION['lastInsertIdEnonce']; ?>
    <?php
    }
    ?>
  </div>

<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

      <thead>
        <tr id="enteteTableau">
          <th>Question</th>
          <th>Formule</th>
          <th>Paramètre</th>
          <th>Barème</th>
        </tr>
      </thead>

      <tfoot>
        <tr id="piedTableau">
          <th>Question</th>
          <th>Formule</th>
          <th>Paramètre</th>
          <th>Barème</th>
        </tr>

      </tfoot>

      <tbody>

      <?php

      //on récupère la liste des questions de l'énoncé
      if(empty($_SESSION['lastInsertIdEnonce'])){
        $listeQuestions = $questionManager->recupererListeQuestionEnonce($_GET['idEnonce']);
      } else {
        $listeQuestions = $questionManager->recupererListeQuestionEnonce($_SESSION['lastInsertIdEnonce']);
      }

      //on récupère la liste des formule de correction disponible
      $dirname = "./formules/correction";
      $listeFormules = $fichierManager->getListeFormules($dirname);

      //on récupère la liste des données variable de l'énoncé
      $listeTypeDonnee = $typeDonneeManager->getListTypeDonnee();

      foreach ($listeQuestions as $key => $question) {

      ?>

      <tr class="ligneQuestion">
        <td>
          <data id="question<?php echo $key; ?>" value="<?php echo $question->getIdQuestion(); ?>">
            <?php echo ($key+1).')'.' '.$question->getLibelle(); ?>
          </data>
        </td>

        <td>
          <select id="formuleCorrection<?php echo $key; ?>">
            <?php foreach ($listeFormules as $formules) { ?>
              <option value="<?php echo $formules; ?>" > <?php echo $formules; ?> </option>
            <?php } ?>
          </select>
        </td>

        <td id="paramSection<?php echo $key ?>">
          <select class="paramSection<?php echo $key ?>" id="param<?php echo $key ?>_0">
            <?php foreach ($listeTypeDonnee as $typeDonnee) { ?>
              <option value="<?php echo $typeDonnee->getIdType(); ?>"> <?php echo $typeDonnee->getLibelle(); ?> </option>
            <?php } ?>
          </select>

          <div>
            <button onclick="handleClickAddParams(event);" id="btnAdParams<?php echo $key ?>">+</button>
          </div>
        </td>

        <td>
          <input type="number" id="bareme<?php echo $key ?>">
        </td>
      </tr>

      <?php } ?>

      </tbody>
    </table>
    <div class="p-4">
      <button onclick="validerCorrection();" class="btn btn-primary col-12">VALIDER</button>
    </div>
  </div>
</div>

<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

</div>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="js/corrigerEnonce.js"></script>
