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
    $enonce = str_replace("\n", "\\n", $enonceManager->recupererEnonceViaIdEnonce($sujet->getIdEnonce())->getEnonce());
    $header = '<div class="mx-auto col-md-12 mt-3"><h5 style="text-decoration: underline;">Nom: ' . $eleve->getNom() . ' - Prénom: ' . $eleve->getPrenom() . ' - ID Sujet: ' . $idSujet . '</h5>';
?>

<button class="btn btn-primary" value="Cliquez ici pour imprimer" onclick="window.print();"></button>
<div id="previewPdf">
    <?php echo $header.$enonce ?>
</div>

<?php } else {
    $listeAttributions = $attribueManager->getAttribuePourEtudiant($_SESSION['id']);
    if (!empty($listeAttributions)) {
?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Sélectionnez le sujet à imprimer:
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID du Sujet</th>
                        <th>Nom de l'Énoncé</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($listeAttributions as $attribution) {
                        $idSujet = $attribution->getIdSujet();
                        $nomEnonce = $enonceManager->recupererEnonceViaIdEnonce($sujetManager->getSujetAvecId($idSujet)->getIdEnonce())->getNomEnonce();
                ?>
                        <td><a onclick="accederAuSujetPourImpression(<?php echo $idSujet; ?>)"><?php echo $idSujet; ?></a></td>
                        <td><a onclick="accederAuSujetPourImpression(<?php echo $idSujet; ?>)"><?php echo $nomEnonce; ?></a></td>
                <?php
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID du Sujet</th>
                        <th>Nom de l'Énoncé</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
function accederAuSujetPourImpression(idSujet) {
    document.formImpressionSujet.idSujet.value = idSujet;
    document.formImpressionSujet.submit();
}
</script>
<form method="post" name="formImpressionSujet" action="#">
    <input type="hidden" value="" name="idSujet" id="idSujet">
</form>
<?php } else { ?>
<div class="attributionConfirme">
    <div class='row justify-content-center'>
        <div class="col-4 align-self-center alert alert-danger" role="alert">
            <p>Vous n'avez aucun sujet d'attribué.</p>
        </div>
    </div>
    <a class="btn btn-link" href="index.php"><p>Retour au tableau de bord</p></a>
</div>
<?php }
}