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
function comparerValeurs(SolutionManager $solutionManager, SujetPossibleManager $sujetPossibleManager, int $idSujet, int $idQuestion, $reponse) {

  //Récupérer la solution avec l'id de la question
  $solution = $solutionManager->recupererSolution($idQuestion);

  //Récupérer le nom de la formule
  $nomFormule = $solution->getNomFormule();

  $listeDonneVariable = $sujetPossibleManager->recuperListeDonneeVariableViaIdSujet($idSujet);

  foreach ($listeDonneVariable as $donneeVariable) {
    $params[] = $donneeVariable->getValeur();
  }

  include("./public/formules/correction/".$nomFormule.".php");

  //Appel des fonction prédéfinies en fonction du nom extrait juste avant et passage des paramètres
  $solution = Formule::$nomFormule($params);

  //Récupérer la valeur de la réponse
  $reponse = $reponse->getValeur();

  //Calcul du taux d'erreur absolue en pourcentage
  $difference = abs((((double)$reponse - (double)$solution) / (double)$solution) * 100);

  return $difference;
}

function calculNoteParQuestion($tauxErreur, $idQuestion, $solutionManager){
  if($tauxErreur > 10){
    $noteIntermediaire = 0;
  }else{
    if($tauxErreur>5) {
      $bareme = $solutionManager->recupererSolution($idQuestion)->getBareme();
      $noteIntermediaire = ((($tauxErreur - 5) *20 * $bareme) / 100);
    }else{
      $bareme = $solutionManager->recupererSolution($idQuestion)->getBareme();
      $noteIntermediaire = $bareme;
    }
  }
  return $noteIntermediaire;
}
