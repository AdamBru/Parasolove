<!-- Aside: Podsumowanie -->
<aside class="cart-info">
	<h2 class="mobile-header" style="display: none; margin: 0 0 1rem;">Koszyk</h2>
	<h3 style="margin-bottom: .5rem;">Podsumowanie</h3>

	<div class="row">
		<span>Wartość produktów</span>
		<b class="afterZl" id="cenaProdukty"><?= ($total > 0) ? $total : '0.00' ?></b>
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
		<span style="font-size: .9rem; margin-top: .5rem;">Kod rabatowy</span>
		<div style="position: relative;">
			<input type="text" name="code" id="code" style="padding: .25rem .5rem; font-size: .9rem" value="<?= isset($_SESSION['submitted_code']) ? $_SESSION['submitted_code'] : '' ?>" 		placeholder="Funkcja niedostępna" disabled>
			<input type="submit" name="applyCode" class="arrow-right-icon" value="" style="opacity: .75;" 		disabled>
		</div>
	</form>

		<?php
			if (isset($_POST['applyCode'])) {
				$code = mysqli_real_escape_string($conn, $_POST['code']);
				$_SESSION['submitted_code'] = $code;
				$sql = "SELECT * FROM `cupon` WHERE `code` = '$code' AND `active_to` >= CURDATE() LIMIT 1;";
				$result = mysqli_query($conn, $sql);

				if ($result && mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					if (is_numeric($row['discount']) && $row['discount'] > 0) {
						$_SESSION['discount'] = $row['discount'];
					} else {
						// Jeżeli rabat nie jest poprawny, usuń rabat
						unset($_SESSION['discount']);
					}
				} else {
					// Nieprawidłowy kod rabatowy
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
