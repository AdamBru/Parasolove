<?php
	$title = " - logowanie";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container">
	<div class="flex-container justify-center align-center flex-column">

		<div class="switch-container">
			<input type="checkbox" id="switch" onclick="check()">
			<label for="switch">
				<p>Logowanie</p>
				<p>Rejestracja</p>
			</label>
		</div>

		<form method="post" id="login-form" class="login-form flex-container flex-column gap-xs">
			<label for="login-email">Adres e-mail</label>
			<input type="email" name="login-email" id="email">

			<label for="login-password">Hasło</label>
			<input type="password" name="password" id="login-password">
			
			<div class="flex-container justify-center">
				<input type="submit" value="Zaloguj się">
			</div>
		</form>
		
		<form method="post" id="register-form" class="login-form flex-container flex-column gap-xs">
			<label for="register-email">Adres e-mail</label>
			<input type="email" name="email" id="register-email">

			<label for="register-password">Hasło</label>
			<input type="password" name="password" id="register-password">
			
			<label for="register-repeat-password">Powtórz hasło</label>
			<input type="password" name="password" id="register-repeat-password">
			
			<div class="flex-container justify-center">
				<input type="submit" value="Zarejestruj się">
			</div>
		</form>

		<script>
			let option = document.getElementById("switch");
			let loginForm = document.getElementById("login-form");
			let registerForm = document.getElementById("register-form");
			registerForm.style.display = "none";
			
			function check() {
				if (option.checked == true) {
					loginForm.style.display = "none";
					registerForm.style.display = "block";
				} else {
					loginForm.style.display = "block";
					registerForm.style.display = "none";
				}
			}

			
		</script>

	</div>
</div>

<?php
	require_once('components/htmlEnd.php')
?>