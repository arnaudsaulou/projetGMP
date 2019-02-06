<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Espace gestion</a>
  </li>
  <li class="breadcrumb-item active">Imprimer un sujet</li>
</ol>

<!-- Histoire qu'ils soient chargé et prêt pour la génération du PDF -->
<!--<script src="packages/pdf/jspdf.min.js"></script>-->
<script src="packages/pdf/html2pdf.js"></script>
<script src="js/genererPdf.js"></script>
<?php

if (isset($_POST['idSujet'])) {
    $idSujet = $_POST['idSujet'];
    $attribue = $attribueManager->getAttribueByIdSujet($idSujet);
    $sujet = $sujetManager->getSujetAvecId($idSujet);
    $eleve = $utilisateurManager->getUtilisateurById($attribue->getIdUtilisateur());
    $enonce = str_replace("\n","\\n", $enonceManager->recupererEnonceViaIdEnonce($sujet->getIdEnonce())->getEnonce());
?>

<script type="text/javascript">
    var header = '<div class="border col-md-11 mx-auto mt-3"><h5 style="text-decoration: underline;">Nom: <?php echo $eleve->getNom()?> - Prénom: <?php echo $eleve->getPrenom()?> - ID Sujet: <?php echo $idSujet ?></h5>';
    var footer = '<div class="row fixed-row-bottom mx-auto"></div>';
    var enonce = header + '<?php echo $enonce ?>' + footer + '</div>';
    var nom = "Sujet" + "<?php echo $eleve->getNom()?>" + "<?php echo $eleve->getPrenom()?>" + "<?php echo $idSujet ?>";
    genererPDFAvecHTML(supprimerInputs(enonce), nom);
</script>

<?php
} else { ?>
    <form target="_blank" action="#" method="post">
        <h3>Insérez l'ID d'un sujet dans le champ ci-dessous pour en générer le PDF: </h3>
        <label for="idSujet">ID du sujet à imprimer: </label>
        <input id="idSujet" type="number" name="idSujet" required>
        <input type="submit" value="Générer PDF">
    </form>
<?php
}
?>
