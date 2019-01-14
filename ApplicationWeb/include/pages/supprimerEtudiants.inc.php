<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Gestion des étudiants</a>
    </li>
    <li class="breadcrumb-item active">Supprimer une promotion</li>
</ol>

<?php if (!isset($_POST['confirmSuppr'])) { ?>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        S&eacute;lectionnez l'&eacute;tudiant &agrave; supprimer
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ann&eacute;e</th>
                        <th>Supprimer ?</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $listeEtudiants = $utilisateurManager->getListEtudiants();
                    foreach ($listeEtudiants as $etudiant) {
                ?>
                    <tr>
                        <td><?php echo $etudiant->getIdUtilisateur() ?></td>
                        <td><?php echo $etudiant->getNom() ?></td>
                        <td><?php echo $etudiant->getPrenom() ?></td>
                        <td><?php echo $etudiant->getAnnee() ?></td>
                        <td>
                            <a href="#" onclick="reglerValeur(<?php echo $etudiant->getIdUtilisateur() ?>);"><i class="fas fa-trash-alt"></i></a>
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
            document.formSupprimerEtudiant.id_etu.value = valeur;
            $('#supprModal').modal('show');
        }
    </script>
</div>

<!-- Modal Suppression -->
<div class="modal fade" id="supprModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment supprimer l'&eacute;tudiant ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Appuyer sur "Supprimer" pour confirmer.</div>
            <div class="modal-footer">
                <form id="formSupprimerEtudiant" name="formSupprimerEtudiant" method="post" action="#">
                    <input id="id_etu" name="id_etu" type="hidden" value="">
                    <input class="btn btn-danger" type="submit" value="Supprimer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } else {
    $noteManager->supprimerNotesAvecIdEtudiant($_POST['id_etu']);
    $reponseManager->supprimerReponsesAvecIdEtudiant($_POST['id_etu']);
    $attribueManager->supprimerAttribueAvecIdEtudiant($_POST['id_etu']);
    $utilisateurManager->supprimerUtilisateurAvecId($_POST['id_etu']);
?>

    <div class="suppressionConfirme">
        <h3>L'&eacute;tudiant a bien &eacute;t&eacute; supprim&eacute; !</h3>
        <a class="btn btn-link" href="index.php?page=12"><p>Retour</p></a>
    </div>

<?php } ?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>