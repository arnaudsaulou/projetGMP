<?php
include_once ('fonctionsAffichageEnonce.inc.php');

//Récupération de l'Attribue.
$idEtudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION['log'])->getIdUtilisateur();
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

//Récupération de l'Enonce.
$idSujet = $attribue[0]->getIdSujet();
$idEnonce = $sujetManager->getSujetAvecId($idSujet)->getIdEnonce();
$enonce = $enonceManager->recupererEnonceViaIdEnonce($idEnonce)->getEnonce();

//Récupération des données variables
$listeDonneeVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($idSujet);

if (empty($_POST)) { ?>

    <form id="formReponseEnonce" name="formReponseEnonce" action="#" method="post">
        <?php
            //Substitution et affichage de l'énoncé.
            insererValeurs($listeDonneeVariable, $typeDonneeManager, $enonce);
            //Ajout des réponses si elles existent.
            insererReponses($enonce, $reponseManager, $idSujet, $idEtudiant);
            echo $enonce;
        ?>
        <input type="submit" value="Envoyer les réponses">
    </form>

<?php } else {
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
    }
} ?>