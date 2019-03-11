<!-- A special css is needed for the color picker-->
<link href="packages/jquery.fileTree-1.01/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
<link href="packages/colorpicker/css/evol-colorpicker.css" rel="stylesheet" />


<!-- Breadcrumbs-->
<ol class="breadcrumb" id="breadcrumb">
  <li class="breadcrumb-item"><a>Espace création</a></li>
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
        <li class="list-group-item item" id="itemImageVariable">Image Variable</li>
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
          <textarea id="itemValeur" type="text" class="border-bottom" placeholder="Entrez votre texte ici" onkeypress="this.style.width = ((this.value.length + 1) * 8)  + 'px';"></textarea>
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
          </button>

          <form>
            <div id="menu_parametrage" class="menu_parametrage dropdown-menu"  aria-labelledby="dropdownMenu1">
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

                <form class="px-4 py-3" id="formAjoutDonneeVariable">
            			<div class="form-group">
                    <label>Nouveau type de donnée :</label>
                    <input  name="newTypeDonnee" class="form-control" id="newTypeDonnee" type="text"
                            oninvalid="this.setCustomValidity('Entrez un nom pour la donnée variable')"
                            oninput="this.setCustomValidity('')" required>
            			</div>

            			<div class="form-group">
                    <input id="itemTypeDonneeValeurAValeur" onclick="typeDonnerClick();" type="radio" name="typeDonnee" checked="checked"> <label>Valeur par valeur</label>
                    <input id="itemTypeDonneeInterval" onclick="typeDonnerClick();"  type="radio" name="typeDonnee"> <label>Interval</label>
            			</div>

            			<div class="form-group" id="blockParametrageValeurAValeur">
            			  <label>Valeur : </label>
            			  <input  type="text" class="form-control inputDonneeVariable" id="inputDonneeVariable0"
                            oninvalid="this.setCustomValidity('Entrez au moins une valeur')"
                            oninput="this.setCustomValidity('')">
                    <div id="parametrageValeurAValeurSuplementaire"></div>
            			</div>


                  <div id="blockParametrageInterval">
                    <div class="form-group">
                      <label>Borne inférieure :</label>
                      <input  type="number" class="form-control" id="borneInferieurInterval"
                              oninvalid="this.setCustomValidity('Entrez la borne inférieure de l'interval')"
                              oninput="this.setCustomValidity('')">
                    </div>

                    <div class="form-group">
                      <label>Borne supérieure :</label>
                      <input  type="number" class="form-control" id="borneSuperieurInterval"
                              oninvalid="this.setCustomValidity('Entrez la borne supérieure de l'interval')"
                              oninput="this.setCustomValidity('')">
                    </div>

                    <div class="form-group">
                      <label>Pas :</label>
                      <input  type="number" class="form-control" id="pasInterval"
                              oninvalid="this.setCustomValidity('Entrez le pas de l'interval')"
                              oninput="this.setCustomValidity('')">
                    </div>
                  </div>

                  <div class="form-group">
                      <input type="button" id="boutonAjouterDonneeVariable" class="btn btn-secondary col-12" value="Ajouter une valeur">
                  </div>

                  <div class="row"></div>

                  <div class="form-group">
                    <input class="btn btn-primary col-12" value="Enregistrer" onclick="ajouterNouveauTypeDonnee();">
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
                    <input    class="form-control" id="libelleDonneeCalculee" type="text"
                              oninvalid="this.setCustomValidity('Entrez un nom pour la donnée calculée')"
                              oninput="this.setCustomValidity('')" required>
                  </div>

                  <div class="form-group">
                    <label>Formule de calcule : </label>
                    <select id="formuleCalcul" class="form-control">

                      <?php
                        //on récupère la liste des formule de correction disponible
                        $dirname = "./formules/calcul";
                        $listeFormules = $fichierManager->getFichiersPhp($dirname);

                        foreach ($listeFormules as $formules) {
                      ?>
                          <option value="<?php echo $formules ?>"> <?php echo $formules ?> </option>
                      <?php } ?>

                    </select>
                  </div>

                  <div class="form-group">
                    <label>Paramètres : </label>

                    <select class="form-control paramCalcul" id="paramCalcul0"></select>
                    <div id="paramSuplementaires"></div>

                  </div>

                  <div class="form-group">
                      <input onclick="ajouterParametresCalculeDonnee();" type="button" class="btn btn-secondary col-12" value="Ajouter un paramètre">
                  </div>

                  <div class="row"></div>

                  <div class="form-group">
                    <input onclick="validerCalcul()" class="btn btn-primary col-12" value="Enregistrer">
                  </div>

                </form>
              </div>
            </div>

        </div>
      </div>

      <!-- Image Fixe -->
      <div id="blockParametrageImage">
        <div class="dropdown">

          <div id="container_id"></div>


          <div id="buttonFakeInputFile">
            <img alt="logo ajouter image" src="Ressources/no-image.png">
          </div>

          <!-- Chargement d'une image coté serveur -->
          <div id="imageBrowser">
            <a onmouseover="this.style.cursor = 'pointer';" onclick="closeImageBrowser()">X</a>
            <hr>
            <div id="loadFolderTree"></div>
          </div>

          <div id="imageBlockChoisi">
            <label>Image choisi :</label>
            <input type="text" id="imageChoisi" readonly="readonly"></input>
          </div>

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

      <!-- Image Variable -->
      <div id="blockParametrageImageVariable">
          <form>

            <div class="form-group">
              <label>Description :</label>
              <input type="text" class="form-control" id="itemDescriptionVariable">
            </div>

            <div class="form-group">
              <label>Largeur :</label>
              <input type="number" class="form-control" id="itemLargeur">
            </div>

            <div class="form-group">
              <label>Hauteur :</label>
              <input type="number" class="form-control" id="itemHauteur">
            </div>

          </form>
      </div>
    </div>
  </div>

