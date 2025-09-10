<?php
	// Router

	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$routes = [
		'/' => 'pages/home.php',
		'/not-found' => 'pages/404.php',
		'/wyloguj' => 'handlers/logout.php',
		'/katalog' => 'pages/catalog.php',
		'/panel-sprzedawcy' => 'pages/managePanel.php',
	];


	if(array_key_exists($uri, $routes)) {
		require_once($routes[$uri]);
	} else {
		http_response_code(404);
		header('Location: /not-found');
		exit();
	}
?>