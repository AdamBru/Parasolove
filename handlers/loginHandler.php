<?php
	function popupResult($resultText, $switchRegister) {
		echo $resultText;
		$echo = ($switchRegister == true) ? "true" : "false";
		echo '<script>popup(' . $echo  . ')</script>';
	}

	// Login Handler
	if ( isset($_POST['login']) ) {
		$loginOutput = login(trim($_POST['login-email']), $_POST['login-password'], $conn);
	}

	function refillLoginForm($email, $password) {
		$_POST['login-password'] = $password;
	}

	function login($email, $password, $conn) {
		if ($email == "") {
			popupResult('Pole adres e-mail nie może być puste.', false);
		} else if ($password == "") {
			popupResult('Pole hasło nie może być puste.', false);
			$_POST['login-email'] = $email;
		} else {
			$passwordHash = sha1(md5($password));

			$sql =  'SELECT `user`.*, `role`.`role_name` FROM `user` JOIN `role` ON `user`.`role_id` = `role`.`role_id` WHERE `email` = "' . $email . '";';
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			
			if ((mysqli_num_rows($result) == 0) || $passwordHash != $row['password_hash']) {
				popupResult('Nieprawidłowe dane logowania.', false);
			} else {
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_role'] = $row['role_name'];
				header('Location: /');
			}
		}
	}

	// Register Handler
	if ( isset($_POST['register']) ) {
		$loginOutput = login(trim($_POST['register-email']), $_POST['register-password'], $_POST['register-repeat-password'], $conn);
	}
	
	function register($email, $password, $repeatPassword, $conn) {
		if ($email == "") {
			popupResult('Pole adres e-mail nie może być puste.', true);
		} else if ($password == "") {
			popupResult('Pole hasło nie może być puste.', true);
		} else if ($repeatPassword == "") {
			popupResult('Pole powtórz hasło nie może być puste.', true);
		} else if ($password != $repeatPassword) {
			popupResult('Hasła nie są takie same.', true);
		} else {
			$passwordHash = sha1(md5($password));

			$sql =  'SELECT `email` FROM `user` WHERE `email` = "' . $email . '";';
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			
			if (mysqli_num_rows($result) > 0) {
				popupResult('Użytkownik o takim adresie e-mail już istnieje.', true);
			} else if ($TODO) {
				////////////////// TODO: warunki złożonośći hasła
				////////////////// TODO: poprawka switchRegister
			} else {
				////////////////// TODO: SQL UPDATE
				header('Location: /');
				echo '<script> alert("Twoje konto zostało utworzone. Możesz się teraz zalogować.") </script>';
			}
		}
	}
?>