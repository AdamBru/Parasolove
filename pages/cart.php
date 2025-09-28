<?php
	$title = " - koszyk";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<div class="page-container flex-row mobile-cart gap-l">
	
	<div class="flex-container flex-1 flex-column nowrap gap-m">

		<label for="products" class="cart-header">
			<input type="radio" name="cart-option" id="products" checked>
			<h3>Produkty</h3>
		</label>
			<div class="cart-option-container" id="cart-option-products">
			<?php
				// Usuwanie produktu 
				if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
					$removeId = $_POST['remove_id'];

					if (isset($_COOKIE['cart'])) {
						$cart = json_decode($_COOKIE['cart'], true);

						if (is_array($cart)) {
							$cart = array_filter($cart, function ($item) use ($removeId) {
								return $item['id'] != $removeId;
							});

							setcookie('cart', json_encode(array_values($cart)), time() + 3600 * 24 * 365, "/");
							header("Location: " . $_SERVER['REQUEST_URI']);
							exit;
						}
					}
				}

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
									<?= getProductImage($product['pro_product_id'], 0, $product['pro_color_id']) ?>
									
									<div class="flex-container flex-column nowrap gap-xs">
										<a href="/produkt?id=<?= $product['pro_product_id'] ?>" class="link-alt"><?= $product['pro_name'] ?></a>
										<span class="details"><?= lcfirstUtf8($product['col_name']) ?>, <?= lcfirstUtf8($product['siz_name']) ?></span>
									</div>

									<div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
										<span style="font-size: 1.15rem"><?= $product['pro_price'] ?> zł</span>
										<div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
											<div class="flex-container flex-row nowrap gap-xs">
												<input type="number" id="" value="<?= $item['quantity'] ?>" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;">
												<label for=""> szt.</label>
											</div>
											<form method="post" style="display: inline;">
												<input type="hidden" name="remove_id" value="<?= htmlspecialchars($item['id']) ?>">
												<button type="submit" class="remove-icon link-alt"></button>
											</form>
										</div>
									</div>
								</div>

								
								<?php } ?>
							
							<button class="btn" style="margin: 0 auto; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('delivery').click()">Wbierz opcję dostawy</button>
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


		<label for="delivery" class="cart-header">
			<input type="radio" name="cart-option" id="delivery">
			<h3>Dostawa</h3>
		</label>
			<div class="cart-option-container" id="cart-option-delivery">

				<div class="flex-container flex-row gap-m mobile-justify-center" style="magin-bottom: .5rem;">
					<label for="delivery-inpost" class="btn deliverer" onclick="chooseDelivery('form-inpost')">
						<img src="assets/site-images/delivery-InPost.webp">
						<span>10.99 zł</span>
						<input type="radio" name="delivery" id="delivery-inpost">
					</label>
					<label for="delivery-pocztex" class="btn deliverer" onclick="chooseDelivery('form-pocztex')">
						<img src="assets/site-images/delivery-Pocztex.webp" style="padding: .7rem .5rem;">
						<span>13.99 zł</span>
						<input type="radio" name="delivery" id="delivery-pocztex">
					</label>
				</div>

				<form method="post" class="deliverer-details" id="form-inpost" style="display: none;">
					<label for="form-inpost-imie">Imię</label>
						<input type="text" id="form-inpost-imie">
					<label for="form-inpost-nazwisko">Nazwisko</label>
						<input type="text" id="form-inpost-nazwisko">
					<label for="form-inpost-email">Adres e-mail</label>
						<input type="text" id="form-inpost-email">
					<label for="form-inpost-telefon">Numer telefonu</label>
						<input type="tel" id="form-inpost-telefon">
					<label for="form-inpost-paczkomat">Numer paczkomatu InPost &nbsp;<a href="https://inpost.pl/znajdz-paczkomat" target="blank" class="help">?</a> </label>
						<input type="text" id="form-inpost-paczkomat">
				</form>

				<form method="post" class="deliverer-details" id="form-pocztex" style="display: none;">
					<label for="form-pocztex-imie">Imię</label>
						<input type="text" id="form-pocztex-imie">
					<label for="form-pocztex-nazwisko">Nazwisko</label>
						<input type="text" id="form-pocztex-nazwisko">
					<label for="form-pocztex-email">Adres e-mail</label>
						<input type="text" id="form-pocztex-email">
					<label for="form-pocztex-telefon">Numer telefonu</label>
						<input type="tel" id="form-pocztex-telefon">
					<label for="form-pocztex-kod-pocztowy">Kod pocztowy</label>
						<input type="text" id="form-pocztex-kod-pocztowy">
					<label for="form-pocztex-miasto">Miasto</label>
						<input type="text" id="form-pocztex-miasto">
					<label for="form-pocztex-ulica">Ulica</label>
						<input type="text" id="form-pocztex-ulica">
					<label for="form-pocztex-lokal">Lokal</label>
						<input type="text" id="form-pocztex-lokal">
				</form>

				<button class="btn" style="margin: 1.5rem auto 0; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('payment').click()">Wbierz opcję płatności</button>
			</div>

		<label for="payment" class="cart-header">
			<input type="radio" name="cart-option" id="payment">
			<h3>Płatność</h3>
		</label>
			<div class="cart-option-container mobile-justify-center" id="cart-option-payment">
				<div class="flex-container flex-row gap-m mobile-justify-center">

					<label for="payment-przelew" class="btn deliverer">
						<img src="assets/site-images/payment-bank.svg" style="padding: .7rem .5rem;">
						Przelw bankowy
						<input type="radio" name="payment" id="payment-przelew">
					</label>
					<label for="payment-blik" class="btn deliverer">
						<img src="assets/site-images/payment-blik.webp" style="padding: .7rem .5rem;">
						<input type="radio" name="payment" id="payment-blik">
					</label>
					<label for="payment-gpay" class="btn deliverer">
						<img src="assets/site-images/payment-gpay.webp" style="padding: .8rem .5rem .6rem;">
						<input type="radio" name="payment" id="payment-gpay">
					</label>
					<label for="payment-applepay" class="btn deliverer">
						<img src="assets/site-images/payment-applepay.webp" style="padding: .8rem .5rem .6rem;">
						<input type="radio" name="payment" id="payment-applepay">
					</label>

				</div>

				<form method="post"> <input type="submit" id="orderRedirect" name="orderRedirect" style="display: none;"> </form>
				<button class="btn" style="margin: 1.5rem auto 0; padding: .4rem 2.5rem; width: fit-content;" onclick="order()">Zapłać</button> 
				<?php
					if (isset($_POST['orderRedirect'])) {
						$_SESSION['order'] = 'success';
						echo '<script>window.location.href = "zamowienie";</script>';
					}
				?>
			</div>

	</div>

	<!-- Aside: Podsumowanie -->
	<aside class="cart-info">
		<h2 class="mobile-header" style="display: none; margin: 0 0 1rem;">Koszyk</h2>
		<h3 style="margin-bottom: .5rem;">Podsumowanie</h3>

		<div class="row">
			<span>Wartość produktów</span>
			<b id="cenaProdukty"><?= ($total > 0) ? $total : '0.00' ?> zł</b>
			<?php if ($total == 0.00) {unset($_SESSION['discount']); unset($_SESSION['submitted_code']);} ?>
		</div>

		<div class="row">
			<span id="dostawaOd">Dostawa od</span>
			<b id="dostawaCenaWybrana" class="afterZl">10.99</b>
		</div>
		
		<?= (isset($_SESSION['discount'])) ?
			'<div class="row">
				<span>Rabat</span>
				<b id="rabat" class="afterZl beforeMinus">' . number_format(round($total * ((float)$_SESSION['discount'] / 100), 2), 2, '.', ' ') . '</b>
			</div>'
			: ''
		?>

		<form method="post" style="gap: .25rem; margin-top: .25rem;">
			<span style="font-size: .9rem">Kod rabatowy</span>
			<div style="position: relative;">
				<input type="text" name="code" id="code" style="padding: .25rem .5rem; font-size: .9rem" value="<?= isset($_SESSION['submitted_code']) ? $_SESSION['submitted_code'] : '' ?>">
				<input type="submit" name="applyCode" class="arrow-right-icon" value="" style="opacity: .75;">
			</div>
		</form>

			<?php
				if (isset($_POST['applyCode'])) {
					$code = mysqli_real_escape_string($conn, $_POST['code']);
					$_SESSION['submitted_code'] = $code;
					$sql = "SELECT * FROM `cupon` WHERE `code` = '$code' LIMIT 1;";
					$result = mysqli_query($conn, $sql);

					if ($result && mysqli_num_rows($result) > 0) {
						$row = mysqli_fetch_assoc($result);
						$_SESSION['discount'] = $row['discount'];
					} else {
						echo '<span style="font-weight: 300;">Niepoprawny kod.</span>';
						unset($_SESSION['discount']);
						unset($_SESSION['submitted_code']);
					}

					echo '<script>window.location.href = "' . $_SERVER['REQUEST_URI'] . '";</script>';
					exit;
				}
			?>

		<div class="row" style="margin-top: 1rem; font-size: 1rem">
			<span>Suma</span>
			<b id="cenaTotal" class="afterZl">0.00</b>
		</div>

	</aside>

