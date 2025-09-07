<header>
	<div class="block"></div>

	<div class="block">
		<a href="/">
			<img src="assets/site-images/parasolove-logo.png" alt="Logo" class="logo">
		</a>
	</div>

	<div class="block header-right">
		<!-- Skrypt php: jesli niezalogowany to Logowanie, jesli zalogowany to Moje konto i Wyloguj -->
		<a href="/login" class="link">Logowanie</a>
		<!--------------------------------------------->

		<a href="/koszyk" class="shopping-bag-icon"><img src="assets/site-images/shopping-bag.svg" alt="Koszyk" class="icon"></a>
	</div>
</header>

<nav>
	<ul>
		<li><a href="/">Strona główna</a></li>
		<li><a href="/katalog">Wszystkie parasole</a></li>

		<?php
			$sql = "SELECT name FROM `category`";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)) {
				echo "<li> <a href='/katalog?category=" . $row['name'] . "'> Parasole " . $row['name'] . "</a> </li>";
			} 
		?>
	</ul>
</nav>