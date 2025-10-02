<div class="cart-option-container" id="cart-option-products">
<?php
	// Wyświetlanie produktów w koszyku
	$total = 0.00;
	if (isset($_COOKIE['cart'])) {
		$cart = json_decode($_COOKIE['cart'], true);
		if (is_array($cart)) {
			if (empty($cart)) {
				echo '<div class="cart-product" style="margin-bottom: 1rem;"> Twój koszyk jest pusty. </div>';
			} else {
				foreach ($cart as $item) {
					$getProducts = getProducts($conn, 'default', false, true, $item['id']);
					$product = $getProducts['products'][0];
					$total += $product['pro_price'];
					?>

					<div class="cart-product">
						<!-- Obraz produktu -->
						<?= getProductImage($product['pro_product_id'], 0, $product['pro_color_id'], $product['pro_size_id']) ?>
						
						<!-- Nazwa i właściwości produktu -->
						<div class="flex-container flex-column nowrap gap-xs">
							<a href="/produkt?id=<?= $product['pro_product_id'] ?>" class="link-alt"><?= $product['pro_name'] ?></a>
							<span class="details"><?= lcfirstUtf8($product['col_name']) ?>, <?= lcfirstUtf8($product['siz_name']) ?></span>
						</div>

						<div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
							<!-- Cena -->
							<span style="font-size: 1.15rem"><?= $product['pro_price'] ?> zł</span>
							
							<div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
								<!-- Liczba sztuk -->
								<div class="flex-container flex-row nowrap gap-xs">
									<input type="number" id="" value="<?= $item['quantity'] ?>" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;">
									<label> szt.</label>
								</div>

								<!-- Przycisk: Usuń -->
								<div style="display: inline;">
									<input type="hidden" name="remove_id" value="<?= ($item['id']) ?>">
									<a href="" class="remove-icon link-alt">TODO: JAKO LINK</a>
								</div>
							</div>
						</div>
					</div>

					<?php } ?>
				
				<!-- Przycisk: Wbierz opcję dostawy -->
				<input type="button" class="btn" style="margin: 0 auto; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('delivery').click()" value="Wbierz opcję dostawy">
				<?php
			}
		} else {
			echo "Nieprawidłowy format koszyka.";
		}
	} else {
		echo '<div class="cart-product" style="margin-bottom: 1rem;"> Twój koszyk jest pusty. </div>';
	}
?>

</div>