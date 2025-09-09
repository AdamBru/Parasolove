<div class="popup flex-container justify-center align-center flex-column gap-s" id="popup">

	<div class="switch-container">
		<input type="checkbox" id="switch" onclick="check()">
		<label for="switch">
			<p>Logowanie</p>
			<p>Rejestracja</p>
		</label>
	</div>

	<form method="post" id="login-form" class="login-form flex-container flex-column gap-xs">
		<label for="login-email">Adres e-mail</label>
		<input type="email" name="login-email" id="login-email">

		<label for="login-password">Hasło</label>
		<input type="password" name="login-password" id="login-password">
		
		<div class="flex-container justify-center">
			<input type="submit" value="Zaloguj się" name="login">
		</div>
	</form>

	<form method="post" id="register-form" class="login-form flex-container flex-column gap-xs">
		<label for="register-email">Adres e-mail</label>
		<input type="email" name="register-email" id="register-email">

		<label for="register-password">Hasło</label>
		<input type="password" name="register-password" id="register-password">
		
		<label for="register-repeat-password">Powtórz hasło</label>
		<input type="password" name="register-repeat-password" id="register-repeat-password">
		
		<div class="flex-container justify-center">
			<input type="submit" value="Zarejestruj się" name="register">
		</div>
	</form>

	<script>
		// Switch script
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

		// Popup script
		let popupWindow = document.getElementById("popup");
		function popup(switchRegister) {
			// Skrócony zapis if'a:				 warunek ? jeśli prawda to : jeśli fałsz to
			popupWindow.style.display = (popupWindow.style.display == "block") ? "none" : "block";

			if (switchRegister == true) {
				document.getElementById("switch").click();
			}

			let popupDismiss = document.createElement("div");
			document.body.appendChild(popupDismiss);
			popupDismiss.classList.add("popup-dismiss");
			popupDismiss.onclick = function () {
				popupWindow.style.display = "none";
				document.body.removeChild(popupDismiss);
			};

		}
		// for testing
		// popup();
	</script>

	<p style="text-align: center; font-size: .85rem; margin-top: .6rem; height: fit-content; color: #bb6b6b">
		<?php require_once('handlers/loginHandler.php'); ?>
	</p>

</div>