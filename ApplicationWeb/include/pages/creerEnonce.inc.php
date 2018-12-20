<?php

if(!isset($_POST['enonceCreer'])) {

 ?>

<!-- Menu de gauche (séléction des items à insérer) -->
<div>
  <ul class="menu_droite">
     <li><a>Texte</a>
        <ul>
           <li><a name="Titre" class="item" id="itemTitre">Titre</a></li>
           <li><a name="Zone de texte" class="item" id="itemZoneTexte">Zone de texte</a></li>
        </ul>
     </li>
     <li><a>Données Variable</a>
        <ul>
           <li><a name="DonneesVariable" class="item" id="itemDonneeVariable">Donnée Variable</a></li>
        </ul>
     </li>
      <li><a>Question</a>
        <ul>
           <li><a name="Question" class="item" id="itemQuestion">Question</a></li>
        </ul>
     </li>
     <li><a>Image</a>
        <ul>
           <li><a name="Image" class="item" id="itemImage">Image</a></li>
        </ul>
     </li>
  </ul>

</div>


<!-- Partie centrale pour création de l'énoncé -->
<div class="espace_creation">

  <!-- Menu de gauche permettant le parametrage des items insérer -->
  <div class="menu_parametrage" id="menu_parametrage">
    <div class="titre_parametrage">
      <h4>Parametres : </h4>
      <h4 id="titreParametrage"></h4>
    </div>

    <div id="blockParametrageText">

      <label>Valeur :</label>
      <input id="itemValeur" type="text"></input>

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

        <?php $listTypeDonnee = $typeDonneeManager->getTypeDonnee(); ?>
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

          <button id="bouttonAjouterDonneeVariable">Ajouter une valeur</button>

        </div>

        <div id="blockParametrageInterval">
            <label>Borne inférieure :</label>
            <input type="number" id="borneInferieurInterval"></input>

            <label>Borne supérieure :</label>
            <input type="number" id="borneSuperieurInterval"></input>

            <label>Pas :</label>
            <input type="number" id="pasInterval"></input>
        </div>

        <button onclick="ajouterNouveauTypeDonnee()">Ajouter nouveau type de donnée</button>

      </div>

      <div id="blockParametrageImage">
          <label>Source :</label>
          <input id="itemSource" type="file" accept="image/*" required />

          <label>Description :</label>
          <input type="text" id="itemDescription"></input>

          <label>Largeur :</label>
          <input type="number" id="itemLargeur"></input>

          <label>Hauteur :</label>
          <input type="number" id="itemHauteur"></input>
      </div>

      <button id="bouttonAjouter">Ajouter</button>

    <form action="#" method="POST">
      <input type="hidden" name="enonceCreer" id="enonceCreer" >
      <button class="bouttonValiderSujet" id="bouttonValiderSujet" onclick="validerEnonce()">Valider</button>
    </form>
  </div>

  <!-- Partie de création de l'énoncé a proprement parler -->
  <div id="page_creation" class="page_creation">

  </div>

</div>

<div class="clear"></div>

<?php } else {

  $newEnonce = $enonceManager->createEnonceDepuisTableau( array('enonce' => $_POST['enonceCreer'] ));
  $ajout = $enonceManager->ajouterEnonce($newEnonce);

  if($ajout){
    echo "L'énoncé à bien été créer !";

    // Simulation affichage coté étudiants (demo soutenance)
    echo "<br><br><br>";
    echo $_POST['enonceCreer'];
  } else {
    echo "Une erreur est survenue :/";
  }
?>

<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/creerEnoncer.js.php"></script>
