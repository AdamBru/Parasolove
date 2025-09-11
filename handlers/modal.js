document.addEventListener("DOMContentLoaded", () => {
	// Otwieranie modala
	document.querySelectorAll("[data-modal-target]").forEach(button => {
		button.addEventListener("click", () => {
			const modal = document.querySelector(button.dataset.modalTarget);
			openModal(modal);
		});
	});

	// Zamknięcie modala
	document.querySelectorAll("[data-modal-dismiss]").forEach(el => {
		el.addEventListener("click", () => {
			const modal = el.closest(".modal");
			closeModal(modal);
		});
	});

	// Escape key
	document.addEventListener("keydown", e => {
		if (e.key === "Escape") {
			document.querySelectorAll(".modal.visible").forEach(modal => {
				closeModal(modal);
			});
		}
	});
});

function openModal(modal) {
	if (!modal) return;
	modal.classList.add("show");
	document.body.classList.add("modal-open"); // blokuj scroll
	requestAnimationFrame(() => {
		modal.classList.add("visible");
	});
}

function closeModal(modal) {
	if (!modal) return;
	if ( confirm("Czy na pewno chcesz odrzucić zmiany?") ) {
		modal.classList.remove("visible");
		setTimeout(() => {
			modal.classList.remove("show");
			document.body.classList.remove("modal-open"); // odblokuj scroll
		}, 200); // Czas zgodny z CSS transition
	}
}