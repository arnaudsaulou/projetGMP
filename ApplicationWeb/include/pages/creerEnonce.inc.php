<!-- A special css is needed for the color picker-->
<link href="packages/colorpicker/css/evol-colorpicker.css" rel="stylesheet" />

<!-- Breadcrumbs-->
<ol class="breadcrumb" id="breadcrumb">
  <li class="breadcrumb-item"><a>Gestion des contrôle</a></li>
  <li class="breadcrumb-item active">Créer un énoncé</li>
</ol>


<?php if((!isset($_POST['enonceCreer']) || empty($_POST['enonceCreer'])) && !isset($_POST['nomEnonce'])) { ?>

  <div class="row">
    <!-- Menu de gauche (séléction des items à insérer) -->
    <div class="col-xs-6 col-md-2">
      <ul  class="list-group">
        <li class="list-group-item item" id="itemTitre">Titre</li>
        <li class="list-group-item item" id="itemZoneTexte">Zone de texte</li>
        <li class="list-group-item item" id="itemDonneeVariable">Donnée Variable</li>
        <li class="list-group-item item" id="itemDonneeCalculee">Donnée Calculée</li>
        <li class="list-group-item item" id="itemQuestion">Question</li>
        <li class="list-group-item item" id="itemImage">Image</li>
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
          <form action="#" method="post" id="formCreationEnonce" onsubmit="return ">
            <input type="hidden" name="enonceCreer" id="enonceCreer" >
            <button type="submit" class="btn btn-primary col-sm-12" >Terminer Enonce</button>
          </form>


        </div>
      </div>

    </div>

    <!-- Partie de création de l'énoncé a proprement parler -->
    <div class="page_creation col-xs-12 col-md-9 border border-grey rounded">

      <div id="page_creation" class="p-2">
        
      </div>

      <!-- Titre + Zone de text -->
      <div id="blockParametrageText">
        <div class="dropdown">
          <textarea id="itemValeur" type="text" class="border-bottom" placeholder="Entrez votre texte ici" onkeypress="this.style.width = ((this.value.length + 1) * 8) + 'px';"></textarea>
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

          <form>
            <div class="menu_parametrage dropdown-menu"  aria-labelledby="dropdownMenu1">
              <div class="dropdown-header">
                <div class="titre_parametrage">
                  <label>Paramètres : </label>
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
            </div>
          </form>
        </div>
      </div>

      <!-- Donnée Variable -->
      <div id="blockParametrageDonneeVariable">
        <div class="dropdown">

          <?php $listTypeDonnee = $typeDonneeManager->getListOfTypeDonneeDeDonneesVariable();?>
          <select id="selectTypeDonnee">
            <?php foreach ($listTypeDonnee as $typeDonnee) { ?>
              <option value="<?php echo $typeDonnee->getIdType(); ?>"><?php echo $typeDonnee->getLibelle(); ?></option>
            <?php } ?>
          </select>

          <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

            <div class="menu_parametrage dropdown-menu"  aria-labelledby="dropdownMenu2">
              <div class="dropdown-header">

                <div class="titre_parametrage">
                  <label>Paramètres : </label>
                  <label class="titreParametrage"></label>
                </div>

                <form action="#" class="px-4 py-3" method="post">
            			<div class="form-group">
                    <label>Nouveau type de donnée :</label>
                    <input name="newTypeDonnee" class="form-control" id="newTypeDonnee" type="text" required>
            			</div>

            			<div class="form-group">
                    <input id="itemTypeDonneeValeurAValeur" onclick="typeDonnerClick();" type="radio" name="typeDonnee" checked="checked"> <label>Valeur par valeur</label>
                    <input id="itemTypeDonneeInterval" onclick="typeDonnerClick();"  type="radio" name="typeDonnee"> <label>Interval</label>
            			</div>

            			<div class="form-group" id="blockParametrageValeurAValeur">
            			  <label>Valeur : </label>
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
                      <input type="button" id="boutonAjouterDonneeVariable" class="btn btn-secondary col-12" value="Ajouter une valeur">
                  </div>

                  <div class="row"></div>

                  <div class="form-group">
                    <input onclick="ajouterNouveauTypeDonnee()" type="button" class="btn btn-primary col-12" value="Enregistrer">
                  </div>

          		  </form>
              </div>
            </div>

        </div>
      </div>

      <!-- Donnée Calculée -->
      <div id="blockParametrageDonneeCalculee">
        <div class="dropdown">

          <?php $listTypeDonneeCalculee = $typeDonneeManager->getListOfTypeDonneeDeDonneesCalculee(); ?>
          <select id="selectTypeDonneeCalculee">
            <?php foreach ($listTypeDonneeCalculee as $typeDonneeCalculee) { ?>
              <option value="<?php echo $typeDonneeCalculee->getIdType(); ?>"><?php echo $typeDonneeCalculee->getLibelle(); ?></option>
            <?php } ?>
          </select>

          <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

            <div class="menu_parametrage dropdown-menu"  aria-labelledby="dropdownMenu2">
              <div class="dropdown-header">

                <div class="titre_parametrage">
                  <label>Paramètres : </label>
                  <label class="titreParametrage"></label>
                </div>

                <form action="#" method="post" class="px-4 py-3" >
                  <div class="form-group">
                    <label>Nouvelle donnée calculée :</label>
                    <input class="form-control" id="libelleDonneeCalculee" type="text" required>
                  </div>

                  <div class="form-group">
                    <label>Formule de calcule : </label>
                    <select id="formuleCalcul" class="form-control">

                      <?php
                        //on récupère la liste des formule de correction disponible
                        $dirname = "./formules/calcul";
                        $listeFormules = $fichierManager->getListeFormules($dirname);

                        foreach ($listeFormules as $formules) {
                      ?>
                          <option value="<?php echo $formules ?>"> <?php echo $formules ?> </option>
                      <?php } ?>

                    </select>
                  </div>

                  <div class="form-group">
                    <label>Paramètres : </label>

                    <select class="form-control paramCalcul" id="paramCalcul0">
                      <?php
                        //on récupère la liste des données variable de l'énoncé
                        $listeTypeDonnee = $typeDonneeManager->getListOfTypeDonneeDeDonneesVariable();

                        foreach ($listeTypeDonnee as $typeDonnee) { ?>
                          <option value="<?php echo $typeDonnee->getIdType(); ?>"> <?php echo $typeDonnee->getLibelle(); ?> </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                      <input onclick="ajouterParametresCalculeDonnee();" type="button" class="btn btn-secondary col-12" value="Ajouter un paramètre">
                  </div>

                  <div class="row"></div>

                  <div class="form-group">
                    <input onclick="validerCalcul()" type="button" class="btn btn-primary col-12" value="Enregistrer">
                  </div>

                </form>
              </div>
            </div>

        </div>
      </div>

      <!-- Image -->
      <div id="blockParametrageImage">
        <div class="dropdown">

          <div id="buttonFakeInputFile">
            <img alt="logo ajouter image" src="Ressources/no-image.png">
          </div>
          <input id="html_btn" type="file" />

          <button class="btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>
          <form>

            <div class="menu_parametrage dropdown-menu"  aria-labelledby="dropdownMenu2">
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

<?php } else if(isset($_POST['enonceCreer']) && !empty($_POST['enonceCreer']) && !isset($_POST['nomEnonce'])) {

  $_SESSION['enonceCreer'] = $_POST['enonceCreer'];

  ?>

  <form action="#" method="POST">
    <label>Entrez un nom pour cet énoncé :</label>
    <input type="text" name="nomEnonce" >
    <button type="submit" class="boutonValiderSujet" type="submit">Valider</button>
  </form>

  <?php

} else if(isset($_SESSION['enonceCreer']) && isset($_POST['nomEnonce'])) {

  $newEnonce = $enonceManager->createEnonceDepuisTableau( array('nomEnonce' => $_POST['nomEnonce'], 'enonce' => $_SESSION['enonceCreer'] ));
  $ajout = $enonceManager->ajouterEnonce($newEnonce);

  if($ajout){
?>

<script type="text/javascript">
  var breadcrumb = document.getElementById("breadcrumb");

  var newbreadcrumb = document.createElement('li');
  newbreadcrumb.classList.add("breadcrumb-item", "active");
  newbreadcrumb.appendChild(document.createTextNode("Corriger l'énoncé n°" + <?php echo $_SESSION['lastInsertIdEnonce']; ?>));
  breadcrumb.appendChild(newbreadcrumb);

</script>

<?php
    include("corrigerEnonce.inc.php");

    //Appel du fichier contenant le code de génération des sujets
    include('genererSujet.inc.php');

  } else {
    ?><script type="text/javascript"> alert("Une erreur est survenue :/"); </script><?php
  }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="packages/colorpicker/js/evol-colorpicker.js" type="text/javascript"></script>
<?php //if((!isset($_POST['enonceCreer']) || empty($_POST['enonceCreer'])) && !isset($_POST['nomEnonce'])) { ?>
  <script type="text/javascript" src="js/creerEnoncer.js.php"></script>
<?php //} ?>