<?php } else if(isset($_POST['enonceCreer']) && !empty($_POST['enonceCreer']) && !isset($_POST['nomEnonce'])) {

  $_SESSION['enonceCreer'] = $_POST['enonceCreer'];


  //on récupère la liste des formule de correction disponible
  $dirname = "./formules/coheranceSujets";
  $listeCsv = $fichierManager->getFichiersCsv($dirname);

  ?>

  <form action="#" method="POST">
    <label>Entrez un nom pour cet énoncé :</label>
    <input type="text" name="nomEnonce" >
    <br><br>
    <label>Entrez un fichier de suppression des sujets incohérent</label>
    <select name="coheranceSujet">
      <?php foreach ($listeCsv as $csv) { ?>
        <option value="<?php echo $csv ?>"> <?php echo $csv ?> </option>
      <?php } ?>
    </select>
    <br><br>
    <button type="submit" type="submit" class="btn btn-primary col-3">Valider</button>
  </form>

  <?php

} else if(isset($_SESSION['enonceCreer']) && isset($_POST['nomEnonce'])) {

  $newEnonce = $enonceManager->createEnonceDepuisTableau( array('nomEnonce' => $_POST['nomEnonce'], 'enonce' => $_SESSION['enonceCreer'] ));
  $ajout = $enonceManager->ajouterEnonce($newEnonce);
  unset($_SESSION['enonceCreer']);

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
    //Appel du fichier contenant le code de génération des sujets
    include('genererSujet.inc.php');

    include("corrigerEnonce.inc.php");
  } else {
    ?><script type="text/javascript"> alert("Une erreur est survenue :/"); </script><?php
  }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="packages/colorpicker/js/evol-colorpicker.js" type="text/javascript"></script>
<script src="packages/jquery.fileTree-1.01/jqueryFileTree.js" type="text/javascript"></script>
<script type="text/javascript" src="js/creerEnoncer.js"></script>
