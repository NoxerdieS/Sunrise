const productAdded = document.querySelector('.nav__user--popup');
const closeBtn = document.querySelector('.closeBtn');

$(document).ready(function () {
	$('.minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$('.plus').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});
});
const productQuantity = document.querySelector('#quantity');
const productId = document.querySelector('#productId');
const productToCart = document.querySelector('#addToCart');

const formData = new FormData();

productToCart.addEventListener('click', () => {
	const formData = new FormData(); 
	formData.append('id', productId.value);
	formData.append('quantity', productQuantity.value);

	fetch('../../php/add_to_cart.php', {
		method: 'POST',
		body: formData,
	}).then(() => {
		productAdded.style.display = 'block';
	});
});
