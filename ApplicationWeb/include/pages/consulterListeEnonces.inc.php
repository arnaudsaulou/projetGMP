<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a>Espace gestion</a>
    </li>
    <li class="breadcrumb-item active">Liste des énoncés enregistrés</li>
</ol>

<?php if (!isset($_POST['id_enonce'])) { ?>

<!-- affichage du nombre d'énoncé présent dans la base de données -->
<p> Il y a <?php echo $enonceManager->compterEnonce(); ?> énoncé(s) enregistré(s)</p>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Liste des énoncés enregistrés
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //on récupère la liste des énoncés enregistrés
                $listeEnonce = $enonceManager->recupererListEnonce();
                foreach ($listeEnonce as $enonce) {
                    ?>
                    <tr>
                        <td>
                            <a href="index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce->getIdEnonce() ?></a>
                        </td>
                        <td>
                            <a href="index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>"><?php echo $enonce->getNomEnonce() ?></a><?php if ($enonceManager->checkUnfinishedCorrectionById($enonce->getIdEnonce())) { ?>
                                <span class="badge badge-danger">Correction manquante</span> <?php
                            } ?></td>
                        <td>
                            <input class="btn <?php if ($enonceManager->checkUnfinishedCorrectionById($enonce->getIdEnonce())) {
                                echo "btn-danger";
                            } else {
                                echo "btn-secondary";
                            } ?>" value="Corriger" type="button" name="options" id="option1" autocomplete="off"
                                   onclick="window.location.href='index.php?page=9&idEnonce=<?php echo $enonce->getIdEnonce() ?>'">
                            <input class="btn btn-secondary" type="button" value="Tester">
                            <input class="btn btn-secondary" type="button" value="Afficher"
                                   onclick="window.location.href='index.php?page=17&idEnonce=<?php echo $enonce->getIdEnonce(); ?>'">
                            <input class="btn btn-secondary" type="button" value="Attribuer"
                                   onclick="window.location.href='index.php?page=6'">
                            <input class="btn btn-danger" type="button" value="Supprimer" onclick="reglerValeur(<?php echo $enonce->getIdEnonce(); ?>);">
                        </td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Numéro</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Mise à jour le : <?php echo date("d/m/Y"); ?></div>
</div>

<!-- Modal Suppression -->
<div class="modal fade" id="supprModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment supprimer cet énoncé?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Appuyez sur "Supprimer" pour confirmer. Attention, les données liées à cet énoncé (sujets
                générés, attributions...) seront également supprimées.</div>
            <div class="modal-footer">
                <form id="formSupprimerEnonce" name="formSupprimerEnonce" method="post" action="#">
                    <input id="id_enonce" name="id_enonce" type="hidden" value="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <input class="btn btn-danger" type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
    function reglerValeur(valeur) {
        document.formSupprimerEnonce.id_enonce.value = valeur;
        $('#supprModal').modal('show');
    }
</script>

<?php } else {

    $idEnonce = $_POST['id_enonce'];
    $tabSujets = $sujetManager->getIdSujetsByIdEnonce($idEnonce);
    foreach ($tabSujets as $sujet) {
        $idSujet = $sujet->getIdSujet();
        $noteManager->supprimerNotesViaIdSujet($idSujet);
        $reponseManager->supprimerReponsesViaIdSujet($idSujet);
        $attribueManager->supprimerAttribueViaIdSujet($idSujet);
        $sujetPossibleManager->supprimerSujetPossibleViaIdSujet($idSujet);
        $sujetManager->supprimerSujet($idSujet);
    }
    $tabQuestions = $questionManager->recupererListeQuestionEnonce($idEnonce);
    foreach ($tabQuestions as $question) {
        $idQuestion = $question->getIdQuestion();
        $solutionManager->supprimerSolutionViaIdQuestion($idQuestion);
    }
    $questionManager->supprimerQuestionsViaIdEnonce($idEnonce);
    $enonceManager->supprimerEnonce($idEnonce);

    ?>
    <div class="suppressionConfirme">
        <div class='row justify-content-center'>
            <div class="col-4 align-self-center alert alert-success" role="alert">
                <p>L'énoncé a bien été supprimé !</p>
            </div>
        </div>
        <a class="btn btn-link" href="index.php?page=7"><p>Retour</p></a>
    </div>
<?php } ?>
