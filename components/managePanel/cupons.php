<div class="flex-container align-center flex-row nowrap gap-s">
	<button data-modal-target="#add-cupon" class="btn add"> <b style="margin: 0 .2rem">+</b> Utwórz kod</button>
	<div style="width: 1.5rem; height: .5rem; margin: .5rem 0 .5rem 1rem; background: #f8fe3875; border: 1px solid #ccc;"></div> -&nbsp; kod nieaktywny
</div>


<div class="table-container flex-1">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Kod</th>
				<th>Rabat</th>
				<th>Data ważności</th>
				<th>Edytuj</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = 'SELECT * FROM `cupon` ORDER BY `cupon_id` DESC;';
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					if (time() - strtotime($row['active_to']) > 0) {
						echo '<tr style="background: #f8fe3875">';
					} else {
						echo '<tr>';
					}
					
					echo '	<td>' . $row['cupon_id'] . '</td>
							<td>' . $row['code'] . '</td>
							<td>' . $row['discount'] . '% </td>
							<td>' . $row['active_to'] . '</td>
							<td><span data-modal-target="#edit-cupon-' . $row['cupon_id'] . '" class="edit"></span></td>
						</tr>
					';
				}
			?>
		</tbody>
	</table>
</div>
	
<div class="modal" id="add-cupon">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content">
		<p>Nowy kod rabatowy</p>
		<br>
		<form method="post" class="" autocomplete="off" style="height: fit-content;">
			<div class="flex-container flex-column gap-s">
				<div class="label-input-container">
					<label for="new-cupon-name">Kod</label>
					<input type="text" name="new-cupon-name" id="new-cupon-name" <?=(isset($_POST['new-cupon-name'])) ? 'value="' . $_POST['new-cupon-name'] . '"' : ''?> style="padding: .2rem .3rem;">
				</div>
				<div class="label-input-container">
					<label for="new-cupon-discount">Zniżka</label>
					<div class="flex-container flex-row nowrap " style="gap: 0;">
						<input type="number" name="new-cupon-discount" id="new-cupon-discount" <?=(isset($_POST['new-cupon-discount'])) ? 'value="' . $_POST['new-cupon-discount'] . '"' : ''?> style="padding: .2rem .3rem;">
						<span style="height: 100%; font-size: 1.26rem; border: 1px solid #ccc; padding: 0 .5rem; border-left: none;">%</span>
					</div>
				</div>
				<div class="label-input-container">
					<label for="new-cupon-date">Ważny do</label>
					<input type="date" name="new-cupon-date" id="new-cupon-date" <?=(isset($_POST['new-cupon-date'])) ? 'value="' . $_POST['new-cupon-date'] . '"' : ''?> style="padding: .2rem .3rem;">
				</div>
				<div class="flex-container justify-center align-center flex-row nowrap gap-s" style="margin: 1rem 0">
					<input type="submit" value="Dodaj kod rabatowy" name="new-cupon-add" style="width: fit-content; cursor: pointer;">
				</div>
			</div>
		</form>
		<div class="modal-close" data-modal-dismiss></div>
	</div>
</div>

<?php
	if (isset($_POST['new-cupon-add'])) {
		if ( isset($_POST['new-cupon-name']) && $_POST['new-cupon-name'] != "" && 
			 isset($_POST['new-cupon-discount']) && $_POST['new-cupon-discount'] != "" && 
			 isset($_POST['new-cupon-date']) && $_POST['new-cupon-date'] != "" ) {
			
			if ($_POST['new-cupon-discount'] < 1 || $_POST['new-cupon-discount'] > 99) {
				echo '<script>
						document.addEventListener("DOMContentLoaded", () => {
							setTimeout(() => {
								document.querySelector("[data-modal-target=\"#add-cupon\"]").click();
							}, 0);
						});
					</script>';
				echo '<p class="error-chmurka" style="z-index: 6;">Wartość znżki musi być w zakresie 1-99.</p>';
			} else {
				$sql = 'INSERT INTO `cupon` VALUES (NULL, "' .  $_POST['new-cupon-name'] . '", ' .  $_POST['new-cupon-discount'] . ', "' .  $_POST['new-cupon-date'] . '");';
				if (mysqli_query($conn, $sql)) {
					echo '<script> 
					alert("Dodano kod rabatowy: ' . $_POST['new-cupon-name'] . '");
					window.location.href = "panel-sprzedawcy?view=cupons";
					</script>';
					$_POST = [];
				} else {
					echo '<script> alert("Błąd\n\nWystąpił błąd przy dodawaniu kodu rabatowego.") </script>';
				}
			}
		} else {
			echo '<script>
					document.addEventListener("DOMContentLoaded", () => {
						setTimeout(() => {
							document.querySelector("[data-modal-target=\"#add-cupon\"]").click();
						}, 0);
					});
				</script>';
			echo '<p class="error-chmurka" style="z-index: 6;">Wymagane wypełnienie wszystkich pól.</p>';
		}
	}
?>


<div class="modal" id="edit-cupon-1">
	<div class="modal-bg" data-modal-dismiss></div>
	<div class="modal-content">
		<p>Edytuj kupon</p>
		<br>
		<!-------- TODO formularz edycji kuponu -------->
		<p>formularz edycji kuponu</p>
		<div class="modal-close" data-modal-dismiss></div>
	</div>
</div>