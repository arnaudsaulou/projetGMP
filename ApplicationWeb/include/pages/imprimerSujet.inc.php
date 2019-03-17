<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Imprimer un sujet</li>
</ol>

<?php
if (isset($_POST['idSujet'])) {
    $idSujet = $_POST['idSujet'];
    $sujet = $sujetManager->getSujetAvecId($idSujet);
    $attribue = $attribueManager->getAttribueByIdSujet($idSujet);
    $eleve = $utilisateurManager->getUtilisateurById($attribue->getIdUtilisateur());
    $enonce = $enonceManager->recupererEnonceViaIdEnonce($sujet->getIdEnonce())->getEnonce(); //str_replace("\n", "\\n", );
    $header = '<div class="mx-auto col-md-12 mt-3"><h5 style="text-decoration: underline;" class="enonce_header">Nom: ' . $eleve->getNom() . ' - Prénom: ' . $eleve->getPrenom() . ' - ID Sujet: ' . $idSujet . '</h5>';
?>

<button class="btn btn-primary" onclick="window.print();">Cliquez ici pour imprimer</button>
<div id="previewPdf">
    <?php echo $header.$enonce ?>
</div>

<?php } else { ?>
<div class="attributionConfirme">
    <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-danger" role="alert">
            <p>Erreur lors de l'accès au sujet à imprimer. Veuillez réessayer.</p>
        </div>
    </div>
    <a class="btn btn-link" href="index.php"><p>Retour au tableau de bord</p></a>
</div>
<?php }