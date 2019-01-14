<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a>Gestion des étudiants</a>
    </li>
    <li class="breadcrumb-item active">Supprimer une promotion</li>
</ol>

<?php if (!isset($_POST['id_promotion'])) { ?>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        S&eacute;lectionnez la promotion &agrave; supprimer
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ann&eacute;e</th>
                        <th>Nb. &Eacute;tudiants</th>
                        <th>Supprimer ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $listePromotions = $utilisateurManager->getListeAnnees();
                        foreach ($listePromotions as $promotion) {
                            ?>
                            <tr>
                                <td><?php echo $promotion['annee']; ?></td>
                                <td><?php echo $utilisateurManager->recupererNbEtudiantsPromotion($promotion['annee']); ?></td>
                                <td>
                                    <a href="#" onclick="reglerValeur(<?php echo $promotion['annee']; ?>);"><i class="fas fa-trash-alt"></i></a>
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
            document.formSupprimerPromotion.id_promotion.value = valeur;
            $('#supprModal').modal('show');
        }
    </script>
</div>

<!-- Modal Suppression -->
<div class="modal fade" id="supprModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment supprimer la promotion ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Appuyer sur "Supprimer" pour confirmer.</div>
            <div class="modal-footer">
                <form id="formSupprimerPromotion" name="formSupprimerPromotion" method="post" action="#">
                    <input id="id_promotion" name="id_promotion" type="hidden" value="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <input class="btn btn-danger" type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</div>

<?php } else {
    $listeEtudiants = $utilisateurManager->recupererPromotionEtudiante($_POST['id_promotion']);
    foreach ($listeEtudiants as $etudiant) {
        $noteManager->supprimerNotesAvecIdEtudiant($etudiant->getIdUtilisateur());
        $reponseManager->supprimerReponsesAvecIdEtudiant($etudiant->getIdUtilisateur());
        $attribueManager->supprimerAttribueAvecIdEtudiant($etudiant->getIdUtilisateur());
        $utilisateurManager->supprimerUtilisateurAvecId($etudiant->getIdUtilisateur());
    }
?>
    <div class="suppressionConfirme">
        <h3>La promotion a bien &eacute;t&eacute; supprim&eacute;e !</h3>
        <a class="btn btn-link" href="index.php?page=13"><p>Retour</p></a>
    </div>
<?php } ?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>