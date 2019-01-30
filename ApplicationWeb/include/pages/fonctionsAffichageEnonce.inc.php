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
                    $insertion .= "(". comparerValeurs($solutionManager, $numero_question, $reponse->getValeur()) . "%)";
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
function comparerValeurs(SolutionManager $solutionManager, DonneeVariableManager $donneeVariableManager, int $idSujet, int $idQuestion, $reponse) {

    //Récupérer la solution avec l'id de la question
    $solution = $solutionManager->recupererSolution($idQuestion+1);

    //Récupérer le nom de la formule
    $nomFormule = $solution->getNomFormule();

    //Récupérer les id des paramètres à appliquer à cette fonction
    $params = $solution->getTableauIdParams();

    //Split le string des idParamètres obtenu en un tableau
    $arrayResult = preg_split('/,/',$params);

    $params = $donneeVariableManager->recupererValeurDonneVariableViaTableauIdDonneeVariable($arrayResult);

    include("./formules/correction/".$nomFormule.".php");

    //Appel des fonction prédéfinies en fonction du nom extrait juste avant et passage des paramètres
    $solution = Formule::$nomFormule($arrayResult);

    //Récupérer la valeur de la réponse
    $reponse = $reponse->getValeur();

    //Calcul du taux d'erreur absolue en pourcentage
    $difference = abs((((double)$reponse - (double)$solution) / (double)$solution) * 100);

    return $difference;
}

function calculNoteParQuestion($tauxErreur, $idQuestion, $solutionManager){
  echo $idQuestion;
  $bareme = $solutionManager->recupererSolution($idQuestion)->getBareme();

  $noteIntermediaire = $bareme - ( ($tauxErreur * $bareme) / 100);
  return $noteIntermediaire;
}
