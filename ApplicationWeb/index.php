<?php
session_start();

require('include/config.inc.php');
require('include/autoLoad.inc.php');
?>
<div id="header">
<?php
require_once("include/header.inc.php");
?>
</div>
<?php
//Managers ici
$db = new MyPDO();
$donneeVariableManager = new DonneeVariableManager($db);
$typeDonneeManager = new TypeDonneeManager($db);
$sujetManager = new SujetManager($db);
$utilisateurManager = new UtilisateurManager($db);
$noteManager=new NoteManager($db);
$attribueManager=new AttribueManager($db);
?>

<div id="corps">
<?php
require_once("include/menu.inc.php");

require_once("include/texte.inc.php");
?>
</div>

<div id="spacer"></div>
<?php
require_once("include/footer.inc.php"); ?>
