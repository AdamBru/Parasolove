<button data-modal-target="#add-cupon" class="btn add"> <b style="margin: 0 .2rem">+</b> Utwórz kod</button>


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
				$sql = 'SELECT * FROM `cupon`;';
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
		<p>Utwórz kupon</p>
		<br>
		<!-------- TODO formularz dodawania kuponu -------->
		<p>formularz dodawania kuponu</p>
		<div class="modal-close" data-modal-dismiss></div>
	</div>
</div>

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