<?php
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container">

	<div class="flex-container">
		<aside class="filters">

			<div>
				<p style="font-size: 1.2rem;">Sortowanie</p>
				<select name="sort" id="sort">
					<option value="default">Domyślne</option>
					<option value="price-asc">Cena rosnąco</option>
					<option value="price-desc">Cena malejąco</option>
				</select>
			</div>


			<form method="get">
				<p style="font-size: 1.2rem;">Filtry</p>
				
				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;">Rodzaj</span> <hr style="width: 100%;"> </div>
				<div><input type="radio" name="category" id="wszystkie"> <label for="wszystkie">wszystkie</label> </div>

				<?php
					$sql = "SELECT name FROM `category`";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)) {
						echo '<div> <input type="radio" name="category" id="' . $row["name"] . '"> <label for="' . $row["name"] . '">' . $row["name"] . '</label> </div>';
					}
				?>

				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;">Cena</span> <hr style="width: 100%;"> </div>
				<div class="cena-input">
					<input type="number" name="" id="price-min"> <label for="price-min" style="min-width: fit-content;">zł &mdash;</label>
					<input type="number" name="" id="price-max"></label> <label for="price-max">zł</label>
				</div>

				<div class="flex-container align-center row nowrap" style="gap: .5rem"> <span style="width: fit-content;">Kolor</span> <hr style="width: 100%;"> </div>
				<!-- Skrypt generujący dynamicznie checkboxy z kolorami -->
				<div><input type="checkbox" name="" id=""><label for="">czerwony</label></div>
				<div><input type="checkbox" name="" id=""><label for="">niebieski</label></div>
				<div><input type="checkbox" name="" id=""><label for="">zielony</label></div>
				

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