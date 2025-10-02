<?php
	// // Usuwanie produktu 
	// if (isset($_POST['remove_id'])) {
	// 	$removeId = $_POST['remove_id'];

	// 	if (isset($_COOKIE['cart'])) {
	// 		$cart = json_decode($_COOKIE['cart'], true);

	// 		if (is_array($cart)) {
	// 			$cart = array_filter($cart, function ($item) use ($removeId) {
	// 				return $item['id'] != $removeId;
	// 			});

	// 			setcookie('cart', json_encode(array_values($cart)), time() + 3600 * 24 * 365, "/");
	// 			header("Location: " . $_SERVER['REQUEST_URI']);
	// 			exit;
	// 		}
	// 	}
	// }
	// 						PRZEROBIĆ NA LINK, KTÓRY USUWA I WRACA DO KOSZYKA
?>

<?php
	$title = " - koszyk";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>
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


				<div> <input type="submit" id="orderRedirect" name="orderRedirect" style="display: none;"> </div>
				<?php
				// Wysyłanie zamówienia
					if (isset($_POST['orderRedirect'])) {
						print_r($_POST);
						if (isset($_POST['delivery']) && $_POST['delivery'] == 'inpost') {
							echo 'wybrano inpost';
						} else {
							echo 'nie wybrano dostawy';
						}


						$_SESSION['order'] = 'success';
						echo '<script>window.location.href = "zamowienie";</script>';
					}
				?>

	</div>

	<!-- Aside: Podsumowanie -->
	<?php require_once('components/cartModules/cart_asidePodsumowanie.php'); ?>

</div>

</form>

<div id="loading"></div>

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
		cenaTotal.innerText = total > 0 ? total.toFixed(2) : '0.00';
	}


	function order() {
		if ( parseFloat(document.getElementById("cenaTotal").innerText) > 0 ) {
			document.getElementById("loading").classList.add("active");
			setTimeout(() => {
				document.getElementById("orderRedirect").click();
			}, 2500);
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


</script>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>