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
           <li><a name="" class="item" id="">Lien sous menu 1</a></li>
        </ul>
     </li>
      <li><a>Question</a>
        <ul>
           <li><a name="Question" class="item" id="itemQuestion">Question</a></li>
           <li><a name="" class="item" id="">Lien sous menu 2</a></li>
        </ul>
     </li>
     <li><a>Réponse</a>
        <ul>
           <li><a name="Réponse" class="item" id="itemReponse">Réponse</a></li>
           <li><a name="" class="item" id="">Lien sous menu 3</a></li>

        </ul>
     </li>
     <li><a>Image</a>
        <ul>
           <li><a name="Image" class="item" id="itemImage">Image</a></li>
           <li><a name="" class="item" id="">Lien sous menu 3</a></li>

        </ul>
     </li>
  </ul>

</div>


<!-- Partie centrale pour création de l'énoncé -->
<div class="espace_creation">

  <!-- Menu de gauche permettant le parametrage des items insérer -->
  <div class="menu_parametrage">
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
      <input id="itemTypeDonneeValeurAValeur" onclick="typeDonnerClick();" type="radio" name="typeDonnee" checked="checked"> <label>Valeur par valeur</label>
      <input id="itemTypeDonneeInterval" onclick="typeDonnerClick();"  type="radio" name="typeDonnee"> <label>Interval</label>

      <div id="blockParametrageValeurAValeur">
        <label>Valeur :</label>
        <input type="text" id="valeurXDonneeVariable"></input>

        <button>Ajouter une valeur</button>

      </div>

      <div id="blockParametrageInterval">
          <label>Borne inférieure :</label>
          <input type="number" id="borneInferieurInterval"></input>

          <label>Borne supérieure :</label>
          <input type="number" id="borneSuperieurInterval"></input>

          <label>Pas :</label>
          <input type="number" id="pasInterval"></input>
      </div>



    </div>

    <button id="bouttonAjouter">Ajouter</button>
  </div>

  <!-- Partie de création de l'énoncé a proprement parler -->
  <div id="page_creation" class="page_creation">

  </div>

</div>

<div class="clear"></div>


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/creerEnoncer.js"></script>
