<script type="text/javascript" src="js/interpreterEnonce.js"></script>

<?php

$idEtudiant = $utilisateurManager->getUtilisateurByLogin($_SESSION['log'])->getIdUtilisateur();
$attribue = $attribueManager->getAttribuePourEtudiant($idEtudiant);

if(count($attribue) > 0){
  $idSujet = $attribue[0]->getIdSujet();
  $idEnonce = $sujetManager->getSujetAvecId($idSujet)->getIdEnonce();
  $enonce = $enonceManager->recupererEnonceViaIdEnonce($idEnonce);
  echo $enonce->getEnonce();

?>

  <script type="text/javascript">
      recupererTypeDonneeVariableDansEnonce(<?php echo $idSujet ?>);
  </script>

<?php } else {
  echo 'Erreur : Aucuns sujet attribué';
}?>
