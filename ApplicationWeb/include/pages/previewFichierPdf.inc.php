<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a>Espace gestion</a>
    </li>
    <li class="breadcrumb-item">
        <a>Imprimer un sujet</a>
    </li>
    <li class="breadcrumb-item active">Aperçu avant impression</li>
</ol>

<div class="boutonRetourDiv">
    <a href="index.php?page=18" class="btn btn-primary">Retour à la page de sélection du sujet</a>
</div>

<!-- Histoire qu'ils soient chargé et prêt pour la génération du PDF -->
<!--<script src="packages/pdf/jspdf.min.js"></script>-->
<script src="packages/pdf/html2pdf.js"></script>
<script src="js/genererPdf.js"></script>
<!-- Utilisé pour afficher le preview -->
<div id="preview">

<?php
    if (isset($_GET['idSujet'])) {
        $idSujet = $_GET['idSujet'];
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
            <script>
                let nomEleve = "<?php echo $eleve->getNom()?>";
                let prenomEleve = "<?php echo $eleve->getPrenom()?>";
                let idSujet = "<?php echo $idSujet ?>";
                if (nomEleve === "") { nomEleve = "xxxxxxxx"; }
                if (prenomEleve === "") { prenomEleve = "xxxxxxxx"; }
                let header = '<div class="mx-auto col-md-12 mt-3"><h5 style="text-decoration: underline;">Nom: ' + nomEleve + ' - Prénom: ' + prenomEleve + ' - ID Sujet: ' + idSujet + '</h5>';
                let enonce = header + '<?php echo $enonce ?>' + '</div>';
                let divPreview = document.getElementById('preview');
                genererPreviewPdf(supprimerInputs(enonce)).then(function(value) {
                    value.id = "previewPdf";
                    divPreview.append(value);
                }, function () {
                    let messageErreur = document.createElement('div');
                    messageErreur.className = "attributionError";
                    messageErreur.innerHTML =
                        "<div class='row justify-content-center'>" +
                        "    <div class=\"col-4 align-self-center alert alert-danger\" role=\"alert\">\n" +
                        "        <p>Une erreur est survenue. Veuillez réessayer.</p>\n" +
                        "    </div>\n" +
                        "</div>\n";
                    divPreview.append(messageErreur);
                });
            </script>
        <?php
        }
    }
?>
</div>