<?php
	$title = " - katalog";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container">

	<div class="flex-container">
		<aside class="filters" style="user-select: none;">

			<div>
				<p style="font-size: 1.2rem;">Sortowanie</p>
				<form method="get" name="sort">
					<select name="sort" id="sort" onchange="this.form.submit()">
						<?php $sort = $_GET['sort'] ?? 'default'; ?>
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
					<div><input type="radio" name="category" id="wszystkie" value="wszystkie" checked> <label for="wszystkie">wszystkie</label> </div>
					<?php
						$sql = "SELECT name FROM `category`";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)) {
							echo '<div> <input type="radio" name="category" id="' . $row["name"] . '" value="' . $row["name"] . '"> <label for="' . $row["name"] . '">' . $row["name"] . '</label> </div>';
						}
					?>

				<!-- Cena -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Cena </span> <hr> </div>
					<div class="cena-input">
						<input type="number" name="price-min" id="price-min" value="" style="margin-left: 0;"> <label for="price-min" style="min-width: fit-content;">zł &nbsp;&mdash;</label>
						<input type="number" name="price-max" id="price-max" value=""></label> <label for="price-max">zł</label>
					</div>

				<!-- Kolor -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Kolor </span> <hr> </div>
					<div class="flex-container row" style="gap: .8rem">
						<?php
							$sql = "SELECT name, hex_code FROM `color`";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)) {
								echo '<label title="' . $row["name"] . '" value="' . $row["name"] . '" for="' . $row["name"] . '" class="color-checkbox-label" style="background: ' . $row["hex_code"] . '"></label> <input type="checkbox" name="color" id="' . $row["name"] . '" class="color-checkbox">';
							}
						?>
					</div>
						
				<!-- Rozmiar -->
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;"> Rozmiar </span> <hr> </div>
					<?php
						$sql = "SELECT name FROM `size`";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)) {
							echo '<div> <input type="checkbox" name="size" value="' . $row["name"] . '" id="' . $row["name"] . '"> <label for="' . $row["name"] . '">' . $row["name"] . '</label> </div>';
						}
					?>
				

				<input type="submit" value="Filtruj" class="btn">
			</form>
		</aside>	
	
		
		<div class="flex-container flex-1" style="gap: 1rem;">
			<!-- Dynamicznie generowana lista produktów -->
			<?php
				$data = getProducts($conn, $sort, true);
				$products = $data['products'];
				$currentPage = $data['pagination']['currentPage'];
				$totalPages = $data['pagination']['totalPages'];

				foreach ($products as $product) {
					echo '<a href="/produkt?id=' . $product['pro_product_id'] . '" class="product-card">
							'. getProductImage($product['pro_product_id']) .'
							<hr>
							<h4>' . $product['pro_name'] . '</h4>
							<p>' . $product['pro_price'] . ' zł</p>
						</a>';
				}
			?>

			<!-- Paginacja -->
			<div class="flex-container align-center justify-center nowrap" style="gap: 1.75rem; margin-top: 2rem;">
				<a href="<?= ($currentPage > 1) ? '?page=' . $currentPage - 1 : '' ?>">&lt;</a>

				<!-- Numery stron -->
				<?php for ($i = 1; $i <= $totalPages; $i++) { ?>
					<a href="?page=<?= $i ?>" <?= ($i == $currentPage) ? 'class="pagination-active"' : '' ?>> <?= $i ?> </a>
				<?php } ?>

				<a href="<?= ($currentPage < $totalPages) ? '?page=' . $currentPage + 1 : '' ?>">&gt;</a>
			</div>

	
		</div>

	</div>

</div>



<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>