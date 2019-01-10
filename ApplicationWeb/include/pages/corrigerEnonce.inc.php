<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Corriger un énoncé</a>
  </li>
  <li class="breadcrumb-item active">Corriger l'énoncé n°<?php echo $_GET['idEnonce']; ?></li>

</ol>
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Corriger l'énoncé n°<?php echo $_GET['idEnonce']; ?></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr id="enteteTableau">
              <th>Question</th>
              <th>Formule</th>
              <th>Paramètre</th>
            </tr>
          </thead>
          <tfoot>
            <tr id="piedTableau">
              <th>Question</th>
              <th>Formule</th>
              <th>Paramètre</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            //on récupère la liste des questions de l'énoncé
            $listeQuestions = $questionManager->recupererListeQuestionD1Enonce($_GET['idEnonce']);

			//on récupère la liste des formule de correction disponible
			$dirname = "./formules";
			$dir = opendir($dirname);

			while ($file = readdir($dir)) {
				if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
					$file = str_replace(".php", "", $file);
					$listeFormules[] = $file;
				}
			}

			closedir($dir);

			//on récupère la liste des données variable de l'énoncé
			$listeTypeDonnee = $typeDonneeManager->getTypeDonnee();

			foreach ($listeQuestions as $key => $question) {
            ?>
				<tr>
					<td><?php echo ($key+1).')'.' '.$question->getLibelle(); ?></td>

					<td>
						<select name="formuleCorrection">
							<?php foreach ($listeFormules as $formules) { ?>
								<option value="<?php echo $formules; ?>" > <?php echo $formules; ?> </option>
							<?php } ?>
						</select>
					</td>

					<td id="paramSection<?php echo $key ?>">
						<select name="param0">
							<?php foreach ($listeTypeDonnee as $typeDonnee) { ?>
								<option value="<?php echo $typeDonnee->getIdType(); ?>"> <?php echo $typeDonnee->getLibelle(); ?> </option>
							<?php } ?>
						</select>
            <button class="btnAdParams" id="btnAdParams<?php echo $key ?>">+</button>
            <!-- <button class="btnAdParams" id="btnAdParams" onclick="ajouterParametres()">+</button> -->

					</td>

				<tr>
			<?php } ?>

          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>

  <!-- Page level plugin CSS-->
  <link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- scripts for this page-->
  <script src="js/callDatatables.js"></script>
  <script src="packages/datatables/jquery.dataTables.js"></script>
  <script src="packages/datatables/dataTables.bootstrap4.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/corrigerEnonce.js"></script>
