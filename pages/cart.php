<?php
	$title = " - koszyk";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<div class="page-container flex-row">

	<div class="flex-container flex-1 flex-column gap-m">

		<label for="products" class="cart-header">
			<input type="radio" name="cart-option" id="products">
			<h3>Produkty</h3>
		</label>

		<label for="delivery" class="cart-header">
			<input type="radio" name="cart-option" id="delivery">
			<h3>Dostawa</h3>
		</label>

		<label for="payment" class="cart-header">
			<input type="radio" name="cart-option" id="payment">
			<h3>Płatność</h3>
		</label>


	</div>

	<!-- Aside: Podsumowanie -->
	<aside class="cart-info">
		<h3>Podsumowanie</h3>
	</aside>

</div>

<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>