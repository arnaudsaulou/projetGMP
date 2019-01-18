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
        <li class="list-group-item item" id="itemTitre" name="Titre">Titre</li>
        <li class="list-group-item item" id="itemZoneTexte" name="Zone de texte">Zone de texte</li>
        <li class="list-group-item item" id="itemDonneeVariable" name="Donnée Variable">Donnée Variable</li>
        <li class="list-group-item item" id="itemQuestion" name="Question">Question</li>
        <li class="list-group-item item" id="itemImage" name="Image">Image</li>
      </ul>

      <hr class="half-rule"/>

      <div>
        <div class="form-group">
          <button name="Elementsuivant" class="btn btn-secondary col-sm-12" id="boutonAjouter">Ajouter</button>
        </div>
        <div class="form-group">
          <button name="Elementprecedent" class="btn btn-danger col-sm-12" id="boutonSupprimer">Supprimer</button>
        </div>
        <div class="form-group">
          <input type="hidden" name="enonceCreer" id="enonceCreer" >
          <button name="Terminer" class="btn btn-primary boutonValiderSujet col-sm-12" id="boutonValiderSujet" onclick="validerEnonce()">Terminer Enonce</button>
        </div>
      </div>

    </div>

    <!-- Partie de création de l'énoncé a proprement parler -->
    <div class="page_creation col-xs-12 col-md-9 border  border-dark">

      <div id="page_creation">

      </div>

      <!-- Titre + Zone de text -->
      <div id="blockParametrageText">
        <div class="dropdown">
          <input id="itemValeur" type="text" placeholder="Entrez votre texte ici">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

          <form>
            <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu1">
              <div class="dropdown-header">
                <div class="titre_parametrage">
                  <label>Parametres : </label>
                  <label class="titreParametrage"></label>
                </div>

                <div id="policeUpButton" class="btn btn-light">
                  <i class="fas fa-font"></i>
                  <i class="fas fa-angle-up"></i>
                </div>
                <div id="policeDownButton" class="btn btn-light">
                  <i class="fas fa-font"></i>
                  <i class="fas fa-angle-down"></i>
                </div>
                <div class="btn btn-light">
                  <input id="frenchColor" value="#000000" />
                </div>
                <div id="boldButton" class="btn btn-light">
                  <i  class="fas fa-bold"></i>
                </div>
                <div id="italicButton" class="btn btn-light">
                  <i class="fas fa-italic"></i>
                </div>
                <div id="underlineButton" class="btn btn-light">
                  <i class="fas fa-underline"></i>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Donnée Variable -->
      <div id="blockParametrageDonneeVariable">
        <div class="dropdown">

          <?php $listTypeDonnee = $typeDonneeManager->getListTypeDonnee(); ?>
          <select id="selectTypeDonnee">
            <?php foreach ($listTypeDonnee as $typeDonnee) { ?>
              <option value="<?php echo $typeDonnee->getIdType(); ?>"><?php echo $typeDonnee->getLibelle(); ?></option>
            <?php } ?>
          </select>

          <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

          <form>
            <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu2">
              <div class="dropdown-header">

                <div class="titre_parametrage">
                  <label>Parametres : </label>
                  <label class="titreParametrage"></label>
                </div>

                <form class="px-4 py-3" method="post">
            			<div class="form-group">
                    <label>Nouveau type de donnée :</label>
                    <input name="newTypeDonnee" class="form-control" id="newTypeDonnee" type="text" required>
            			</div>

            			<div class="form-group">
                    <input id="itemTypeDonneeValeurAValeur" onclick="typeDonnerClick();" type="radio" name="typeDonnee" checked="checked"> <label>Valeur par valeur</label>
                    <input id="itemTypeDonneeInterval" onclick="typeDonnerClick();"  type="radio" name="typeDonnee"> <label>Interval</label>
            			</div>

            			<div class="form-group" id="blockParametrageValeurAValeur">
            			  <label for="confirmerMDP">Valeur : </label>
            			  <input type="text" class="form-control" id="inputDonneeVariable0" required>
            			</div>

                  <div id="blockParametrageInterval">
                    <div class="form-group">
                      <label>Borne inférieure :</label>
                      <input type="number" class="form-control" id="borneInferieurInterval" required>
                    </div>

                    <div class="form-group">
                      <label>Borne supérieure :</label>
                      <input type="number" class="form-control" id="borneSuperieurInterval" required>
                    </div>

                    <div class="form-group">
                      <label>Pas :</label>
                      <input type="number" class="form-control" id="pasInterval" required>
                    </div>
                  </div>

                  <div class="form-group">
                      <input id="boutonAjouterDonneeVariable" class="btn btn-secondary col-12" value="Ajouter une valeur">
                  </div>

                  <div class="row"></div>

                  <div class="form-group">
                    <input type="submit" onclick="ajouterNouveauTypeDonnee()" class="btn btn-primary col-12" value="Enregistrer">
                  </div>

          		  </form>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Image -->
      <div id="blockParametrageImage">
        <div class="dropdown">

          <div id="buttonFakeInputFile">
            <img src="Ressources/no-image.png">
          </div>
          <input id="html_btn" type="file" />

          <button class="btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>
          <form>

            <div class="menu_parametrage dropdown-menu" id="menu_parametrage" aria-labelledby="dropdownMenu2">
              <div class="dropdown-header">

                <div class="titre_parametrage">
                  <label>Parametres : </label>
                  <label class="titreParametrage"></label>
                </div>

                <div class="form-group">
                  <label>Description :</label>
                  <input type="text" class="form-control" id="itemDescription">
                </div>

                <div class="form-group">
                  <label>Largeur :</label>
                  <input type="number" class="form-control" id="itemLargeur">
                </div>

                <div class="form-group">
                  <label>Hauteur :</label>
                  <input type="number" class="form-control" id="itemHauteur">
                </div>
              </div>
            </div>

          </form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="packages/colorpicker/js/evol-colorpicker.js" type="text/javascript"></script>
<script type="text/javascript" src="js/creerEnoncer.js.php"></script>
