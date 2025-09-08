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
				<select name="sort" id="sort">
					<option value="default">Domyślne</option>
					<option value="price-asc">Cena rosnąco</option>
					<option value="price-desc">Cena malejąco</option>
				</select>
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
	
		
		<!-- Dynamicznie generowana lista produktów -->
		<div class="flex-container flex-1" style="gap: 1rem;">
			<!-- skrypt generujący dynamicznie karty z produktami -->
			<a href="/product?id=1" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>

			<a href="" class="product-card">
				<img src="https://placehold.co/400" alt="">
				<hr>
				<h5>Nazwa produktu</h5>
				<p>cena</p>
			</a>
			<!------------------------------------------------------>
	
		</div>

	</div>

</div>



<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>