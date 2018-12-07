<?php
// Param�tres de l'application Covoiturage
// A modifier en fonction de la configuration

// define('DBHOST', "91.160.51.219:3306");
// define('DBNAME', "projet_gmp");
// define('DBUSER', "dev");
// define('DBPASSWD', "piplup");

define('DBHOST', "localhost");
define('DBNAME', "projetgmp");
define('DBUSER', "root");
define('DBPASSWD', "");

define('ENV','dev');
define('SALT','48@!alsd');
define('DBPORT',3306);
// pour un environememnt de production remplacer 'dev' (d�veloppement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
