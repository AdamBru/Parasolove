<div class="cart-option-container" id="cart-option-delivery">

	<!-- Formularz dostawy: Wybierz dostawcę -->
	<div class="flex-container flex-row gap-m mobile-justify-center" style="magin-bottom: .5rem;">
		<label for="delivery-inpost" class="btn deliverer" onclick="chooseDelivery('form-inpost')">
			<img src="assets/site-images/delivery-InPost.webp">
			<span>10.99 zł</span>
			<input type="radio" name="delivery" value="inpost" id="delivery-inpost" <?= (isset($_POST['delivery']) && $_POST['delivery'] == 'inpost') ? 'checked' : '' ?>>
		</label>
		<label for="delivery-pocztex" class="btn deliverer" onclick="chooseDelivery('form-pocztex')">
			<img src="assets/site-images/delivery-Pocztex.webp" style="padding: .7rem .5rem;">
			<span>13.99 zł</span>
			<input type="radio" name="delivery" value="pocztex" id="delivery-pocztex"  <?= (isset($_POST['delivery']) && $_POST['delivery'] == 'pocztex') ? 'checked' : '' ?>>
		</label>
	</div>

	<!-- Formularz dostawy: InPost -->
	<div class="deliverer-details" id="form-inpost" style="display: none;">
		<label for="form-inpost-imie">Imię</label>
			<input type="text" id="form-inpost-imie" name="form-inpost-imie"					<?= isset($_POST['form-inpost-imie']) ? 'value="' . $_POST['form-inpost-imie'] . '"' : '' ?> >
		<label for="form-inpost-nazwisko">Nazwisko</label>
			<input type="text" id="form-inpost-nazwisko" name="form-inpost-nazwisko"			<?= isset($_POST['form-inpost-nazwisko']) ? 'value="' . $_POST['form-inpost-nazwisko'] . '"' : '' ?> >
		<label for="form-inpost-email">Adres e-mail</label>
			<input type="text" id="form-inpost-email" name="form-inpost-email"					<?= isset($_POST['form-inpost-email']) ? 'value="' . $_POST['form-inpost-email'] . '"' : '' ?> >
		<label for="form-inpost-telefon">Numer telefonu</label>
			<input type="tel" id="form-inpost-telefon" name="form-inpost-telefon"				<?= isset($_POST['form-inpost-telefon']) ? 'value="' . $_POST['form-inpost-telefon'] . '"' : '' ?> >
		<label for="form-inpost-paczkomat">Numer paczkomatu InPost &nbsp;<a href="https://inpost.pl/znajdz-paczkomat" target="blank" class="help">?</a> </label>
			<input type="text" id="form-inpost-paczkomat" name="form-inpost-paczkomat"			<?= isset($_POST['form-inpost-paczkomat']) ? 'value="' . $_POST['form-inpost-paczkomat'] . '"' : '' ?> >
	</div>
		
	<!-- Formularz dostawy: Pocztex -->
	<div class="deliverer-details" id="form-pocztex" style="display: none;">
		<label for="form-pocztex-imie">Imię</label>
			<input type="text" id="form-pocztex-imie" name="form-pocztex-imie"					<?= isset($_POST['form-pocztex-imie']) ? 'value="' . $_POST['form-pocztex-imie'] . '"' : '' ?> >
		<label for="form-pocztex-nazwisko">Nazwisko</label>
			<input type="text" id="form-pocztex-nazwisko" name="form-pocztex-nazwisko"			<?= isset($_POST['form-pocztex-nazwisko']) ? 'value="' . $_POST['form-pocztex-nazwisko'] . '"' : '' ?> >
		<label for="form-pocztex-email">Adres e-mail</label>
			<input type="text" id="form-pocztex-email" name="form-pocztex-email"				<?= isset($_POST['form-pocztex-email']) ? 'value="' . $_POST['form-pocztex-email'] . '"' : '' ?> >
		<label for="form-pocztex-telefon">Numer telefonu</label>
			<input type="tel" id="form-pocztex-telefon" name="form-pocztex-telefon"				<?= isset($_POST['form-pocztex-telefon']) ? 'value="' . $_POST['form-pocztex-telefon'] . '"' : '' ?> >
		<label for="form-pocztex-kodPocztowy">Kod pocztowy</label>
			<input type="text" id="form-pocztex-kodPocztowy" name="form-pocztex-kodPocztowy"	<?= isset($_POST['form-pocztex-kodPocztowy']) ? 'value="' . $_POST['form-pocztex-kodPocztowy'] . '"' : '' ?> >
		<label for="form-pocztex-miasto">Miasto</label>
			<input type="text" id="form-pocztex-miasto" name="form-pocztex-miasto"				<?= isset($_POST['form-pocztex-miasto']) ? 'value="' . $_POST['form-pocztex-miasto'] . '"' : '' ?> >
		<label for="form-pocztex-ulica">Ulica</label>
			<input type="text" id="form-pocztex-ulica" name="form-pocztex-ulica"				<?= isset($_POST['form-pocztex-ulica']) ? 'value="' . $_POST['form-pocztex-ulica'] . '"' : '' ?> >
		<label for="form-pocztex-lokal">Lokal</label>
			<input type="text" id="form-pocztex-lokal" name="form-pocztex-lokal"				<?= isset($_POST['form-pocztex-lokal']) ? 'value="' . $_POST['form-pocztex-lokal'] . '"' : '' ?> >
	</div>

	<!-- Przycisk: Wbierz opcję płatności -->
	<input type="button" class="btn" style="margin: 1.5rem auto 0; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('payment').click()" value="Wbierz opcję płatności">
</div>