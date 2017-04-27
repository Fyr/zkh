function getCart() {
	return json_decode($.cookie('cart') || '{}');
}

function setCart(cart) {
	$.cookie('cart', json_encode(cart), {expires: 7, path: '/'});
}

function cartAdd(type, id) {
	var cart = getCart();
	if (!cart[type]) {
		cart[type] = [];
	}
	cart[type].push(id);
	setCart(cart);
}

function cartDel(type, id) {
	var cart = getCart();
	if (!cart[type]) {
		cart[type] = [];
	}

	var a = [];
	for(var i = 0 ; i < cart[type].length; i++) {
		if (cart[type][i] != id) {
			a.push(cart[type][i]);
		}
	}
	cart[type] = a;
	setCart(cart);
}

function inCart(type, id) {
	var cart = getCart();
	if (cart[type]) {
		return in_array(id, cart[type]);
	}
	return false;
}