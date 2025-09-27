<header>
	<div class="block"></div>

	<div class="block">
		<a href="/">
			<img src="assets/site-images/parasolove-logo.png" alt="Logo" class="logo">
		</a>
	</div>

	<div class="block header-right">
		<?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "client") { ?>
			<a href="/konto" class="link">Moje konto</a>
			<a href="/wyloguj" class="link">Wyloguj</a>
		<?php } else if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin") { ?>
			<a href="/panel-sprzedawcy" class="link">Panel sprzedawcy</a>
			<a href="/wyloguj" class="link">Wyloguj</a>
		<?php } else { ?>
			<div class="login-wrapper" style="position: relative;">
				<span class="link" onclick="popup()" style="cursor: pointer; user-select: none;">Logowanie</span>
				<?php require_once('components/login.php'); ?>
			</div>
		<?php } ?>

		<a href="/koszyk" class="shopping-bag-icon" id="cart-count"><img src="assets/site-images/shopping-bag.svg" alt="Koszyk" class="icon"></a>
		<script>updateCartCount();</script>
	</div>
</header>

<nav>
	<ul>
		<li><a href="/">Strona główna</a></li>
		<li><a href="/katalog">Wszystkie parasole</a></li>

		<?php
			$sql = "SELECT name FROM `category` LIMIT 3";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)) {
				echo "<li> <a href='/katalog?category=" . $row['name'] . "'> Parasole " . $row['name'] . "</a> </li>";
			} 
		?>
	</ul>
</nav>

<div class="infoPopup flex align-center justify-center flex-column wrap gap-m" id="cookieBox">
	<p>Ta strona zjada ciasteczka.</p>
	<div class="flex flex row no-wrap gap-m">
		<a href="/dokumenty/polityka-prywatności" class="link">Polityka prywatności</a>
		<input type="submit" id="accept-cookie" class="btn flex-0" value="OK" onclick="acceptCookie()" style="padding: .1rem .6rem;">
	</div>
</div>

<script>
	// Cookie
	let cookieBox = document.getElementById("cookieBox");
	
	(localStorage.getItem("cookieAccepted") == "true") ? cookieBox.style.display = "none" : ""; 
	
	function acceptCookie() {
		localStorage.setItem("cookieAccepted", "true");
		cookieBox.style.animation = "slideUp .8s ease-in-out";
		setTimeout(() => {
			cookieBox.style.display = "none";
		}, 800); 
	}
</script>