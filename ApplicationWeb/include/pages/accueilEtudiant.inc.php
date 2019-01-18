<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Tableau de bord</a>
  </li>
</ol>

<h2>Bonjour <?php echo $_SESSION['co'] ?></h2>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Contrôle disponible
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th>Titre énoncé</th>
                      <th>Nombre de réponse</th>
                      <th>Dernière réponse le :</th>
                      <th>Prochaine réponse disponible le :</th>
                      <th>Temps entre chaque réponse</th>
                      <th>Meilleur note</th>
                      <th>Répondre</th>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>Titre énoncé</th>
                      <th>Nombre de réponse</th>
                      <th>Dernière réponse le :</th>
                      <th>Prochaine réponse disponible le :</th>
                      <th>Temps entre chaque réponse</th>
                      <th>Meilleur note</th>
                      <th>Répondre</th>

                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $idUtilisateur = $_SESSION['id'];
                    $listeControle = $reponseManager->getListControleDisponible($idUtilisateur);
                    foreach ($listeControle as $controle) {

                        ?>
                        <tr>
                            <td><?php echo $controle->nomEnonce ;?></td>
                            <td><?php echo $controle->nbReponses ;?></td>
                            <td><?php echo $controle->derniereRep ;?></td>
                            <td><?php echo $controle->tempsAttente ;?></td>
                            <td><?php echo $controle->cooldown ;?> jour(s)</td>
                            <td><?php echo $controle->meilleureNote ;?></td>
                            <td><button class="button"><a href="index.php?page=15">Répondre </a></button></td>

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
