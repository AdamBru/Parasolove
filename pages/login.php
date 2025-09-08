<?php
	$title = " - logowanie";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container">
	<div class="flex-container justify-center align-center flex-column">

		<form method="post" id="login-from" class="login-form flex-container flex-column gap-xs">
			<label for="email">Adres e-mail</label>
			<input type="email" name="email" id="email">

			<label for="password">Hasło</label>
			<input type="password" name="password" id="password">
			
			<div class="flex-container justify-center">
				<input type="submit" value="Zaloguj się">
			</div>
		</form>
		
		<form method="post" id="register-from" class="login-form flex-container flex-column gap-xs">
			<label for="email">Adres e-mail</label>
			<input type="email" name="email" id="email">

			<label for="password">Hasło</label>
			<input type="password" name="password" id="password">
			
			<label for="password">Powtórz hasło</label>
			<input type="password" name="password" id="password">
			
			<div class="flex-container justify-center">
				<input type="submit" value="Zarejestruj się">
			</div>
		</form>

	</div>
</div>

<?php
	require_once('components/htmlEnd.php')
?>