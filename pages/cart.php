<?php
	$title = " - koszyk";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<div id="loading"></div>

<form method="post">

<div class="page-container flex-row mobile-cart gap-l">
	
	<div class="flex-container flex-1 flex-column nowrap gap-m">

		<!-- Radio: Produkty -->
		<label for="products" class="cart-header">
			<input type="radio" name="cart-option" id="products" checked>
			<h3>Produkty</h3>
		</label>
			<?php require_once('components/cartModules/cart_displayProducts.php'); ?>

		<!-- Radio: Dostawa -->
		<label for="delivery" class="cart-header">
			<input type="radio" name="cart-option" id="delivery">
			<h3>Dostawa</h3>
		</label>
			<?php require_once('components/cartModules/cart_delivery.php'); ?>

		<!-- Radio: Płatność -->
		<label for="payment" class="cart-header">
			<input type="radio" name="cart-option" id="payment">
			<h3>Płatność</h3>
		</label>
			<?php require_once('components/cartModules/cart_payment.php'); ?>


		<input type="submit" id="orderRedirect" name="orderRedirect" style="display: none;">
		<?php
		// Wysyłanie zamówienia
			if (isset($_POST['orderRedirect'])) {
					// echo '<pre>';
					// print_r($_POST);
					// echo '</pre>';
				if (isset($_POST['delivery']) && $_POST['delivery'] == 'inpost') {
					// Wybrano dostawę: InPost, sprawdzam pola form-inpost
					if (
						isset($_POST['form-inpost-imie']) && !empty($_POST['form-inpost-imie']) && 
						isset($_POST['form-inpost-nazwisko']) && !empty($_POST['form-inpost-nazwisko']) && 
						isset($_POST['form-inpost-email']) && !empty($_POST['form-inpost-email']) && 
						isset($_POST['form-inpost-telefon']) && !empty($_POST['form-inpost-telefon']) && 
						isset($_POST['form-inpost-paczkomat']) && !empty($_POST['form-inpost-paczkomat'])
					) {
						// Wszystkie pola w form-inpost są wypełnione, czy wybrano płatość?
						if (isset($_POST['payment'])) {
							placeOrder();
							echo '<script> document.getElementById("payment").click(); </script>';
							echo '<script> document.getElementById("payment-' . $_POST['payment'] . '").click(); </script>';
						} else {
							// Wszystkie pola w form-inpost są wypełnione ale nie wybrano płatności
							echo '<script> setTimeout(() => { document.getElementById("delivery-inpost").click(); }, 0); </script>';
							echo '<script> document.getElementById("payment").click(); </script>';
							echo '<div class="infoPopup flex align-center justify-center flex-row nowrap gap-m" id="infoPopup" style="max-width: none; background: #bb6b6b; color: #fff; font-weight: 400;">
									<p style="white-space: nowrap;">Należy wybrać metodę płatności.</p>
									<input type="button" id="accept-cookie" class="btn flex-0" value="OK" onclick="hidePopup()" style="padding: .1rem .6rem; background: #fff;">
								</div>';
						}
					}
					else {
						// Brakuje danych w formularzu InPost
						echo '<div class="infoPopup flex align-center justify-center flex-row nowrap gap-m" id="infoPopup" style="max-width: none; background: #bb6b6b; color: #fff; font-weight: 400;">
								<p style="white-space: nowrap;">Należy wypełnić wszystkie pola.</p>
								<input type="button" id="accept-cookie" class="btn flex-0" value="OK" onclick="hidePopup()" style="padding: .1rem .6rem; background: #fff;">
							</div>';
						echo '<script> document.getElementById("delivery").click(); </script>';
						echo '<script> setTimeout(() => { document.getElementById("delivery-inpost").click(); }, 0); </script>';
					}
				} else if (isset($_POST['delivery']) && $_POST['delivery'] == 'pocztex') {
					// Wybrano dostawę: Pocztex, sprawdzam pola form-pocztex
					if (
						isset($_POST['form-pocztex-imie']) && !empty($_POST['form-pocztex-imie']) && 
						isset($_POST['form-pocztex-nazwisko']) && !empty($_POST['form-pocztex-nazwisko']) && 
						isset($_POST['form-pocztex-email']) && !empty($_POST['form-pocztex-email']) && 
						isset($_POST['form-pocztex-telefon']) && !empty($_POST['form-pocztex-telefon']) && 
						isset($_POST['form-pocztex-kodPocztowy']) && !empty($_POST['form-pocztex-kodPocztowy']) && 
						isset($_POST['form-pocztex-miasto']) && !empty($_POST['form-pocztex-miasto']) && 
						isset($_POST['form-pocztex-ulica']) && !empty($_POST['form-pocztex-ulica']) && 
						isset($_POST['form-pocztex-lokal']) && !empty($_POST['form-pocztex-lokal']) 
					) {
						// Wszystkie pola w form-pocztex są wypełnione, czy wybrano płatość?
						if (isset($_POST['payment'])) {
							placeOrder();
							echo '<script> document.getElementById("payment").click(); </script>';
							echo '<script> document.getElementById("payment-' . $_POST['payment'] . '").click(); </script>';
						} else {
							// Wszystkie pola w form-pocztex są wypełnione ale nie wybrano płatności
							echo '<script> setTimeout(() => { document.getElementById("delivery-pocztex").click(); }, 0); </script>';
							echo '<script> document.getElementById("payment").click(); </script>';
							echo '<div class="infoPopup flex align-center justify-center flex-row nowrap gap-m" id="infoPopup" style="max-width: none; background: #bb6b6b; color: #fff; font-weight: 400;">
									<p style="white-space: nowrap;">Należy wybrać metodę płatności.</p>
									<input type="button" id="accept-cookie" class="btn flex-0" value="OK" onclick="hidePopup()" style="padding: .1rem .6rem; background: #fff;">
								</div>';
						}
					}
					else {
						// Brakuje danych w formularzu Pocztex
						echo '<div class="infoPopup flex align-center justify-center flex-row nowrap gap-m" id="infoPopup" style="max-width: none; background: #bb6b6b; color: #fff; font-weight: 400;">
								<p style="white-space: nowrap;">Należy wypełnić wszystkie pola.</p>
								<input type="button" id="accept-cookie" class="btn flex-0" value="OK" onclick="hidePopup()" style="padding: .1rem .6rem; background: #fff;">
							</div>';
						echo '<script> document.getElementById("delivery").click(); </script>';
						echo '<script> setTimeout(() => { document.getElementById("delivery-pocztex").click(); }, 0); </script>';
					}

				} else {
					// Error: Nie wybrano opcji dostawy
					echo '<div class="infoPopup flex align-center justify-center flex-row nowrap gap-m" id="infoPopup" style="max-width: none; background: #bb6b6b; color: #fff; font-weight: 400;">
							<p style="white-space: nowrap;">Wymagane jest wybranie opcji dostawy.</p>
							<input type="button" id="accept-cookie" class="btn flex-0" value="OK" onclick="hidePopup()" style="padding: .1rem .6rem; background: #fff;">
						</div>';
					echo '<script> document.getElementById("delivery").click(); </script>';
				}

			}
			
			function placeOrder() {
				$_SESSION['order'] = 'success';
				echo '<script>
						document.getElementById("loading").classList.add("active");
						setTimeout(() => {
							window.location.href = "zamowienie";
						}, 3000);
					</script>';
			}
		?>

	</div>

	<!-- Aside: Podsumowanie -->
	<?php require_once('components/cartModules/cart_asidePodsumowanie.php'); ?>

