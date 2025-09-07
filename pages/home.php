<?php
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container align-center">

	<div class="flex-container">
		<div class="card">
			<img src="assets/site-images/card-0.webp" alt="Obraz z parasolem">
			<h4>Wiodący producent parasoli</h4>
			<hr>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic enim cumque laboriosam quaerat. </p>
		</div>
		
		<div class="card">
			<img src="assets/site-images/card-1.webp" alt="Obraz z parasolem" style="object-position: 0">
			<h4>Jakość naszym priorytetem</h4>
			<hr>		
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic enim cumque laboriosam quaerat. </p>
		</div>
		
		<div class="card">
			<img src="assets/site-images/card-2.webp" alt="Obraz z parasolem">
			<h4>Gwarancja wytrzymałości</h4>
			<hr>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic enim cumque laboriosam quaerat. </p>
		</div>	
	</div>
	
	<div style="width: 100%;">	
		<hr>
		<h2> Polecane produkty </h2>
		
		<div class="flex-container">

			<!-- skrypt generujący dynamicznie karty z produktami -->
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