<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
require 'config/paths.php';

function __autoload($class) {
	$class = strtolower($class);
	if (file_exists("libs/$class.php")) :
		require_once "libs/$class.php";
	elseif (file_exists("models/$class.php")) :
		require_once "models/$class.php";
	endif;
}

$app = new Bootstrap();



?>