</div>

<div id="loading"></div>

<script>
	const radios = document.querySelectorAll('input[name="cart-option"]');

	const getContainer = (radio) =>
		document.getElementById(`cart-option-${radio.id}`);

	const collapse = (el) => {
		el.style.height = el.scrollHeight + 'px';
		requestAnimationFrame(() => el.style.height = '0px');
	};

	const expand = (el) => {
		el.style.height = '0px';
		requestAnimationFrame(() => {
		el.style.height = el.scrollHeight + 'px';
		el.addEventListener('transitionend', function handler() {
			el.style.height = 'auto';
			el.removeEventListener('transitionend', handler);
		});
		});
	};

	const onRadioChange = (selected) => {
		radios.forEach(radio => {
		const container = getContainer(radio);
		if (!container) return;
		if (radio === selected) expand(container);
		else collapse(container);
		});
	};

	window.addEventListener('DOMContentLoaded', () => {
		const checked = document.querySelector('input[name="cart-option"]:checked');
		if (checked) {
		const container = getContainer(checked);
		if (container) container.style.height = 'auto';
		}
	});

	radios.forEach(radio =>
		radio.addEventListener('change', () => onRadioChange(radio))
	);
</script>

<script>
	displayTotal();

	function chooseDelivery() {
		let selectInpost = document.getElementById("delivery-inpost");
		let selectPocztex = document.getElementById("delivery-pocztex");
		let formInpost = document.getElementById("form-inpost");
		let formPocztex = document.getElementById("form-pocztex");

		let dostawaOd = document.getElementById("dostawaOd");
		let dostawaCenaWybrana = document.getElementById("dostawaCenaWybrana");

		if (selectInpost.checked) {
			formInpost.style.display = "flex";
			formPocztex.style.display = "none";
			dostawaOd.innerText = "Dostawa";
			dostawaCenaWybrana.innerText = "10.99";
			displayTotal();
		} else if (selectPocztex.checked) {
			formPocztex.style.display = "flex";
			formInpost.style.display = "none";
			dostawaOd.innerText = "Dostawa";
			dostawaCenaWybrana.innerText = "13.99";
			displayTotal();
		} 
	}

	function displayTotal() {
		let cenaProdukty = parseFloat(document.getElementById("cenaProdukty").textContent);
		let dostawaCenaWybrana = parseFloat(document.getElementById("dostawaCenaWybrana").textContent);
		let cenaTotal = document.getElementById("cenaTotal");

		let rabatEl = document.getElementById("rabat");
		let rabat = rabatEl ? parseFloat(rabatEl.textContent) : 0;

		(cenaProdukty > 0) ? cenaTotal.innerText = Math.round((cenaProdukty + dostawaCenaWybrana - rabat) * 100) / 100 : 0.00;
	}

	function order() {
		if ( parseFloat(document.getElementById("cenaTotal").textContext) > 0 ) {
			document.getElementById("loading").classList.add("active");
			setTimeout(() => {
				document.getElementById("orderRedirect").click();
			}, 2500);
		}
	}
</script>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>