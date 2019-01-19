<!-- A special css is needed for the color picker-->
<link href="packages/colorpicker/css/evol-colorpicker.css" rel="stylesheet" />

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a>Gestion des contrôle</a>
  </li>
  <li class="breadcrumb-item active">Créer un énoncé</li>
</ol>


<?php if(!isset($_POST['enonceCreer']) && !isset($_POST['nomEnonce'])) { ?>

  <div class="row">
    <!-- Menu de gauche (séléction des items à insérer) -->
    <div class="col-xs-6 col-md-2">
      <ul  class="list-group">
        <li class="list-group-item item" id=itemTitre>Titre</li>
        <li class="list-group-item item" id=itemZoneTexte>Zone de texte</li>
        <li class="list-group-item item" id=itemDonneeVariable>Donnée Variable</li>
        <li class="list-group-item item" id=itemQuestion>Question</li>
        <li class="list-group-item item" id=itemImage>Image</li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item"> <button name="Elementsuivant" class="btn btn-secondary" id="boutonAjouter">Element suivant</button></li>
        <form action="#" method="POST">
          <input type="hidden" name="enonceCreer" id="enonceCreer" >
          <li class="list-group-item"> <button name="Terminer" class="btn btn-primary boutonValiderSujet" id="boutonValiderSujet" onclick="validerEnonce()">Terminer Enonce</button></li>
        </form>
      </ul>
    </div>

    <!-- Partie de création de l'énoncé a proprement parler -->
    <div class="page_creation col-xs-12 col-md-9 border  border-dark">
      <div id="page_creation">

      </div>
      <div id="blockParametrageText">
        <div class="dropdown">
          <input id="itemValeur" type="text" value="Entrez votre texte ici">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

          <form>
            <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu1">
              <div class="titre_parametrage">
                <h5 class="card-title">Paramètres : </h5>
                <h6 class="" id="titreParametrage"></h6>
              </div>

              <div class="btn btn-light">
                <i class="fas fa-font"></i>
                <i class="fas fa-angle-up"></i>
              </div>
              <div class="btn btn-light">
                <i class="fas fa-font"></i>
                <i class="fas fa-angle-down"></i>
              </div>
              <div class="btn btn-light">
                <input id="frenchColor" value="#000000" />
              </div>
              <div class="btn btn-light">
                <i class="fas fa-bold"></i>
              </div>
              <div class="btn btn-light">
                <i class="fas fa-italic"></i>
              </div>
              <div class="btn btn-light">
                <i class="fas fa-underline"></i>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div id="blockParametrageDonneeVariable">
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>
          <form>
            <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu2">
              <label>Type de donnée déjà enregistré : </label>

              <?php $listTypeDonnee = $typeDonneeManager->getListTypeDonnee(); ?>
              <select id="typeDonnee">
                <option value="0"> - Créer nouveau type - </option>
                <?php foreach ($listTypeDonnee as $typeDonnee) { ?>
                  <option value="<?php echo $typeDonnee->getIdType(); ?>"><?php echo $typeDonnee->getLibelle(); ?></option>
                <?php } ?>
              </select>

              <label>Nouveau type de donnée :</label>
              <input name="newTypeDonnee" id="newTypeDonnee" type="text">

              <input id="itemTypeDonneeValeurAValeur" onclick="typeDonnerClick();" type="radio" name="typeDonnee" checked="checked"> <label>Valeur par valeur</label>
              <input id="itemTypeDonneeInterval" onclick="typeDonnerClick();"  type="radio" name="typeDonnee"> <label>Interval</label>

              <div id="blockParametrageValeurAValeur">
                <button id="boutonAjouterDonneeVariable">Ajouter une valeur</button>
              </div>

              <div id="blockParametrageInterval">
                <label>Borne inférieure :</label>
                <input type="number" id="borneInferieurInterval">

                <label>Borne supérieure :</label>
                <input type="number" id="borneSuperieurInterval">

                <label>Pas :</label>
                <input type="number" id="pasInterval">
              </div>
              <button onclick="ajouterNouveauTypeDonnee()">Ajouter nouveau type de donnée</button>
            </div>
          </form>
        </div>
      </div>

      <div id="blockParametrageImage">
        <div class="dropdown">
          <div class="thumbnail">
            <img src="Ressources/no-image.png" alt="image size preview">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog"></i>
            </button>
            <form>
              <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu2">
                <label>Source :</label>
                <input id="itemSource" type="file" accept="image/*" required />

                <label>Description :</label>
                <input type="text" id="itemDescription">

                <label>Largeur :</label>
                <input type="number" id="itemLargeur">

                <label>Hauteur :</label>
                <input type="number" id="itemHauteur">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } else if(isset($_POST['enonceCreer']) && !isset($_POST['nomEnonce'])) {

  $_SESSION['enonceCreer'] = $_POST['enonceCreer'];

  ?>

  <form action="#" method="POST">
    <label>Entrez un nom pour cet énoncé :</label>
    <input type="text" name="nomEnonce" >
    <button class="boutonValiderSujet" type="submit">Valider</button>
  </form>

  <?php

} else  if(isset($_SESSION['enonceCreer']) && isset($_POST['nomEnonce'])) {

  $newEnonce = $enonceManager->createEnonceDepuisTableau( array('nomEnonce' => $_POST['nomEnonce'], 'enonce' => $_SESSION['enonceCreer'] ));
  $ajout = $enonceManager->ajouterEnonce($newEnonce);

  //Appel du fichier contenant le code de génération des sujets
  include('genererSujet.inc.php');

  if($ajout){
    echo "L'énoncé à bien été créer !";
  } else {
    echo "Une erreur est survenue :/";
  }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="packages/colorpicker/js/evol-colorpicker.js" type="text/javascript"></script>
<script type="text/javascript" src="js/creerEnoncer.js.php"></script>
