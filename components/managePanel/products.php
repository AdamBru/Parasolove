<button data-modal-target="#add-product" class="btn add"> <b style="margin: 0 .2rem">+</b> Utwórz produkt</button>

<div class="table-container flex-1">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th></th>
				<th>Nazwa</th>
				<th>Kategoria</th>
				<th>Kolor</th>
				<th>Cena</th>
				<th>Liczba szt.</th>
				<th>Edytuj</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// TODO: sortowanie tabeli
				$sortBy;
				
				$sql = 'SELECT
							pro.product_id 		AS pro_product_id, 
							pro.category_id 	AS pro_category_id, 
							pro.color_id 		AS pro_color_id,
							pro.size_id 		AS pro_size_id,
							pro.name 			AS pro_name,
							pro.description 	AS pro_description,
							pro.price 			AS pro_price,
							pro.quantity 		AS pro_quantity,
							pro.is_archived 	AS p_is_archived,
							category.name 		AS cat_name,
							color.name 			AS col_name,
							color.hex_code		AS col_hex_code,
							size.name 			AS siz_name
						FROM product pro 
						JOIN category ON pro.category_Id = category.category_Id 
						JOIN color ON pro.color_Id = color.color_Id
						JOIN size ON pro.size_Id = size.size_Id;';
				$result = mysqli_query($conn, $sql);
				// for ($i = 0; $i <= 15; $i++) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr>
						<td>' . $row['pro_product_id'] . '</td>
						<td>' . '<img src="https://placehold.co/40">' . '</td>
						<td>' . $row['pro_name'] . '</td>
						<td> <label style="background: #333333">LABEL</label>' . $row['cat_name'] . '</td>
						<td> <label class="color-checkbox-label" style="background: #333333; top: -.4rem; cursor: auto;"></label> </td>
						<td>' . $row['pro_price'] . ' zł</td>
						<td>' . $row['pro_quantity'] . '</td>
						<td><span data-modal-target="#edit-product-' . $row['id'] . '" class="edit"></span></td>
						</tr>';
					}
				// }
			?>
			<!-- <tr><td>1</td><td> <img src="https://placehold.co/40"> Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr>
			<tr><td>1</td><td>Elegancki parasol</td><td>79,99</td><td>115</td><td><span data-modal-target="#edit-product-1" class="edit"></span></td></tr> -->
		</tbody>
	</table>
</div>

<div class="modal" id="add-product">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content">
		<p>Utwórz produkt</p>
		<br>
		<!-------- TODO formularz dodawania produktu -------->
		<p>formularz dodawania produktu</p>
		<div class="modal-close" data-modal-dismiss></div>
	</div>
</div>