</div>

</form>


<script>
	// Skrypt odpowiadający za rozwijanie elementów strony koszyka
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
		if (radio == selected) expand(container);
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
		let rabat = rabatEl ? parseFloat(rabatEl.textContent.replace(' zł', '').trim()) : 0;

		let total = cenaProdukty + dostawaCenaWybrana - rabat;
		if (cenaProdukty > 0.00) {
			cenaTotal.innerText = total > 0 ? total.toFixed(2) : '0.00';
		}
	}


	function order() {
		if ( parseFloat(document.getElementById("cenaTotal").innerText) > 0 ) {
			document.getElementById("orderRedirect").click();
		}
	}

	// Blokada następnych opcji, jeśli nie spełniono warunku poprzedniej
	let deliveryRadio = document.getElementById("delivery");
	let paymentRadio = document.getElementById("payment");

	let cenaProdukty = parseFloat(document.getElementById("cenaProdukty").textContent);

	if (cenaProdukty == 0.00) {
		deliveryRadio.disabled = true;
		deliveryRadio.parentNode.style.cursor = "auto";
		paymentRadio.disabled = true;
		paymentRadio.parentNode.style.cursor = "auto";
	} else {
		deliveryRadio.disabled = false;
		paymentRadio.disabled = false;
	}

	// Skrypt automatycznie znikający popup
	let infoPopup = document.getElementById("infoPopup");
	setTimeout(() => {
		hidePopup();
	}, 5000); 

	// Skrypt znikający popup
	function hidePopup() {
		infoPopup.style.animation = "slideUp .8s ease-in-out";
		setTimeout(() => {
			infoPopup.style.display = "none";
		}, 780); 
	}


</script>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>