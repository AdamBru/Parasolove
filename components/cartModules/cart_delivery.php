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
		<input type="text" id="form-inpost-imie">
		<label for="form-inpost-nazwisko">Nazwisko</label>
		<input type="text" id="form-inpost-nazwisko">
		<label for="form-inpost-email">Adres e-mail</label>
		<input type="text" id="form-inpost-email">
		<label for="form-inpost-telefon">Numer telefonu</label>
		<input type="tel" id="form-inpost-telefon">
		<label for="form-inpost-paczkomat">Numer paczkomatu InPost &nbsp;<a href="https://inpost.pl/znajdz-paczkomat" target="blank" class="help">?</a> </label>
		<input type="text" id="form-inpost-paczkomat">
	</div>
		
	<!-- Formularz dostawy: Pocztex -->
	<div class="deliverer-details" id="form-pocztex" style="display: none;">
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
	</div>

	<!-- Przycisk: Wbierz opcję płatności -->
	<input type="button" class="btn" style="margin: 1.5rem auto 0; padding: .4rem .85rem; width: fit-content;" onclick="document.getElementById('payment').click()" value="Wbierz opcję płatności">
</div>