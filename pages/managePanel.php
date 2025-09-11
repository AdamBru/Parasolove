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
			<a href="?view=panel-home" id="view-panel-home" class="link">Panel</a>
			<a href="?view=orders" id="view-orders" class="link">Zamówienia</a>
			<a href="?view=products" id="view-products" class="link">Inwentarz</a>
			<a href="?view=cupons" id="view-cupons" class="link">Kody rabatowe</a>
		</aside>
		
		<?php
			if ( isset($_GET['view']) ) {
				echo '<script> document.getElementById("view-' . $_GET['view']  . '").style.border = "1px solid #777" </script>';
				require_once('components/managePanel/' . $_GET['view'] . '.php');
			} else {
				echo '<script> document.getElementById("view-panel-home").style.border = "1px solid #777" </script>';
				require_once('components/managePanel/panel-home.php');
			}
		?>
		
	</div>
</div>

<script src="handlers/modal.js"></script>

<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>