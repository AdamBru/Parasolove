<?php
	// Show errors

	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	// Router

	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$routes = [
		'/' => 'pages/home.php',
		'/not-found' => 'pages/404.php',
		'/wyloguj' => 'handlers/logout.php',
		'/katalog' => 'pages/catalog.php',
		'/produkt' => 'pages/product.php',
		'/panel-sprzedawcy' => 'pages/managePanel.php',
		'/koszyk' => 'pages/cart.php',
		// '/temp' => 'pages/TEMP.php',
	];


	if(array_key_exists($uri, $routes)) {
		require_once($routes[$uri]);
	} else {
		http_response_code(404);
		header('Location: /not-found');
		exit();
	}
?>