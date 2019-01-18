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
            insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonce);
            //Ajout des réponses si elles existent.
            insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant);
            echo $enonce;
        ?>
        <input name="idSujet" type="hidden" value="<?php echo $idSujet; ?>">
        <input type="submit" value="Envoyer les réponses">
    </form>

<?php } else if (count($_POST) > 1) {
    $idSujet = $_POST['idSujet'];
    foreach($_POST as $key => $value) {
        if (!($key === 'idSujet')) {
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
        }
    }

} ?>