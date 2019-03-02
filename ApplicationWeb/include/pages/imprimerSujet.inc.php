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
    if ($sujetManager->sujetExiste($idSujet) == '0') { ?>

    <div class="attributionError">
        <div class='row justify-content-center'>
            <div class="col-4 align-self-center alert alert-danger" role="alert">
                <p>Ce sujet n'existe pas.</p>
            </div>
        </div>
    </div>

    <?php } else {
    $sujet = $sujetManager->getSujetAvecId($idSujet);
    $attribue = $attribueManager->getAttribueByIdSujet($idSujet);
    $eleve = $utilisateurManager->getUtilisateurById($attribue->getIdUtilisateur());
    $enonce = str_replace("\n", "\\n", $enonceManager->recupererEnonceViaIdEnonce($sujet->getIdEnonce())->getEnonce());

    ?>

    <script type="text/javascript">
        var nomEleve = "<?php echo $eleve->getNom()?>";
        var prenomEleve = "<?php echo $eleve->getPrenom()?>";
        var idSujet = "<?php echo $idSujet ?>";
        if (nomEleve === "") { nomEleve = "xxxxxxxx"; }
        if (prenomEleve === "") { prenomEleve = "xxxxxxxx"; }
        var header = '<div class="mx-auto col-md-12 mt-3"><h5 style="text-decoration: underline;">Nom: ' + nomEleve +  ' - Prénom: ' + prenomEleve + ' - ID Sujet: ' + idSujet+ '</h5>';
        var enonce = header + '<?php echo $enonce ?>' + '</div>';
        var nom = "Sujet " + idSujet + " - Nom: " + nomEleve + " - Prenom: " + prenomEleve;
        genererPDFAvecHTML(supprimerInputs(enonce), nom);
    </script>
    <?php
    }
}?>
<form action="#" method="post">
    <div class="row mx-auto col-11">
        <div class="form-group col-7">
            <label class="col-form-label" for="idSujet">ID du sujet à imprimer: </label>
            <input class="col-9 col-form-input" id="idSujet" type="number" name="idSujet" required>
        </div>
        <div class="form-group col-5">
            <input class="col-12 col-form-input btn btn-primary" type="submit" value="Générer PDF">
            <a id="boutonPrevisualiser" class="col-12 col-form-input btn btn-primary">Prévisualiser PDF</a>
        </div>
    </div>
</form>

<script type="text/javascript">
    let boutonPrevisualiser = document.getElementById('boutonPrevisualiser');
    let champIdSujet =  document.getElementById('idSujet');
    champIdSujet.onchange = function() {
        boutonPrevisualiser.href = "index.php?page=19&idSujet=" + champIdSujet.value;
    }
</script>
