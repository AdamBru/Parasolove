<?php
	require_once('components/htmlBegin.php');

	if (!isset($_SESSION['order']) || !$_SESSION['order'] == 'success') {
		header('Location: /not-found');
		echo $_SESSION;
	} else if (isset($_SESSION['order']) && $_SESSION['order'] == 'success') {
		unset($_SESSION['order']);
	
	require_once('components/header.php');

	// Zawołanie breadcrumba
	require_once('components/breadcrumb.php');
?>

<script>clearCart()</script>
<div class="page-container align-center justify-center" style="gap: 1rem;">
		<svg style="height: 3rem; margin-bottom: 1rem;" fill="#77bb41" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#77bb41" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 0c-8.836 0-16 7.163-16 16s7.163 16 16 16c8.837 0 16-7.163 16-16s-7.163-16-16-16zM16 30.032c-7.72 0-14-6.312-14-14.032s6.28-14 14-14 14 6.28 14 14-6.28 14.032-14 14.032zM22.386 10.146l-9.388 9.446-4.228-4.227c-0.39-0.39-1.024-0.39-1.415 0s-0.391 1.023 0 1.414l4.95 4.95c0.39 0.39 1.024 0.39 1.415 0 0.045-0.045 0.084-0.094 0.119-0.145l9.962-10.024c0.39-0.39 0.39-1.024 0-1.415s-1.024-0.39-1.415 0z"></path> </g></svg>
		<p style="text-align: center;">Zamówienie zostało złożone do realizacji.</p>
		<a href="/" style="text-decoration: underline;">Strona główna</a>
</div>


<?php
	require_once('components/footer.php');
	require_once('components/htmlEnd.php');
	}
?>