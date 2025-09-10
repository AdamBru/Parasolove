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