<?php
	$title = " - produkt";
	require_once('components/htmlBegin.php');
	require_once('components/header.php');
?>

<div class="page-container">

	<div class="flex-container">

		<?php
			$getProducts = getProducts($conn, $sort = 'default', false, true);
			$products = $getProducts['products'];
		
		?>


	</div>

</div>



<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
?>