
function modal() {
	let modalWindow = document.getElementById("modal");

	if (modalWindow.style.display == "none") { 			// if hidden - create and show 
		// Create window-sized grayed-out flex container to center and dismiss onclick modal window  
		let modalContainer = document.createElement("div");
		modalContainer.classList.add("modal-container");
		document.body.appendChild(modalContainer);

		modalWindow.style.display = "flex";
	}
	
	// alert with options
	// https://www.w3schools.com/js/tryit.asp?filename=tryjs_confirm


	modalDismiss.onclick = function() {
		modalWindow.style.display = "none";
		document.body.removeChild(modalDismiss);
	};
}