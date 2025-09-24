<?php
	require_once('db/config.php');
	$title = " - " . mysqli_fetch_array(mysqli_query(mysqli_connect($host, $user, $pass, $dbname), 'SELECT name FROM product WHERE product_id = ' . $_GET['id']))[0];
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
	
	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<div class="page-container product-page">

	<div class="flex-container">

		<?php
			$getProducts = getProducts($conn, 'default', false, true);
			$product = $getProducts['products'][0];
			// echo '<pre>'; print_r($product); echo '<pre>';

			echo ($getProducts['foundProducts'] == 0) ? '<script> window.location.replace("/not-found"); </script>' : '';
		?>

		<div class="product-img"> <?= getProductImage($product['pro_product_id'], 0, $product['pro_color_id']) ?> </div>

		<div class="flex-container flex-1 flex-column gap-l mobile-description" style="margin-left: 1rem;">
			<h2> <?= $product['pro_name'] ?> </h2>
			<p class="price"> <?= $product['pro_price'] ?> zł</p>
			<p class=""> <?= $product['pro_description'] ?> </p>
			
			<!-- Tabela z parametrami produktu -->
			<table>
				<tr>
					<th>Kategoraia:</th>
					<td>Parasole <?= $product['cat_name'] ?></td>
				</tr>
				<tr>
					<th>Rozmiar:</th>
					<td> <?= $product['siz_name'] ?></td>
				</tr>
				<tr>
					<th>Kolor:</th>
					<td class="flex-container align-center flex-row nowrap gap-m"> 
						<?= $product['col_name'] ?> 
						<label class="color-checkbox-label" style="background: <?= $product['col_hex_code'] ?> ;"></label> 
					</td>
				</tr>
			</table>

			<div class="flex-container  flex-row nowrap gap-s">
				<input type="number" name="add-to-card-mount" id="add-to-card-mount" class="add-to-cart-input" value="1">
				<button class="btn add-to-cart-button" style="white-space: nowrap">Dodaj do koszyka</button>
			</div>
		</div>

		<div class="flex-container">
			<p class="recommended" style="font-size: 1.5rem;">Polecane w kategorii parasole <?= $product['cat_name'] ?></p>

			<div class="flex-container flex-row nowrap align-center" style="position: relative;">
				<?php
					// 3 losowe produkty z kategorii
					$sql = 'SELECT product_id, name, price, color_id FROM product WHERE category_id = ' . $product['pro_category_id'] . ' ORDER BY RAND() LIMIT 3;';
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<a href="/produkt?id=' . $row['product_id'] . '" class="product-card">
								'. getProductImage($row['product_id'], 0, $row['color_id']) .'
								<hr>
								<h4>' . $row['name'] . '</h4>
								<p>' . $row['price'] . ' zł</p>
							</a>';
					}
				?>

				<div class="see-more justify-center align-center"> <a href="/katalog?category=<?= $product['cat_name'] ?>" class="link">Zobacz więcej</a> </div>

			</div>
		</div>
			

	</div>
</div>

<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>