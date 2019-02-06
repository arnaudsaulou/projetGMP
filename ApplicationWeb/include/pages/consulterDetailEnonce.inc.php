<ol class="breadcrumb">
  <li class="breadcrumb-item"> <a href="index.php?page=7">Gestion des contrôle</a> </li>
  <li class="breadcrumb-item">
    <a href="index.php?page=7">Lister les énoncés enregistrés </a>
  </li>
  <li class="breadcrumb-item active">Enoncés</li>
</ol>
<?php

$enonce = $enonceManager->recupererEnonceViaIdEnonce($_GET['idEnonce']);

?>
<div>
<h1> Sujet n°<?php echo $enonce->getIdEnonce(); ?> : </h1>

<form>
  <input type="button" value="Corriger" onclick="window.location.href='index.php?page=9&idEnonce=<?php echo $_GET['idEnonce']?>'" />
</form>

<button onclick="genererPDFAvecHTML(document.getElementById('pdfwrapper'), 'enonce' + <?php echo $_GET['idEnonce']?>)">Télécharger au format PDF</button>
<button href="">Tester</button>

</div>

<div id="pdfwrapper">
    <div class="col-md-12">
        <?php
        echo $enonce->getEnonce();
        ?>
    </div>
</div>

<script src="packages/pdf/html2pdf.js"></script>
<script src="js/genererPdf.js"></script>
