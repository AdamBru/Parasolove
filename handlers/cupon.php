<?php
	echo 'kod: ' . $_POST['applyCode'];
	echo '<script> console.log("Wpisano kod rabatowy"); </script>';

	if (isset($_POST['applyCode'])) {
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$_SESSION['submitted_code'] = $code;
		$sql = "SELECT * FROM `cupon` WHERE `code` = '$code' AND `active_to` >= CURDATE() LIMIT 1;";
		$result = mysqli_query($conn, $sql);

		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if (is_numeric($row['discount']) && $row['discount'] > 0) {
				$_SESSION['discount'] = $row['discount'];
			} else {
				// Jeżeli rabat nie jest poprawny, usuń rabat
				unset($_SESSION['discount']);
			}
		} else {
			// Nieprawidłowy kod rabatowy
			unset($_SESSION['discount']);
			unset($_SESSION['submitted_code']);
		}


		echo '<script>window.location.href = "' . $_SERVER['REQUEST_URI'] . '";</script>';
		exit;
	}
?>