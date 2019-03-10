<?php
// Paramètres de l'application GMP
// A modifier en fonction de la configuration


// Ce fichier doit être renommé en :
//    config.inc.php
//pour être pris en compte par l'Application

// Leslignes contenant des XXXXX doivent être modifiés

define('DBHOST', "XXX.XXX.XXX.XXX:XXXX"); //Adresse du serveur de la base de données
define('DBNAME', "projet_gmp");
define('DBUSER', "XXXXXXX"); //Identifiant d'un utilisateur de la base de données
define('DBPASSWD', "XXXXXXX"); //Mot de passe de l'utilisateur de la base de données


define('ENV','dev'); // pour un environememnt de production remplacer 'dev' (développement) par 'prod' (production)
define('SALT','XXXXXX'); //Un grain de sel pour le hachage des mots de passe
define('DBPORT',XXXX); // le port de la base de données

define('__ROOT__', dirname(dirname(__FILE__)));
?>
