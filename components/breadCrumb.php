<div class="breadcrumb-bar">

	<a href="javascript:window.history.back();" class="go-back">&lt; wstecz</a>
	<a href="/" class="link-alt">Parasolove</a>

	<?php

		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// echo $uri;

		switch ($uri) {
			case '/katalog':
				 echo '<span>/</span>';
				echo '<a href="/katalog" class="link-alt"> katalog </a>';
				if (isset($_GET['category']) && $_GET['category'] != '' && $_GET['category'] != 'wszystkie') {
					 echo '<span>/</span>';
					echo '<a href="/katalog?category=' . $_GET['category'] . '" class="link-alt"> parasole ' . $_GET['category'] . ' </a>';
				}
				break;

			case '/produkt':
				$product = getProducts($conn, 'default', false, true)['products'][0];
				 echo '<span>/</span>';
				echo '<a href="/katalog" class="link-alt"> katalog </a>';
				 echo '<span>/</span>';
				echo '<a href="/katalog?category=' . $product['cat_name'] . '" class="link-alt"> parasole ' . $product['cat_name'] . ' </a>';
				 echo '<span>/</span>';
				echo '<a href="/produkt?id=' . $_GET['id'] . '" class="link-alt"> ' . $product['pro_name'] . ' </a>';
				break;

			case '/koszyk':
				 echo '<span>/</span>';
				echo '<a href="/koszyk" class="link-alt"> koszyk </a>';
				break;

			case '/not-found':
				break;
		}
	?>
</div>