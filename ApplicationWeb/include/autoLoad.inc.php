<?php
spl_autoload_register(function ($className) {
	$repClasses='classes/';
	require $repClasses.$className.'.class.php';
}
);
