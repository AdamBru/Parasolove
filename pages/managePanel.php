<?php
	require_once('components/htmlBegin.php');
	
	if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
		header('Location: /not-found');
	}
		
	$title = " - panel sprzedawcy";
	require_once('components/header.php');
?>

<div class="page-container">
	<div class="flex-container">

		<aside class="page-options gap-s">
			<input type="radio" name="panel-option" id="panel-option-panel" checked>
			<label class="link" for="panel-option-panel">Panel</label>
			
			<input type="radio" name="panel-option" id="panel-option-orders">
			<label class="link" for="panel-option-orders">Zamówienia</label>
			
			<input type="radio" name="panel-option" id="panel-option-products">
			<label class="link" for="panel-option-products">Inwentarz</label>
			
			<input type="radio" name="panel-option" id="panel-option-cupons">
			<label class="link" for="panel-option-cupons">Kody rabatowe</label>
		</aside>
		
		
	</div>
</div>

<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>