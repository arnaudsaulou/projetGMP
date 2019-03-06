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

          //Empecher de resend un sujet qui vient d'être répondu
          if(isset($_SESSION['idSujet'])){
            unset($_SESSION['idSujet']);
          }
          
          $listeControle = $reponseManager->getListControleDisponible($idUtilisateur);
          foreach ($listeControle as $controle) {
            ?>
            <tr>
              <td><?php echo $controle->nomEnonce ;?></td>
              <td><?php echo $controle->nbReponses ;?></td>
              <td><?php echo $controle->derniereRep ;?></td>
              <td><?php echo $controle->tempsAttente ;?></td>
              <td><?php echo $controle->cooldown ;?> jour(s)</td>
              <td><?php echo round($controle->meilleureNote,2) ;?> %</td>
              <td><button  <?php
              if(new DateTime($controle->tempsAttente) > new DateTime()){
                echo 'class="btn btn-secondary" disabled';
              }else{
                echo 'class="btn btn-primary"';
              }
              ?> onclick="post_en_url('index.php?page=15', {idSujet: <?php echo $controle->idSujet ;?>})" class="button">Répondre</button></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--Javascript / récupérer l'id du controle avec une méthode POST et un URL -->
<script type="text/javascript">
function post_en_url(url, parametres) {
  //Création dynamique du formulaire
  var form = document.createElement('form');
  form.setAttribute('method', 'POST');
  form.setAttribute('action', url);

  //Ajout des paramètres sous forme de champs cachés
  for(var cle in parametres) {
    if(parametres.hasOwnProperty(cle)) {
      var champCache = document.createElement('input');
      champCache.setAttribute('type', 'hidden');
      champCache.setAttribute('name', cle);
      champCache.setAttribute('value', parametres[cle]);
      form.appendChild(champCache);
    }
  }

  //Ajout du formulaire à la page et soumission du formulaire
  document.body.appendChild(form);
  form.submit();
}
</script>


<!-- Page level plugin CSS-->
<link href="packages/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- scripts for this page-->
<script src="js/callDatatables.js"></script>
<script src="packages/datatables/jquery.dataTables.js"></script>
<script src="packages/datatables/dataTables.bootstrap4.js"></script>
