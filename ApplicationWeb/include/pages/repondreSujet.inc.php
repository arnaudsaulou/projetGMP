<?php
include_once ('fonctionsAffichageEnonce.inc.php');

//Récupération de l'Attribue.
$idEtudiant = $_SESSION['id'];
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

if (count($_POST) === 1) {
    //Récupération de l'Enonce.
    $idSujet = $_POST['idSujet'];
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
        <input name="idSujet" type="hidden" value="<?php echo $idSujet; ?>">
        <input type="submit" value="Envoyer les réponses">
    </form>
    
<?php } else {

  $tabReponseQuestion = array();

  //Stocker les réponses.
  foreach($_POST as $key => $value) {
      $numero_question = str_replace('question_', '', $key);
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

  include("./formules/formuleTest.php");

  //Corriger les réponses
  foreach ($tabReponseQuestion as $key => $reponse) {

    $idQuestion = $reponse->getIdQuestion();
    $idQuestion = str_replace('reponse_', '', $idQuestion);

    $tauxErreur = comparerValeurs($solutionManager, $idQuestion, $reponse);

    echo "Réponse n°".($key+1).") <br> taux d'erreur = ".$tauxErreur." % <br><br>";
  }

}

?>
