<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Supprimer des étudiants</a>
    </li>
    <li class="breadcrumb-item active"></li>
</ol>

<?php if (!isset($_POST['id_etu'])) { ?>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        S&eacute;lectionnez l'&eacute;tudiant &agrave; supprimer
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="formSupprimerEtudiant" name="formSupprimerEtudiant" method="post" action="#">
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
                <input id="id_etu" name="id_etu" type="hidden" value="">
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function reglerValeur(valeur) {
            document.formSupprimerEtudiant.id_etu.value = valeur;
            document.forms["formSupprimerEtudiant"].submit();
        }
    </script>
</div>

<?php } else {
    if (!isset($_POST['confirmSuppr'])) {
        $etudiant = $utilisateurManager->getUtilisateurById($_POST['id_etu']);
?>

    <form id="confirmerSuppression" name="confirmerSuppression" method="post" action="#">
        <h2>Voulez-vous vraiment supprimer l'étudiant <?php echo $etudiant->getNom()." ".$etudiant->getPrenom() ?>?</h2>
        <input id="id_etu" name="id_etu" value="<?php echo $_POST['id_etu'] ?>" type="hidden">
        <input id="confirmSuppr" name="confirmSuppr" type="hidden" value="true">
        <input class="btn btn-lg btn-danger" type="submit" value="Oui">
        <input class="btn btn-lg btn-primary" onclick="window.location.href='index.php?page=12';" type="button" value="Non">
    </form>

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

<?php
    }
}?>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>