const CART_KEY = 'cart';

// Cookie helpers
function setCookie(name, value, days = 365) {
	const expires = new Date(Date.now() + days * 864e5).toUTCString();
	document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
}

function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${encodeURIComponent(name)}=`);
	if (parts.length == 2) return decodeURIComponent(parts.pop().split(';').shift());
	return null;
}

function deleteCookie(name) {
	document.cookie = `${encodeURIComponent(name)}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

// Cart logic
function getCart() {
	try {
		return JSON.parse(getCookie(CART_KEY)) || [];
	} catch (e) {
		return [];
	}
}

function saveCart(cart) {
	setCookie(CART_KEY, JSON.stringify(cart), 7);
	updateCartCount();
}

function addToCart(id, quantity = 1) {
	const cart = getCart();
	const existing = cart.find(item => item.id == id);

	if (existing) {
		existing.quantity += quantity;
	} else {
		cart.push({ id, quantity });
	}

	saveCart(cart);
}

function updateCartItem(id, quantity) {
	let cart = getCart();

	if (quantity <= 0) {
		cart = cart.filter(item => item.id !== id);
	} else {
		cart = cart.map(item =>
			item.id == id ? { ...item, quantity } : item
		);
	}

	saveCart(cart);
}

function removeFromCart(id) {
	const cart = getCart().filter(item => item.id !== id);
	saveCart(cart);
}

function clearCart() {
	deleteCookie(CART_KEY);
	updateCartCount();
}

window.Cart = {
	getCart,
	addToCart,
	updateCartItem,
	removeFromCart,
	clearCart
};

function addToCartWithInput(productId) {
	const input = document.getElementById('add-to-card-mount');
	const quantity = parseInt(input.value);
	let addedItemBox = document.getElementById("addedItemBox");

	if (!isNaN(quantity) && quantity > 0) {
		const cart = Cart.getCart();
		const alreadyInCart = cart.some(item => item.id == productId);

		if (!alreadyInCart) {
			Cart.addToCart(productId, quantity);
			addedItemBox.style.animation = "slideDown .8s ease-in-out";
			addedItemBox.style.display = "flex";
			setTimeout(() => {
				dismissAddedItemBox();
			}, 5000);
		}
	}
	updateCartCount();
}

function dismissAddedItemBox() {
	let addedItemBox = document.getElementById("addedItemBox");
	
	addedItemBox.style.animation = "slideUp .8s ease-in-out";
	setTimeout(() => {
		addedItemBox.style.display = "none";
	}, 800); 
}

function updateCartCount() {
	const cart = Cart.getCart();
	const itemCount = cart.length;

	const cartCountElement = document.getElementById('cart-count');
	if (cartCountElement) {
		cartCountElement.setAttribute('data-count', itemCount);
	}
}
