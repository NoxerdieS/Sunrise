const promoBtn = document.querySelector('.cart__buySection--promoBtn');
const promocodeBox = document.querySelector('#promobox');
const productsPrice = document.querySelectorAll('.cart__product--price');
const popupCloseBtn = document.querySelector('#closeBtn');
const buyBtn = document.querySelector('.cart__priceSection--buyBtn');
const popup = document.querySelector('.popup');

const changeQuantity = (id, quantity) => {
	console.log('test');
	const formData = new FormData();
	formData.append('id', id);
	formData.append('quantity', quantity);
	fetch('../../php/change_quantity.php', {
		method: 'POST',
		body: formData,
	});
};

$(document).ready(function () {
	$('.minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		var id = $(this).parent().parent().attr('id');
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		changeQuantity(id, count);
	});
	$('.plus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) + 1;
		var id = $(this).parent().parent().attr('id');
		$input.val(count);
		$input.change();
		changeQuantity(id, count);
	});
});

let total = 0;
let i = 0;
const totalPrice = document.querySelector('.price');
productsPrice.forEach((element) => {
	let quantity =
		element.nextElementSibling.firstElementChild.nextElementSibling;
	total += parseFloat(element.innerHTML) * parseFloat(quantity.value);
	i++;
});

const clearCart = document.querySelector('#clearCart');
clearCart.addEventListener('click', () => {
	fetch('../../php/clearCart.php').then(
		window.location.replace(window.location.href)
	);
});

totalPrice.innerHTML = `${total} zł`;
const productCount = document.querySelector('#productCount');
let isPromoCode = 0;
promoBtn.addEventListener('click', () => {
	if (promocodeBox.style.display == 'flex') {
		promocodeBox.style.display = 'none';
		isPromoCode = 0;
	} else {
		isPromoCode = 1;
		promocodeBox.style.display = 'flex';
	}
});
productCount.innerHTML = i;

const removeProductBtns = document.querySelectorAll('.cart__product--delete');
removeProductBtns.forEach((element) => {
	element.addEventListener('click', () => {
		const formData = new FormData();
		formData.append('id', element.parentElement.id);
		fetch('../../php/removeProduct.php', {
			method: 'POST',
			body: formData,
		}).then(window.location.replace(window.location.href));
	});
});

buyBtn.addEventListener('mouseover', () => {
	if(i == 0) {
		buyBtn.setAttribute('href', '#');
	} else {
		buyBtn.setAttribute('href', './login_or_register.php');
	}
})
buyBtn.addEventListener('click', () => {
	if(i == 0) {
		popup.style.display = 'flex';
	} else {
		popup.style.display = 'none';
	}
})



popupCloseBtn.addEventListener('click', () => {
	popup.style.display = 'none';
});
