<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a>Gestion des étudiants</a>
    </li>
    <li class="breadcrumb-item active">Supprimer une promotion</li>
</ol>

<?php if (!isset($_POST['id_enonce'])) { ?>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Sélectionnez la promotion &agrave; supprimer
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID Énoncé</th>
                        <th>Nom Énoncé</th>
                        <th>Supprimer ?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $listeEnonces = $enonceManager->recupererListEnonce();
                    foreach ($listeEnonces as $enonce) {
                        ?>
                        <tr>
                            <td><?php echo $enonce->getIdEnonce(); ?></td>
                            <td><?php echo $enonce->getNomEnonce(); ?></td>
                            <td>
                                <a href="#" onclick="reglerValeur(<?php echo $enonce->getIdEnonce(); ?>);"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            function reglerValeur(valeur) {
                document.formSupprimerPromotion.id_enonce.value = valeur;
                $('#supprModal').modal('show');
            }
        </script>
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
                    <form id="formSupprimerPromotion" name="formSupprimerPromotion" method="post" action="#">
                        <input id="id_enonce" name="id_enonce" type="hidden" value="">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <input class="btn btn-danger" type="submit" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        <a class="btn btn-link" href="index.php?page=20"><p>Retour</p></a>
    </div>
<?php } ?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
