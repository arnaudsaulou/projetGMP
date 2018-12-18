<?php

spl_autoload_register(function ($className) {
	$repClasses=__ROOT__."\classes";
	require $repClasses."\\".$className.'.class.php';
}
);

?>
