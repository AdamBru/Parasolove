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
			document.querySelector('[data-modal-target="#add-product"]')?.click();
		}, 0);
	});
</script>


<div class="modal" id="add-product">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content flex-1" style="max-width: 450px">
		<h3 class="lato-regular">Utwórz produkt</h3>
		<br>
		<!-------- TODO formularz dodawania produktu -------->
		<form method="post" class="new-product">
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 0 0 .5rem">
				<p style="white-space: nowrap;">Informacje podstawowe</p><hr style="min-width: 3rem">
			</div>
				<div class="flex-container gap-s">
					<div class="label-input-container">
						<label for="new-product-id">ID</label>
						<input type="text" id="new-product-id" disabled>
					</div>
					
					<div class="label-input-container flex-1">
						<label for="new-product-name">Nazwa</label>
						<input type="text" id="new-product-name">
					</div>
				</div>

			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Tagi</p><hr style="min-width: 3rem">
			</div>
		
		
		
			<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0 .5rem">
				<p style="white-space: nowrap;">Zdjęcia</p><hr style="min-width: 3rem">
			</div>
		</form>
		<div class="modal-close" data-modal-dismiss></div>
	</div>
</div>

<script>
	// Podkreślenie strzałki wybranego sortowania
	document.getElementById("arrow-<?=$_GET['sort']?>") ? document.getElementById("arrow-<?=$_GET['sort']?>").style.opacity = "1" : "";
</script>
