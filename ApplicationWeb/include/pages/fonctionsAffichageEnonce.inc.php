<?php
//Sert à insérer les réponses, si elles existent, dans les champs.
function insererReponses(string &$enonce, ReponseManager $reponseManager, int $idSujet, int $idEtudiant, SolutionManager $solutionManager = null)
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
                $reponseInseree = str_replace('.', ',', $reponse->getValeur());
                $insertion = "value=\"" . $reponseInseree;
                if ($solutionManager !== null) {
                    $insertion .= "(". comparerValeurs($solutionManager, $idSujet, $numero_question, $reponse->getValeur()) . "%)";
                }
                $insertion .= "\"";
                $positionInsertion = $pos + $longueur_nombre + 2;
                insererReponseDansChamp($enonce, $insertion, $positionInsertion);
            }
        }
    } while ($pos !== false);
}

function insererReponseDansChamp(string &$enonce, string $texte, int $position)
{
    $enonce = substr_replace($enonce, $texte, $position, 0);
}

//Sert à insérer les valeurs dans à la place des libellés.
function insererValeurs(array $listeDonneeVariable, TypeDonneeManager $typeDonneeManager, string &$enonce)
{
    foreach ($listeDonneeVariable as $donneeVariable) {
        $typeDonnee = $typeDonneeManager->getTypeDonneeById($donneeVariable->getIdType());
        $enonce = str_replace($typeDonnee->getLibelle(), $donneeVariable->getValeur(), $enonce);
    }
}

//Sert à desactiver tous les <input>
function desactiverTousLesInputs(string &$enonce)
{
    $pos = 0;
    do {
        $pos = strpos($enonce, "<input ", $pos);
        if ($pos !== false) {
            $pos += 7;
            $enonce = substr_replace($enonce, "disabled", $pos, 0);
        }
    } while ($pos !== false);
}

//Compare les valeurs et retourne un nombre représentant le pourcentage de différence.
function comparerValeurs(SolutionManager $solutionManager, int $idSujet, int $idQuestion, $reponse) {
    $solution = $solutionManager->recupererSolution($idQuestion);
    $difference = (((double)$reponse - (double)$solution->getValeur()) / (double)$solution->getValeur()) * 100;
    return $difference;
}
