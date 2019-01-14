<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Gestion des étudiants</a>
    </li>
    <li class="breadcrumb-item active">Lister les étudiants</li>

</ol>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Liste des étudiants enregistrés
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Moyenne</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Moyenne</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                //on récupère la liste des étudiants enregistrés
                $listeEtudiants = $utilisateurManager->getListEtudiants();
                foreach ($listeEtudiants as $etudiant) {
                    ?>
                    <tr>
                        <td><?php echo $etudiant->getIdUtilisateur() ?></td>
                        <td><?php echo $etudiant->getNom() ?></td>
                        <td><?php echo $etudiant->getPrenom() ?></td>
                        <td><?php echo $etudiant->getAnnee() ?></td>
                        <td><?php echo $utilisateurManager->calculerMoyenne($etudiant) ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
