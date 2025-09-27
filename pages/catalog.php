<?php
	$title = " - katalog";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<div class="page-container">

	<div class="flex-container mobile-aside-catalog-gap">
		<aside class="filters" style="user-select: none;">

			<div>
				<form method="get" name="sort">
					<p style="font-size: 1.2rem;">Sortowanie</p>
					<?php 
						foreach ($_GET as $key => $value) {
							if ($key == 'sort' || $key == 'page') continue; 

							if (is_array($value)) {
								foreach ($value as $val) {
									echo '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($val) . '">';
								}
							} else {
								echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
							}
						}

						$sort = $_GET['sort'] ?? 'default'; 
					?>
					<select name="sort" id="sort" onchange="this.form.submit()">
						<option value="default" <?= $sort == 'default' ? 'selected' : ''?>>Domyślne</option>
						<option value="price-asc" <?= $sort == 'price-asc' ? 'selected' : ''?>>Cena rosnąco</option>
						<option value="price-desc" <?= $sort == 'price-desc' ? 'selected' : ''?>>Cena malejąco</option>
					</select>
				</form>
			</div>

			<!-- Filtry -->
			<form method="get">
				<p style="font-size: 1.2rem;">Filtry</p>
				
				<!-- Rodzaj -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Rodzaj </span> <hr> </div>
					<div class="styled-radio"><input type="radio" name="category" id="wszystkie" value="wszystkie" checked> <label for="wszystkie">Wszystkie</label> </div>
					<?php
						$sql = "SELECT name FROM `category`";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)) {
							echo '<div class="styled-radio"> <input type="radio" name="category" id="' . $row["name"] . '" value="' . $row["name"] . '" ' .
								((isset($_GET['category']) && $row["name"] == $_GET['category']) ? "checked" : "")
							. '> <label for="' . $row["name"] . '">' . ucfirst($row["name"]) . '</label> </div>';
						}
					?>

				<!-- Cena -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Cena </span> <hr> </div>
					<div class="cena-input">
						<input type="number" name="price-min" id="price-min" value="<?= ( isset($_GET['price-min']) && is_numeric($_GET['price-min']) && ($_GET['price-min']) != '' ) ? $_GET['price-min'] : '0' ?>" style="margin-left: 0;"> <label for="price-min" style="min-width: fit-content;">zł &nbsp;&mdash;</label>
						<input type="number" name="price-max" id="price-max" value="<?= ( isset($_GET['price-max']) && is_numeric($_GET['price-max']) && ($_GET['price-max']) != '' ) ? $_GET['price-max'] : ceil(mysqli_fetch_array(mysqli_query($conn, 'SELECT MAX(price) FROM product;'))[0]) ?>"> <label for="price-max">zł</label>
					</div>

				<!-- Kolor -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Kolor </span> <hr> </div>
					<div class="flex-container row" style="gap: .8rem">
						<?php
							$sql = "SELECT name, hex_code FROM `color`";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)) {
								$checked = (isset($_GET['color']) && is_array($_GET['color']) && in_array($row['name'], $_GET['color'])) ? 'checked' : '';
								echo '<label title="' . $row["name"] . '" for="' . $row["name"] . '" class="color-checkbox-label" style="background: ' . $row["hex_code"] . '"></label> 
									  <input type="checkbox" name="color[]" value="' . $row["name"] . '" id="' . $row["name"] . '" class="color-checkbox"' . $checked . '>';
							}
						?>
					</div>
						
				<!-- Rozmiar -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Rozmiar </span> <hr> </div>
					<?php
						$sql = "SELECT name FROM `size`";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)) {
							$checked = (isset($_GET['size']) && is_array($_GET['size']) && in_array($row['name'], $_GET['size'])) ? 'checked' : '';
							echo '<div class="styled-checkbox"> 
									<input type="checkbox" name="size[]" value="' . $row["name"] . '" id="' . $row["name"] . '"' . $checked . '> 
									<label for="' . $row["name"] . '">' . $row["name"] . '</label> 
								</div>';
						}
					?>
				

				<input type="submit" value="Filtruj" class="btn">
			</form>
		</aside>	
	
		
		<div class="flex-container flex-1 mobile-catalog" style="gap: 1rem;">
			<!-- Dynamicznie generowana lista produktów -->
			<?php
				$getProducts = getProducts($conn, $sort, true, false);
				$products = $getProducts['products'];
				$currentPage = $getProducts['pagination']['currentPage'];
				$totalPages = $getProducts['pagination']['totalPages'];

				foreach ($products as $product) {
					echo '<a href="/produkt?id=' . $product['pro_product_id'] . '" class="product-card">
							'. getProductImage($product['pro_product_id'], 0, $product['pro_color_id']) .'
							<hr>
							<h4>' . $product['pro_name'] . '</h4>
							<p>' . $product['pro_price'] . ' zł</p>
						</a>';
				}
			?>

			<!-- Paginacja -->
			<div class="flex-container align-center justify-center nowrap" id="pagination-container" style="gap: 1.75rem; margin-top: 2rem;">
				<?php
					$getParams = $_GET;
					unset($getParams['page']); 
					$queryStringBase = http_build_query($getParams);
					$queryStringBase = $queryStringBase ? $queryStringBase . '&' : '';
				?>

				<a href="<?= ($currentPage > 1) ? '?' . $queryStringBase . 'page=' . ($currentPage - 1) : '#' ?>">&lt;</a>

				<!-- Numery stron -->
				<?php for ($i = 1; $i <= $totalPages; $i++) { ?>
					<a href="?<?= $queryStringBase . 'page=' . $i ?>" <?= ($i == $currentPage) ? 'class="pagination-active"' : '' ?>> <?= $i ?> </a>
				<?php } ?>

				<a href="<?= ($currentPage < $totalPages) ? '?' . $queryStringBase . 'page=' . ($currentPage + 1) : '#' ?>">&gt;</a>
			</div>


	
		</div>

	</div>

</div>

<script>
	// Dopisisywanie filtrów do GET zamiast nadpisywania
	document.getElementById('filtr-form').addEventListener('submit', function(e) {
		e.preventDefault(); 

		const form = e.target;
		const formData = new FormData(form);
		const currentParams = new URLSearchParams(window.location.search);

		for (const [key, value] of formData.entries()) {
			if (value !== '') {
				currentParams.append(key, value);
			}
		}

		window.location.search = currentParams.toString();
	});
</script>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>