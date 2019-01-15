<?php
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
            foreach ($listeDonneeVariable as $donneeVariable) {
                $typeDonnee = $typeDonneeManager->getTypeDonneeById($donneeVariable->getIdType());
                $enonce = str_replace($typeDonnee->getLibelle(), $donneeVariable->getValeur(), $enonce);
            }
            echo $enonce;
        ?>
        <input type="submit" value="Envoyer les réponses">
    </form>

<?php } else {
    //Stocker les réponses.
    foreach($_POST as $key => $value) {
        $numero_question = str_replace('question_', '', $key);
        $reponseQuestion = new Reponse([
            'idUtilisateur' => $idEtudiant,
            'idSujet' => $idSujet,
            'numReponse' => $numero_question,
            'valeur' => $value,
            'dateReponse' => date('Y-m-d')
        ]);
        $reponseManager->enregistrerReponse($reponseQuestion);
    }
}?>