<?php
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container align-center">

	<div class="flex-container" style="align-items: start;">
		<div class="card">
			<img src="assets/site-images/card-0.webp" alt="Obraz z parasolem">
			<h4>Wiodący producent parasoli</h4>
			<hr>
			<p>Od lat specjalizujemy się w produkcji niezawodnych parasoli, które łączą funkcjonalność z estetyką. <br> Nasze produkty chronią przed deszczem <br> i słońcem na całym świecie.</p>
		</div>
		
		<div class="card">
			<img src="assets/site-images/card-1.webp" alt="Obraz z parasolem" style="object-position: 0">
			<h4>Jakość naszym priorytetem</h4>
			<hr>		
			<p>Każdy parasol przechodzi dokładną kontrolę jakości, zanim trafi <br> do Twoich rąk. <br> Dbamy o każdy detal – od materiału po mechanizm otwierania.</p>
		</div>
		
		<div class="card">
			<img src="assets/site-images/card-2.webp" alt="Obraz z parasolem">
			<h4>Gwarancja wytrzymałości</h4>
			<hr>
			<p>Nasze parasole są tworzone z myślą o długotrwałym użytkowaniu, <br> nawet w najtrudniejszych warunkach. <br> Wytrzymałość to nie obietnica –<br>– to standard.</p>
		</div>	
	</div>
	
	<div style="width: 100%;">	
		<hr>
		<h2> Polecane produkty </h2>
		
		<div class="flex-container" style="position: relative;">

			<!-- Skrypt generujący dynamicznie karty z produktami -->
			<a href="" class="product-card">
				<!-- <img src="https://images.panda.org/assets/images/downloads/Feb2019/WWF_wallpaper_Feb2019_1440x900.jpg" alt=""> -->
				<img src="https://printexpress.pl/wp-content/uploads/2024/03/mo2168-03.jpg" alt="Prasol klasyczny">
				<hr>
				<h5>Parasol klasyczny</h5>
				<p>49.99 zł</p>
			</a>

			<a href="" class="product-card">
				<!-- <img src="https://images.panda.org/assets/images/downloads/Jan2019/WWF_wallpaper_Jan2019_1440x900.jpg" alt=""> -->
				<img src="https://i5.walmartimages.com/seo/Wildkin-Kids-Umbrella-for-Boys-and-Girls-Jurassic-Dinosaurs-Blue_e109964d-d583-4786-941c-2bb54be411e1.840aa997f2ba89b61a5879bc239d652b.jpeg" alt="Parasol dinozaur">
				<hr>
				<h5>Parasol dinozaur</h5>
				<p>39.99 zł</p>
			</a>

			<a href="" class="product-card">
				<!-- <img src="https://img.freepik.com/free-photo/closeup-scarlet-macaw-from-side-view-scarlet-macaw-closeup-head_488145-3540.jpg?semt=ais_hybrid&w=740&q=80" alt=""> -->
				<img src="https://printexpress.pl/wp-content/uploads/2024/03/mo8326-22.jpg" alt="Parasol transparentny">
				<hr>
				<h5>Parasol transparentny</h5>
				<p>75.99 zł</p>
			</a>
			<!------------------------------------------------------>

			<div class="see-more justify-center align-center"> <a href="/katalog" class="link">Zobacz więcej</a> </div>
		</div>
	</div>

</div>



<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>