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
				<div class="cart-product">
					<img src="https://placehold.co/400">
					
					<div class="flex-container flex-column nowrap gap-xs">
						<a href="" class="link-alt">Produkt testowy</a>
						<span class="details">czarny, mały</span>
					</div>

					<div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
						<span style="font-size: 1.15rem">39.99 zł</span>
						<div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
							<div class="flex-container flex-row nowrap gap-xs">
								<input type="number" id="" value="1" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;">
								<label for=""> szt.</label>
							</div>
							<button class="remove-icon link-alt"></button>
						</div>
					</div>
				</div>
				
				<div class="cart-product">
					<img src="https://placehold.co/400">
					
					<div class="flex-container flex-column nowrap gap-xs">
						<a href="" class="link-alt">Produkt testowy</a>
						<span class="details">czarny, mały</span>
					</div>

					<div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
						<span style="font-size: 1.15rem">39.99 zł</span>
						<div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
							<div class="flex-container flex-row nowrap gap-xs">
								<input type="number" id="" value="1" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;">
								<label for=""> szt.</label>
							</div>
							<button class="remove-icon link-alt"></button>
						</div>
					</div>
				</div>
				
				<div class="cart-product">
					<img src="https://placehold.co/400">
					
					<div class="flex-container flex-column nowrap gap-xs">
						<a href="" class="link-alt">Produkt testowy</a>
						<span class="details">czarny, mały</span>
					</div>

					<div class="mobile-price flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: fit-content; height: 100%; white-space: nowrap;">
						<span style="font-size: 1.15rem">39.99 zł</span>
						<div class="flex-container flex-column nowrap" style="justify-content: space-between; gap: .75rem; width: 100%;">
							<div class="flex-container flex-row nowrap gap-xs">
								<input type="number" id="" value="1" style="width: 2.5rem; height: 1.5rem; text-align: center; font-size: .85rem;">
								<label for=""> szt.</label>
							</div>
							<button class="remove-icon link-alt"></button>
						</div>
					</div>
				</div>

				<button class="btn" style="margin: 0 auto; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('delivery').click()">Wbierz opcję dostawy</button>
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

				<form method="post" id="orderRedirect"></form>
				<button class="btn" style="margin: 1.5rem auto 0; padding: .4rem 2.5rem; width: fit-content;" onclick="order()">Zapłać</button> 
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$_SESSION['order'] = 'success';
						echo '<script>window.locatioben.href = "zamowienie";</script>';
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
			<b>119.97 zł</b>
		</div>

		<div class="row">
			<span>Dostawa od</span>
			<b>10.99 zł</b>
		</div>

		<form method="post" style="gap: .25rem; margin-top: .25rem;">
			<span style="font-size: .9rem">Kod rabatowy</span>
			<div style="position: relative;">
				<input type="text" name="" style="padding: .25rem .5rem; font-size: .9rem">
				<input type="submit" class="arrow-right-icon" value="" style="opacity: .75;">
			</div>
		</form>

		<div class="row" style="margin-top: 1rem; font-size: 1rem">
			<span>Suma</span>
			<b>150,94 zł</b>
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
	function chooseDelivery() {
		let selectInpost = document.getElementById("delivery-inpost");
		let selectPocztex = document.getElementById("delivery-pocztex");
		let formInpost = document.getElementById("form-inpost");
		let formPocztex = document.getElementById("form-pocztex");

		if (selectInpost.checked) {
			formInpost.style.display = "flex";
			formPocztex.style.display = "none";
		} else if (selectPocztex.checked) {
			formPocztex.style.display = "flex";
			formInpost.style.display = "none";
		} 
	}

	function order() {
		document.getElementById("loading").classList.add("active");
		setTimeout(() => {
			document.getElementById("orderRedirect").submit();
		}, 2500);
	}
</script>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>