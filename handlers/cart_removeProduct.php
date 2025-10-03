<?php
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$removeId = $_GET['id'];

		if (isset($_COOKIE['cart'])) {
			$cart = json_decode($_COOKIE['cart'], true);

			if (is_array($cart)) {
				$cart = array_filter($cart, function ($item) use ($removeId) {
					return $item['id'] != $removeId;
				});

				setcookie('cart', json_encode(array_values($cart)), time() + 3600 * 24 * 365, "/");
				header("Location: /koszyk");
				exit;
			} else {
				header("Location: /not-found");
				exit;
			}
		} else {
			header("Location: /not-found");
			exit;
		}
	} else {
		header("Location: /not-found");
		exit;
	}
?>