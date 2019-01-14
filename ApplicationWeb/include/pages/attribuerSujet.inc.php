<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Gestion des contrôle</a>
  </li>
  <li class="breadcrumb-item active">Attribution des sujets</li>
</ol>

<?php
if(!isset($_POST['ok']) && empty($_POST['choix_promotion'])){
 ?>
  <form action="#" method="POST">

    <h2> Choisir un sujet</h2>
    <p>
       Promotion : <select name="choix_promotion">
                      <option value="1"> Année 1</option>
                      <option value="2"> Année 2</option>

                    </select>


        Liste des sujets : <?php echo $sujetManager->countSujet();?> sujet(s) a/ont été trouvé


        <select name="choix_sujet">

            <?php
            $listSujets = $sujetManager->getListEnonces();

            foreach ($listSujets as $sujet){
              echo $sujet->getIdEnonce();
            ?>
            <option value="<?php echo $sujet->getIdEnonce();?>">Contrôle n° <?php echo $sujet->getIdEnonce(); ?> de Mécanique</option>
            <?php
            }
             ?>
        </select>

        Date de limite de réponse :
        <input type="date" name="date_limite" value="<?php echo date("Y-m-d"); ?>">

      </p>

      <button type="submit" value="ok" class="button">Confirmer</button>
    </form>

<?php
}
else if($_POST['choix_promotion']=="1"){

  $sujetChoisi = $_POST['choix_sujet'];

  $listEtudiant = $utilisateurManager->recupererPromotionEtudiante($_POST['choix_promotion']);
  foreach ($listEtudiant as $etudiant) {

    $idMaxSujet = $attribueManager->getIdSujetMaximumByIdEnonce($sujetChoisi);
    $idSujetAlea = rand( 1 ,$idMaxSujet );

    $attribuerSujet = new Attribue(array('idUtilisateur' => $etudiant->getIdUtilisateur(),
                                        'idSujet' => $idSujetAlea,
                                        'dateAttribution' => date("Y-m-d"),
                                        'dateLimite' => $_POST["date_limite"],
                                        ));
    $attribueManager->addAttribue($attribuerSujet);
  }
  if($attribueManager->countNombreDeSujetAttribuerAUnEtudiant($etudiant->getIdUtilisateur()) >= 1){
    echo "Tous les étudiants de première année ont un sujet.";
  }

}
else if($_POST['choix_promotion']=="2"){

  $sujetChoisi = $_POST['choix_sujet'];


  $listEtudiant = $utilisateurManager->recupererPromotionEtudiante($_POST['choix_promotion']);
  foreach ($listEtudiant as $etudiant) {

    $idMaxSujet = $attribueManager->getIdSujetMaximumByIdEnonce($sujetChoisi);
    $idSujetAlea = rand( 1 ,$idMaxSujet );

    $attribuerSujet = new Attribue(array('idUtilisateur' => $etudiant->getIdUtilisateur(),
                                        'idSujet' => $idSujetAlea,
                                        'dateAttribution' => date("Y-m-d"),
                                        'dateLimite' => $_POST["date_limite"],
                                        ));
    $attribueManager->addAttribue($attribuerSujet);
  }
  if($attribueManager->countNombreDeSujetAttribuerAUnEtudiant($etudiant->getIdUtilisateur()) >= 1){
    echo "Tous les étudiants de seconde année ont un sujet.";
  }

}
?>
