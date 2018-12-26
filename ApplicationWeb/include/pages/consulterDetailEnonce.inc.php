<?php

$enonce = $enonceManager->recupererEnonceViaIdEnonce($_GET['idEnonce']);

?>

<h1> Sujet n°<?php echo $enonce->getIdEnonce(); ?> : </h1>

<form>
  <input type="button" value="Corriger" onclick="window.location.href='index.php?page=9&idEnonce=<?php echo $_GET['idEnonce']?>'" />
</form>

<button href="">Tester</button>

<?php

echo $enonce->getEnonce();

 ?>
