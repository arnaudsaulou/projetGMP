<?php

$enonce = $enonceManager->recupererEnonceViaIdEnonce($_GET['idEnonce']);

?>

<h1> Sujet n°<?php echo $enonce->getIdEnonce(); ?> : </h1>

<button href="">Corriger</button>
<button href="">Tester</button>

<?php

echo $enonce->getEnonce();

 ?>
