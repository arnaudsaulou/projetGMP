<!-- Menu de gauche (séléction des items à insérer) -->
<div>
  <ul class="menu_droite">
     <li><a>Texte</a>
        <ul>
           <li><a name="Titre" class="item" id="itemTitre">Titre</a></li>
           <li><a name="Zone de texte" class="item" id="itemZoneTexte">Zone de texte</a></li>
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

    <label>Valeur :</label>
    <input id="itemValeur" type="text"></input>
    <p><p>
    <p><p>
    <p><p>
    <p><p>
    <p><p>

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
