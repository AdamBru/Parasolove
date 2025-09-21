<div class="flex-container align-center flex-row nowrap gap-s">
	<button data-modal-target="#add-product" class="btn add"> <b style="margin: 0 .2rem">+</b> Utwórz produkt</button>
	<div style="width: 1.5rem; height: .5rem; margin: .5rem 0 .5rem 1rem; background: #f8fe3875; border: 1px solid #ccc;"></div> - produkt zarchiwizowany
</div>

<div class="table-container flex-1">
	<table>
		<thead>
			<tr>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				ID <div class="arrow-container"> 
							<a href="?view=products&sort=id-asc" id="arrow-id-asc" class="arrow"></a> 
							<a href="?view=products&sort=id-desc" id="arrow-id-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> &nbsp; &nbsp; &nbsp; &nbsp; </th>
				<th> <div class="flex-container flex-row nowrap align-center gap-s">
				Nazwa <div class="arrow-container"> 
							<a href="?view=products&sort=name-asc" id="arrow-name-asc" class="arrow"></a> 
							<a href="?view=products&sort=name-desc" id="arrow-name-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Kategoria <div class="arrow-container"> 
							<a href="?view=products&sort=category-asc" id="arrow-category-asc" class="arrow"></a> 
							<a href="?view=products&sort=category-desc" id="arrow-category-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Kolor <div class="arrow-container"> 
							<a href="?view=products&sort=color-asc" id="arrow-color-asc" class="arrow"></a> 
							<a href="?view=products&sort=color-desc" id="arrow-color-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Rozmiar <div class="arrow-container"> 
							<a href="?view=products&sort=size-asc" id="arrow-size-asc" class="arrow"></a> 
							<a href="?view=products&sort=size-desc" id="arrow-size-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Cena <div class="arrow-container"> 
							<a href="?view=products&sort=price-asc" id="arrow-price-asc" class="arrow"></a> 
							<a href="?view=products&sort=price-desc" id="arrow-price-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Liczba <div class="arrow-container"> 
							<a href="?view=products&sort=quantity-asc" id="arrow-quantity-asc" class="arrow"></a> 
							<a href="?view=products&sort=quantity-desc" id="arrow-quantity-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th style="padding-left: 0;">Edytuj</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sort = $_GET['sort'] ?? 'default';
				$data = getProducts($conn, $sort, false);
				$products = $data['products'];
				$currentPage = $data['pagination']['currentPage'];
				$totalPages = $data['pagination']['totalPages'];

				foreach ($products as $product) {
					echo '<tr ' . ( ($product['p_is_archived'] == 1) ? 'style="background: #f8fe3875;"' : '' ) . '>
							<td>' . $product['pro_product_id'] . '</td>
							<td class="td-img">' . getProductImage($product['pro_product_id'], 0) . '</td>
							<td>' . textTooLong($product['pro_name'], 45) . '</td>
							<td>' . $product['cat_name'] . '</td>
							<td class="td-color"> <label class="color-checkbox-label" style="background: ' . $product['col_hex_code'] . '; cursor: auto;"></label> </td>
							<td>' . $product['siz_name'] . '</td>
							<td>' . $product['pro_price'] . ' zł</td>
							<td>' . $product['pro_quantity'] . '</td>
							<td><span data-modal-target="#edit-product-' . $product['pro_product_id'] . '" class="edit"></span></td>
						</tr>';

					//TODO: Modal: edytuj produkt #edit-product-ID
					// echo '
					// 	<div class="modal" id="edit-product-' . $product['pro_product_id'] . '">
					// 		<div class="modal-bg" data-modal-dismiss></div>
					// 		<div class="modal-content">
					// 			<p style="margin-right: 3rem;">Edytuj produkt <span class="lato-bold">' . $product['pro_name'] .'</span></p>
					// 			<br>
					// 	<!-------- TODO formularz edytowania produktu -------->
					// 			<p>formularz edytowania produktu</p>
					// 			<div class="modal-close" data-modal-dismiss></div>
					// 		</div>
					// 	</div>';
				}
				?>
		</tbody>
	</table>
</div>

<script>
	// // FOR DEVELOPMENT
	// document.addEventListener("DOMContentLoaded", () => {
	// 	setTimeout(() => {
	// 		document.querySelector('[data-modal-target="#add-product"]').click();
	// 	}, 0);
	// });
</script>

