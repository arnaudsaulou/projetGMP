<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a>Gestion des attributions de sujet</a>
    </li>
    <li class="breadcrumb-item active">Lister les attributions</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Liste des attributions enregistrées
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th>Année</th>
                      <th>Titre énoncé</th>
                      <th>Date attribution</th>
                      <th>Date limite</th>
                      <th>Temps entre chaque réponse</th>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>Année</th>
                      <th>Titre énoncé</th>
                      <th>Date attribution</th>
                      <th>Date limite</th>
                      <th>Temps entre chaque réponse</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $listeAttribution = $attribueManager->getListAttribution();
                    foreach ($listeAttribution as $attribu) {

                        ?>
                        <tr>
                            <td><?php echo $attribu->annee;?></td>
                            <td><?php echo $attribu->nomEnonce;?></td>
                            <td><?php echo $attribu->dateAttribution;?></td>
                            <td><?php echo $attribu->dateLimite;?></td>
                            <td><?php echo $attribu->cooldown;?></td>

                        </tr>
                        <?php
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
