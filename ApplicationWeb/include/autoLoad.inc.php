<?php
function __autoload($className){
	$repClasses='classes/';
	require $repClasses.$className.'.class.php';
}