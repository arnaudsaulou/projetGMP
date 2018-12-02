<?php
// Param�tres de l'application Covoiturage
// A modifier en fonction de la configuration

define('DBHOST', "localhost");
define('DBNAME', "projetgmp");
define('DBUSER', "Arnaud");
define('DBPASSWD', "arnaud");
define('ENV','dev');
define('SALT','48@!alsd');
define('DBPORT',3306);
// pour un environememnt de production remplacer 'dev' (d�veloppement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
