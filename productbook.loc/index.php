<?php
define("PRODUCTBOOK", TRUE);
include 'config.php';
//session_start();


$routes = array(
	array('url' => '#^$|^\?#', 'view' => 'category'),
		array('url' => '#^ajax#i', 'view' => 'ajax'),
		array('url' => '#^cat#i', 'view' => 'category'),
		array('url' => '#^array#i', 'view' => 'array'),

);

$url = ltrim($_SERVER['REQUEST_URI'], '/');
//var_dump($routes);

foreach ($routes as $route) {
	if( preg_match($route['url'], $url, $match) ){
		$view = $route['view'];

		break;

	}
}

if( empty($match) ){
	include 'views/404.php';
	exit;
}

extract($match);
require_once "controllers/{$view}_controller.php";
