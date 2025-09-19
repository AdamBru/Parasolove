<form method="post" enctype="multipart/form-data">
		<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
		<p style="white-space: nowrap;">Zdjęcia</p><hr style="min-width: 3rem">
	</div>
		<div class="label-input-container flex-container gap-xs">
			<label class="flex-1">Wybierz do trzech zdjęć</label>
			<input type="file" name="new-product-photo[]" id="new-product-photo[]" accept="image/png, image/jpeg, image/webp" multiple>
		</div>

	<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0">
		<input type="submit" value="Dodaj produkt" name="new-product-add" style="width: fit-content; cursor: pointer;">
	</div>
</form>


<?php
// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

if (isset($_FILES['new-product-photo'])) {
	echo "test";
	for ($i = 0; $i < count($_FILES['new-product-photo']['name']); $i++) {
		echo 'Name: ' . $_FILES['new-product-photo']['name'][$i] . '<br>';
		$f = getimagesize($_FILES['new-product-photo']['tmp_name'][$i]);
		echo 'Format: ' . $f['mime'] . '<br>';
		echo 'Size: ' . $_FILES['new-product-photo']['size'][$i] . ' bits<br>';

		$savePath = './assets/product/' . $_FILES['new-product-photo']['name'][$i];
		chmod('./assets/product', 0777);
		echo $savePath;
		if (move_uploaded_file($_FILES['new-product-photo']['tmp_name'][$i], $savePath)) {
			echo 'Upload SUCCES! <br><br>';
			echo '<img src="' . $savePath . '">';
		} else {
			echo 'Upload FAIL! <br><br>';
		}
	}
}
?>