<?php
  include_once('fonctionsAffichageEnonce.inc.php');

  //Récupération de l'Attribue.
  $idEtudiant = $_SESSION['id'];
  $attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

  //TODO Remplacer GET par POST
  $idSujet = $_GET['idSujet'];
  //$idSujet = $_POST['idSujet'];

  //TODO Remplacer GET par POST
  if (count($_GET) === 2 && empty($_POST)) {
  // if (count($_POST) === 1) {

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
              insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonnce);

              //Ajout des réponses si elles existent.
              insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant);
              echo $enonce;
          ?>

          <input type="submit" value="Envoyer les réponses">
      </form>

      <script onload="recupererTypeDonneeVariableDansEnonce(<?php echo $idSujet; ?>)" type="text/javascript" src="js/interpreterEnonce.js.php"></script>


  <?php } else {
    $tabReponseQuestion = array();

    //Stocker les réponses.
    foreach($_POST as $key => $value) {

        $numero_question = str_replace('item', '', $key);
        $value = str_replace(',', '.', $value);

        $reponseQuestion = new Reponse([
            'idUtilisateur' => $idEtudiant,
            'idSujet' => $idSujet,
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

      $tauxErreur = comparerValeurs($solutionManager, $donneeVariableManager, $idSujet, $idQuestion, $reponse);

      echo "Réponse n°".($key+1).") <br> taux d'erreur = ".$tauxErreur." % <br><br>";
    }

  }
?>
