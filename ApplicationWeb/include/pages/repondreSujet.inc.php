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

//Sert à insérer les réponses, si elles existent, dans les champs.
function insererReponses(string &$enonce, ReponseManager $reponseManager, int $idSujet, int $idEtudiant)
{
    $pos = 0;
    do {
        $pos = strpos($enonce, "<input name=\"question_", $pos);
        if ($pos !== false) {
            $pos += 22;
            $longueur_nombre = strpos($enonce, "\"", $pos) - $pos;
            $numero_question = substr($enonce, $pos, $longueur_nombre);
            if ($reponseManager->verifierExistenceReponse($idSujet, $numero_question, $idEtudiant)) {
                $reponse = $reponseManager->recupererReponseLaPlusRecente($idSujet, $numero_question, $idEtudiant);
                $enonce = substr_replace($enonce, "value=\"" . $reponse->getValeur() . "\"", $pos + $longueur_nombre + 2, 0);
            }
        }
    } while ($pos !== false);
}

//Sert à insérer les valeurs dans à la place des libellés.
function insererValeurs(array $listeDonneeVariable, TypeDonneeManager $typeDonneeManager, string &$enonce)
{
    foreach ($listeDonneeVariable as $donneeVariable) {
        $typeDonnee = $typeDonneeManager->getTypeDonneeById($donneeVariable->getIdType());
        $enonce = str_replace($typeDonnee->getLibelle(), $donneeVariable->getValeur(), $enonce);
    }
}

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