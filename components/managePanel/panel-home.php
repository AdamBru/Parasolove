<h3>Panel sprzedawcy</h3>

<?php // print_r($_SESSION) ?>

<p></p>
<div class="flex-container justify-center flex-column gap-xs">
	<span>
		Zalogowany użytkownik: &nbsp; 
		<b> <?= mysqli_fetch_assoc( mysqli_query($conn, "SELECT email FROM user WHERE user_id = " . $_SESSION['user_id']) )[ 'email' ];?> </b>
	</span>

	<span>
		Nieukończonych zamówień: &nbsp; 
		<b style="color: tomato;"> 12 <?//= mysqli_fetch_assoc( mysqli_query($conn, "SELECT * FROM orders") )[ '' ];?> </b>
	</span>

	<span>
		Produktów w bazie: &nbsp; 
		<b> <?= mysqli_fetch_assoc( mysqli_query($conn, "SELECT count(*) FROM product") )[ 'count(*)' ];?> </b>
	</span>

	<span>
		Aktywnych kodów rabatowych: &nbsp; 
		<b> <?= mysqli_fetch_assoc( mysqli_query($conn, "SELECT count(*) FROM cupon WHERE " . time() . " - active_to > 0") )[ 'count(*)' ];?> </b>
	</span>
</div>
<p></p>

<div class="flex-container align-center flex-row gap-m">
	<a href="/panel-sprzedawcy?view=orders" class="btn" style="padding: .5rem 1rem">Zamówienia</a>
	<a href="/panel-sprzedawcy?view=products" class="btn" style="padding: .5rem 1rem">Inwentarz</a>
	<a href="/panel-sprzedawcy?view=cupons" class="btn" style="padding: .5rem 1rem">Kody rabatowe</a>
</div>