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
      <ul >
        <li>
          <ul>
            <li><a name="Titre" class="item btn" id="itemTitre">Titre</a></li>
            <li><a name="Zone de texte" class="item btn" id="itemZoneTexte">Zone de texte</a></li>
          </ul>
        </li>
        <li>
          <ul>
            <li><a name="DonneesVariable" class="item btn" id="itemDonneeVariable">Donnée Variable</a></li>
          </ul>
        </li>
        <li>
          <ul>
            <li><a name="Question" class="item btn" id="itemQuestion">Question</a></li>
          </ul>
        </li>
        <li>
          <ul>
            <li><a name="Image" class="item btn" id="itemImage">Image</a></li>
          </ul>
        </li>
      </ul>

    </div>


    <!-- Partie de création de l'énoncé a proprement parler -->
    <div id="page_creation" class="page_creation col-xs-12 col-md-9 border  border-dark">
      <!-- Partie centrale pour création de l'énoncé -->
      <div>

        <!-- Menu de gauche permettant le parametrage des items insérer -->
        <div class="menu_parametrage " id="menu_parametrage">
          <div class="titre_parametrage card-body">
            <h5 class="card-title">Parametres : </h5>
            <h6 class="card-text" id="titreParametrage"></h6>
          </div>

          <div id="blockParametrageText">

            <label>Valeur :</label>
            <input id="itemValeur" type="text">

            <label>Police :</label>
            <select id="itemPolice">
              <option value="small">Très petit</option>
              <option value="medium">Petit</option>
              <option value="large">Normal</option>
              <option value="x-large">Grand</option>
              <option value="xx-large">Très grand</option>
            </select>

            <label>Couleur :</label>
            <select id="itemCouleur">
              <option value="black">Noir</option>
              <option value="blue">Bleu</option>
              <option value="red">Rouge</option>
              <option value="green">Vert</option>
            </select>

            <input id="itemGras" type="checkbox" value="bold"> <label>Gras</label>
            <input id="itemItalique" type="checkbox" value="italic"> <label>Italique</label>
            <input id="itemSousligne" type="checkbox" value="underline"> <label>Souligné</label>
          </div>

          <div id="blockParametrageDonneeVariable">

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

          <div id="blockParametrageImage">
            <label>Source :</label>
            <input id="itemSource" type="file" accept="image/*" required />

            <label>Description :</label>
            <input type="text" id="itemDescription">

            <label>Largeur :</label>
            <input type="number" id="itemLargeur">

            <label>Hauteur :</label>
            <input type="number" id="itemHauteur">
          </div>

          <button id="boutonAjouter">Ajouter</button>

          <form action="#" method="POST">
            <input type="hidden" name="enonceCreer" id="enonceCreer" >
            <button class="boutonValiderSujet" id="boutonValiderSujet" onclick="validerEnonce()">Continuer</button>
          </form>
        </div>



      </div>
    </div>


  </div>

  <div class="clear"></div>

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
<script type="text/javascript" src="js/creerEnoncer.js.php"></script>
