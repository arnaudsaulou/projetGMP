<?php

$enonce = $enonceManager->recupererEnonceViaIdEnonce($_GET['idEnonce']);

?>

<h1> Sujet n°<?php echo $enonce->getIdEnonce(); ?> : </h1>

<?php

echo $enonce->getEnonce();

 ?>
