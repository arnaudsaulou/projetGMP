<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Supprimer des étudiants</a>
    </li>
    <li class="breadcrumb-item active"></li>
</ol>

<?php if (!isset($_POST['id_promotion'])) { ?>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        S&eacute;lectionnez la promotion &agrave; supprimer
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="formSupprimerPromotion" name="formSupprimerPromotion" method="post" action="#">
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
                <input id="id_promotion" name="id_promotion" type="hidden" value="">
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function reglerValeur(valeur) {
            document.formSupprimerPromotion.id_promotion.value = valeur;
            document.forms["formSupprimerPromotion"].submit();
        }
    </script>
</div>

<?php } else {
    if (!isset($_POST['confirmSuppr'])) {
?>

        <form id="confirmerSuppression" name="confirmerSuppression" method="post" action="#">
            <h2>Voulez-vous vraiment supprimer la promotion <?php echo $_POST['id_promotion'] ?>?</h2>
            <input id="id_promotion" name="id_promotion" value="<?php echo $_POST['id_promotion'] ?>" type="hidden">
            <input id="confirmSuppr" name="confirmSuppr" type="hidden" value="true">
            <input class="btn btn-lg btn-danger" type="submit" value="Oui">
            <input class="btn btn-lg btn-primary" onclick="window.location.href='index.php?page=13';" type="button" value="Non">
        </form>

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

<?php
    }
}?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