<div class="modal" id="add-product">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content flex-1">
		<div class="modal-header">
			<div class="modal-close" data-modal-dismiss></div>
			<h3 class="lato-regular">Utwórz produkt</h3>
		</div>
		
		<!-------- Formularz dodawania produktu -------->
		<form method="post" class="new-product" autocomplete="off" enctype="multipart/form-data" style="margin: 1.5rem">
			<!-- Nowy produkt: Informacje podstawowe -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 0 0 .5rem">
				<p style="white-space: nowrap;">Informacje podstawowe</p><hr style="min-width: 3rem">
			</div>
				<div class="flex-container gap-s">
					<!-- Nowy produkt: Informacje podstawowe: ID i Nazwa -->
					<div class="flex-container gap-s">
						<div class="label-input-container">
							<label for="new-product-id">ID</label>
							<?php
								$sql = 'SELECT `product_id` FROM `product` ORDER BY `product_id` DESC LIMIT 1;';
								$query = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($query);
								$newProductId = $row['product_id'] + 1;
							?>
							<input type="text" name="new-product-id" id="new-product-id" value="<?=$newProductId?>" disabled>
						</div>
						<div class="label-input-container flex-1">
							<label for="new-product-name">Nazwa</label>
							<input type="text" name="new-product-name" id="new-product-name" <?=(isset($_POST['new-product-name'])) ? 'value="' . $_POST['new-product-name'] . '"' : ''?>>
						</div>
					</div>
					
					<!-- Nowy produkt: Informacje podstawowe: Opis -->
					<div class="flex-container gap-s">
						<div class="label-input-container flex-1">
							<label for="new-product-description">Opis</label>
							<textarea name="new-product-description" id="new-product-description"><?= isset($_POST['new-product-description']) ? htmlspecialchars($_POST['new-product-description']) : '' ?></textarea>
						</div>
					</div>

					<!-- Nowy produkt: Informacje podstawowe: Cena i Liczba sztuk -->
					<div class="flex-container gap-s">
						<div class="label-input-container flex-1">
							<label for="new-product-id">Cena</label>
							<input type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" name="new-product-price" id="new-product-price" <?=(isset($_POST['new-product-price'])) ? 'value="' . $_POST['new-product-price'] . '"' : ''?>>
						</div>
						<div class="label-input-container flex-1">
							<label for="new-product-name">Lizcba sztuk</label>
							<input type="number" name="new-product-quantity" id="new-product-quantity" <?=(isset($_POST['new-product-quantity'])) ? 'value="' . $_POST['new-product-quantity'] . '"' : ''?>>
						</div>
					</div>
				</div>

			<!-- Nowy produkt: Tagi -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Tagi</p><hr style="min-width: 3rem">
			</div>
				<div class="flex-container gap-s">
					<!-- Nowy produkt: Tagi: Kategoria -->
					<div class="flex-container flex-row nowrap">
						<label for="new-product-category" class="flex-1">Kategoria</label>
						<select name="new-product-category" id="new-product-category" class="flex-1">
							<option value=" "> </option>
							<?php
								$sql = 'SELECT * FROM `category`;';
								$result = mysqli_query($conn , $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row['category_id'] . '" ' . ( (!empty($_POST['new-product-category']) && $_POST['new-product-category'] == $row['category_id']) ? 'selected' : '' ) . '>' . $row['name'] . '</option>';
								}
							?>
						</select>
					</div>

					<!-- Nowy produkt: Tagi: Kolor -->
					<div class="flex-container flex-row nowrap">
						<label for="new-product-color" class="flex-1">Kolor</label>
						<select name="new-product-color" id="new-product-color" class="flex-1">
							<option value=" "> </option>
							<?php
								$sql = 'SELECT * FROM `color`;';
								$result = mysqli_query($conn , $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row['color_id'] . '" ' . ( (!empty($_POST['new-product-color']) && $_POST['new-product-color'] == $row['color_id']) ? 'selected' : '' ) . '>' . $row['name'] . '</option>';
								}
							?>
						</select>
					</div>

					<!-- Nowy produkt: Tagi: Rozmiar -->
					<div class="flex-container flex-row nowrap">
						<label for="new-product-size" class="flex-1">Rozmiar</label>
						<select name="new-product-size" id="new-product-size" class="flex-1">
							<option value=" "> </option>
							<?php
								$sql = 'SELECT * FROM `size`;';
								$result = mysqli_query($conn , $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="' . $row['size_id'] . '" ' . ( (!empty($_POST['new-product-size']) && $_POST['new-product-size'] == $row['size_id']) ? 'selected' : '' ) . '>' . $row['name'] . '</option>';
								}
							?>
						</select>
					</div>

				</div>

			<!-- Nowy produkt: Zdjęcia -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Zdjęcia</p><hr style="min-width: 3rem">
			</div>
				<div class="label-input-container flex-container gap-xs">
					<label class="flex-1">Wybierz do trzech zdjęć</label>
					<input type="file" name="new-product-photo[]" id="new-product-photo[]" accept="image/png, image/jpeg, image/webp" multiple>
				</div>

			<!-- Nowy produkt: Dodaj produkt -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0">
				<input type="submit" value="Dodaj produkt" name="new-product-add" style="width: fit-content; cursor: pointer;">
			</div>

		<?php
			if (isset($_POST['new-product-add'])) {
				if (
					isset($_POST['new-product-name']) && $_POST['new-product-name'] != "" &&
					isset($_POST['new-product-description']) && $_POST['new-product-description'] != "" &&
					isset($_POST['new-product-price']) && $_POST['new-product-price'] != "" &&
					isset($_POST['new-product-quantity']) && $_POST['new-product-quantity'] != "" &&
					isset($_POST['new-product-category']) && $_POST['new-product-category'] != " " &&
					isset($_POST['new-product-color']) && $_POST['new-product-color'] != " " &&
					isset($_POST['new-product-size']) && $_POST['new-product-size'] != " "
				) {
					// Dodawanie do bazy danych produktu z formularza
					$sql = 'INSERT INTO `product` (
								category_id, color_id, size_id, name, description, price, quantity) VALUES (
									' . $_POST['new-product-category'] . ',
									' . $_POST['new-product-color'] . ',
									' . $_POST['new-product-size'] . ',
									"' . $_POST['new-product-name'] . '",
									"' . $_POST['new-product-description'] . '",
									' . str_replace(',', '.', $_POST['new-product-price']) . ',
									' . $_POST['new-product-quantity'] . '
								);';

					if (mysqli_query($conn, $sql)) {
						$_POST = [];
						echo '<script> 
								alert("Dodano produkt: ' . $_POST['new-product-name'] . '");
								window.location.href = "panel-sprzedawcy?view=products";
							</script>';
					} else {
						echo '<script> alert("Błąd\n\nWystąpił błąd przy dodawaniu produktu.") </script>';
					} 

					// Start photo if
					if (isset($_FILES['new-product-photo'])) {
						for ($i = 0; $i < count($_FILES['new-product-photo']['name']); $i++) {
							// echo 'Name: ' . $_FILES['new-product-photo']['name'][$i] . '<br>';
							// $f = getimagesize($_FILES['new-product-photo']['tmp_name'][$i]);
							// echo 'Format: ' . $f['mime'] . '<br>';
							// echo 'Size: ' . $_FILES['new-product-photo']['size'][$i] . ' bits<br>';
							
							$savePath = './assets/product/' . $newProductId . '-' . $i . ".webp";
							chmod('./assets/product', 0777);
							if (move_uploaded_file($_FILES['new-product-photo']['tmp_name'][$i], $savePath)) {
							} else {
								echo 'Upload FAIL! <br><br>';
							}
						}
					}
					// End photo if
				} else {
					echo '<script>
							document.addEventListener("DOMContentLoaded", () => {
								setTimeout(() => {
									document.querySelector("[data-modal-target=\"#add-product\"]").click();
								}, 0);
							});
						</script>';
					echo '<p class="error-chmurka">Wymagane wypełnienie wszystkich pól.</p>';

				}
			}
		?>
		</form>
	</div>
</div>

<?php if (isset($_GET['sort'])) { ?>
	<script>
		// Podkreślenie strzałki wybranego sortowania
		document.getElementById("arrow-<?=$_GET['sort']?>") ? document.getElementById("arrow-<?=$_GET['sort']?>").style.opacity = "1" : "";
	</script>
<?php } ?>

<script>

	// Cień nagłówka modala przy przewijaniu
	document.addEventListener("DOMContentLoaded", () => {
		let modal = document.querySelector("#add-product .modal-content");
		let header = document.querySelector("#add-product .modal-header");

		if (modal && header) {
			modal.addEventListener("scroll", () => {
				if (modal.scrollTop >= 40) {
					header.style.boxShadow = "0 -10px 20px #555";
				} else {
					header.style.boxShadow = "none";
				}
			});
		}
	});
</script>