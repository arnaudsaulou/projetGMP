<?php
include_once('fonctionsAffichageEnonce.inc.php');

//Récupération de l'Attribue.
$idEtudiant = $_SESSION['id'];
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

if (isset($_POST['idSujet'])) {

  $idSujet = $_POST['idSujet'];
  $_SESSION['idSujet'] = $idSujet;

  //Récupération de l'Enonce.
  $idEnonce = $sujetManager->getSujetAvecId($idSujet)->getIdEnonce();
  $enonce = $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getEnonce();

  //Récupération des données variables
  $listeDonneeVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($idSujet);
  ?>

  <form id="formReponseEnonce" name="formReponseEnonce" action="#" method="post">
    <?php
    //Substitution et affichage de l'énoncé.
    $enonnce = "enonce";
    //insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonnce);

    //Ajout des réponses si elles existent.
    insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant);
    ?>
    <div class="col-md-12 mb-3">
      <?php
      echo $enonce;
      ?>
    </div>
    <div class="col-md-3 mb-3">
      <input class="btn btn-primary" type="submit" value="Envoyer les réponses">
    </div>
  </form>

  <script onload="recupererTypeDonneeVariableDansEnonce(<?php echo $idSujet; ?>)" type="text/javascript" src="js/interpreterEnonce.js"></script>


<?php } else {
  $tabReponseQuestion = array();
  $noteFinale = 0;
  $noteMaximale = 0;

  //Stocker les réponses.
  foreach($_POST as $key => $value) {

    $numero_question = str_replace('item', '', $key);
    $value = str_replace(',', '.', $value);

    $reponseQuestion = new Reponse([
      'idUtilisateur' => $idEtudiant,
      'idSujet' => $_SESSION['idSujet'],
      'idQuestion' => $numero_question,
      'valeur' => $value,
      'dateReponse' => date('Y-m-d')
    ]);

    $reponseManager->enregistrerReponse($reponseQuestion);
    $tabReponseQuestion[] = $reponseQuestion;
  }

  //Corriger les réponses
  foreach ($tabReponseQuestion as $key => $reponse) {
    $idQuestion = $reponse->getIdQuestion();
    $idQuestion = str_replace('reponse_', '', $idQuestion);

    $tauxErreur = comparerValeurs($solutionManager, $donneeVariableManager, $_SESSION['idSujet'], $idQuestion, $reponse);
    $noteFinale += calculNoteParQuestion($tauxErreur, $idQuestion, $solutionManager);
    $noteMaximale += calculNoteParQuestion(0, $idQuestion, $solutionManager);
    $noteFinale = ($noteFinale/$noteMaximale)*100;

    $tauxErreur = round($tauxErreur);
    if($tauxErreur>10){
      ?>
      <div class="alert alert-danger" role="alert">
      <?php }
      else{
        if($tauxErreur>5){
          ?>
          <div class="alert alert-warning" role="alert">
          <?php }
          else{
            ?>
            <div class="alert alert-success" role="alert">
              <?php
            }
          }

          echo "Question n°".($key+1)." | Taux d'erreur = ".$tauxErreur." %";
          ?>
        </div>
        <?php
      } ?>
      <div class="alert alert-primary" role="alert">
        <?php
        $noteFinale = round($noteFinale,2);
        echo "Note finale : ".$noteFinale. "%";
        $numNote = $reponseManager->countNombreDeReponse($idEtudiant,$_SESSION['idSujet']);
        //Création d'un tableau de la structure Note
        $noteArray = array(
          'idUtilisateur' => $idEtudiant,
          'idSujet' => $_SESSION['idSujet'],
          'numNote' => $numNote[0],
          'note' => $noteFinale,
          'dateReponse' => date('Y-m-d')
        );
        $note = $noteManager->createNoteDepuisTableau($noteArray);
        //enregistrement de la note de l'étudiant
        $noteManager->addNote($note);
        ?>
      </div>
      <a href="index.php?page=0">
        <button class="btn btn-primary" type="button" name="button">Revenir sur le tableau de bord</button>
      </a>
    </br></br>
      <?php
      $nb = rand(1,3);
      if($noteFinale < 50){
        ?>
        <img src="/projetGMP/ApplicationWeb/images/Gif/pouce_rouge_<?php echo $nb;?>.gif" alt="">
        <?php
      }
      else{
        ?>
        <img src="/projetGMP/ApplicationWeb/images/Gif/pouce_bleu_<?php echo $nb;?>.gif" alt="">
        <?php
      }
    }
    ?>
