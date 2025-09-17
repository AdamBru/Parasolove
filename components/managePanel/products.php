<button data-modal-target="#add-product" class="btn add"> <b style="margin: 0 .2rem">+</b> Utwórz produkt</button>

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
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
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
				Cena <div class="arrow-container"> 
							<a href="?view=products&sort=price-asc" id="arrow-price-asc" class="arrow"></a> 
							<a href="?view=products&sort=price-desc" id="arrow-price-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th> <div class="flex-container flex-row nowrap justify-center align-center gap-s">
				Liczba szt. <div class="arrow-container"> 
							<a href="?view=products&sort=quantity-asc" id="arrow-quantity-asc" class="arrow"></a> 
							<a href="?view=products&sort=quantity-desc" id="arrow-quantity-desc" class="arrow down"></a> 
						</div> 
					</div> </th>
				<th>Edytuj</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sort = $_GET['sort'] ?? 'default';
				foreach (getProducts($conn, $sort) as $product) {
					for ($i = 0; $i <= 15; $i++) {
					echo '<tr>
							<td>' . $product['pro_product_id'] . '</td>
							<td class="td-img">' . getProductImage($product['pro_product_id'], 0) . '</td>
							<td>' . textTooLong($product['pro_name'], 45) . '</td>
							<td>' . $product['cat_name'] . '</td>
							<td class="td-color"> <label class="color-checkbox-label" style="background: ' . $product['col_hex_code'] . '; cursor: auto;"></label> </td>
							<td>' . $product['pro_price'] . ' zł</td>
							<td>' . $product['pro_quantity'] . '</td>
							<td><span data-modal-target="#edit-product-' . $product['pro_product_id'] . '" class="edit"></span></td>
						</tr>';

					//TODO: Modal: edytuj produkt #edit-product-ID
					echo '
						<div class="modal" id="edit-product-' . $product['pro_product_id'] . '">
							<div class="modal-bg" data-modal-dismiss></div>
							<div class="modal-content">
								<p style="margin-right: 3rem;">Edytuj produkt <span class="lato-bold">' . $product['pro_name'] .'</span></p>
								<br>
						<!-------- TODO formularz edytowania produktu -------->
								<p>formularz edytowania produktu</p>
								<div class="modal-close" data-modal-dismiss></div>
							</div>
						</div>';
					}
				}
				?>
		</tbody>
	</table>
</div>

<script>
	// FOR DEVELOPMENT
	document.addEventListener("DOMContentLoaded", () => {
		setTimeout(() => {
			document.querySelector('[data-modal-target="#add-product"]').click();
		}, 0);
	});
</script>


<div class="modal" id="add-product">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content flex-1">
		<div class="modal-header">
			<div class="modal-close" data-modal-dismiss></div>
			<h3 class="lato-regular">Utwórz produkt</h3>
		</div>
		
		<!-------- TODO formularz dodawania produktu -------->
		<form method="post" class="new-product" style="margin: 1.5rem">
			<!-- Nowy produkt: Informacje podstawowe -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 0 0 .5rem">
				<p style="white-space: nowrap;">Informacje podstawowe</p><hr style="min-width: 3rem">
			</div>
				<div class="flex-container gap-s">
					<!-- Nowy produkt: Informacje podstawowe: ID i Nazwa -->
					<div class="flex-container gap-s">
						<div class="label-input-container">
							<label for="new-product-id">ID</label>
							<input type="text" name="new-product-id" id="new-product-id" disabled>
						</div>
						<div class="label-input-container flex-1">
							<label for="new-product-name">Nazwa</label>
							<input type="text" name="new-product-name" id="new-product-name">
						</div>
					</div>
					
					<!-- Nowy produkt: Informacje podstawowe: Opis -->
					<div class="flex-container gap-s">
						<div class="label-input-container flex-1">
							<label for="new-product-description">Opis</label>
							<textarea type="text" class="" name="new-product-description" id="new-product-description"></textarea>
						</div>
					</div>

					<!-- Nowy produkt: Informacje podstawowe: Cena i Liczba sztuk -->
					<div class="flex-container gap-s">
						<div class="label-input-container flex-1">
							<label for="new-product-id">Cena</label>
							<input type="text" name="new-product-price" id="new-product-price">
						</div>
						<div class="label-input-container flex-1">
							<label for="new-product-name">Lizcba sztuk</label>
							<input type="text" name="new-product-quantity" id="new-product-quantity">
						</div>
					</div>
				</div>

			<!-- Nowy produkt: Tagi -->
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Tagi</p><hr style="min-width: 3rem">
			</div>
				<div class="flex-container gap-xs">
					<!-- Nowy produkt: Tagi: Kategoria -->
					<div class="flex-container">
						<label for="new-product-category">Kategoria</label>
						<select name="new-product-category" id="new-product-category">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!-- Nowy produkt: Tagi: Kolor -->
					<div class="flex-container">
						<label for="new-product-color">Kolor</label>
						<select name="new-product-color" id="new-product-color">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!-- Nowy produkt: Tagi: Rozmiar -->
					<div class="flex-container">
						<label for="new-product-size">Rozmiar</label>
						<select name="new-product-size" id="new-product-size">
							<option value="1">cat 1</option>
							<option value="2">cat 2</option>
							<option value="3">cat 3</option>
						</select>
					</div>

				</div>
		
		
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Zdjęcia</p><hr style="min-width: 3rem">
			</div>
		</form>
	</div>
</div>

<script>
	// Podkreślenie strzałki wybranego sortowania
	document.getElementById("arrow-<?=$_GET['sort']?>") ? document.getElementById("arrow-<?=$_GET['sort']?>").style.opacity = "1" : "";

	// Cień nagłówka modala przy przewijaniu
	document.addEventListener("DOMContentLoaded", () => {
		const modal = document.querySelector("#add-product .modal-content");
		const header = document.querySelector("#add-product .modal-header");

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
<!-- <script>
	let modalContainer = document.querySelector(".modal-content");
	modalContainer.onscroll = function() {
		console.log(modalContainer); // sprawdź czy istnieje
		if (modalContainer.scrollTop > 50) {
			modalContainer.style.background = "tomato";
			console.log(modalContainer.scrollTop);
		} else {
			modalContainer.style.background = "#fff";
		}
	}
</script> -->

	<!-- <script>
		let modalContainer = document.querySelector(".modal-content");
		let modalHeader = document.querySelector(".modal-header");

		if (modalContainer) {
			modalContainer.addEventListener("scroll", () => {
				consol.log(' znaleziono modala');
				if (modalContainer.scrollTop >= 40) {
					modalHeader.style.boxShadow = "0 0 15px #777";
				} else {
					modalHeader.style.boxShadow = "";
				}
			});
		} else {
			consol.log('nie znaleziono modala');
		}
	</script> -->
<!-- 
<script>
window.onload =  function() {
	let modalContainer = document.querySelector(".modal-content");

	if (modalContainer) {
		modalContainer.onscroll = function () {
			console.log("scrollTop:", modalContainer.scrollTop); // czy działa?

			if (modalContainer.scrollTop > 50) {
				modalContainer.style.background = "tomato";
			} else {
				modalContainer.style.background = "#fff";
			}
		};
	}
};
</script> -->
