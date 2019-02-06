<ol class="breadcrumb">
  <li class="breadcrumb-item">Espace gestion</li>
  <li class="breadcrumb-item">Lister les énoncés enregistrés</li>
  <li class="breadcrumb-item active">Affichage de l'énoncé numéro : <?php echo $_GET['idEnonce'] ?></li>
</ol>
<?php
$enonce = $enonceManager->recupererEnonceViaIdEnonce($_GET['idEnonce']);
?>
<button class="btn btn-secondary" onclick="genererPDF(<?php echo $_GET['idEnonce']?>)">Télécharger au format PDF</button>
<div id="pdfwrapper" class="border col-md-9 mx-auto mt-5">
  <p>
    <?php
    echo $enonce->getEnonce();
    ?>
    </p>
</div>
<script src="packages/pdf/html2pdf.js"></script>
<script src="js/genererPdf.js"></script>
