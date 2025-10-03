<div class="cart-option-container mobile-justify-center" id="cart-option-payment">

	<div class="flex-container flex-row gap-m mobile-justify-center">
		<!-- Opcja płatności: Przelew bankowy -->
		<label for="payment-przelew" class="btn deliverer">
			<img src="assets/site-images/payment-bank.svg" style="padding: .7rem .5rem;">
			Przelw bankowy
			<input type="radio" name="payment" id="payment-przelew" value="przelew">
		</label>

		<!-- Opcja płatności: Blik -->
		<label for="payment-blik" class="btn deliverer">
			<img src="assets/site-images/payment-blik.webp" style="padding: .7rem .5rem;">
			<input type="radio" name="payment" id="payment-blik" value="blik">
		</label>
		
		<!-- Opcja płatności: Google Pay -->
		<label for="payment-gpay" class="btn deliverer">
			<img src="assets/site-images/payment-gpay.webp" style="padding: .8rem .5rem .6rem;">
			<input type="radio" name="payment" id="payment-gpay" value="gpay">
		</label>

		<!-- Opcja płatności: Apple Pay -->
		<label for="payment-applepay" class="btn deliverer">
			<img src="assets/site-images/payment-applepay.webp" style="padding: .8rem .5rem .6rem;">
			<input type="radio" name="payment" id="payment-applepay" value="applepay">
		</label>
	</div>

	<input type="button" class="btn" style="margin: 1.5rem auto 0; padding: .4rem 2.5rem; width: fit-content;" onclick="order()" value="Zapłać">

</div>