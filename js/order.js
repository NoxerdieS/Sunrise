const orderBtn = document.querySelector('#orderBtn');
const total = document.querySelector('.price');
const promoBtn = document.querySelector('.cart__buySection--promoBtn');
const invoiceCheckbox = document.querySelector('#invoice');
const invoiceForm = document.querySelector('.order__address--invoceData');
const promocodeBox = document.querySelector('#promobox');
const name = document.querySelector('#name');
const address = document.querySelector('#address-input');
const postcode = document.querySelector('#postcode');
const city = document.querySelector('#city');
const phone = document.querySelector('#phone');
const email = document.querySelector('#email');
const agreement = document.querySelector('#agreement');
let deliveryError = true;
let paymentError = true;
let dataError = true;

promoBtn.addEventListener('click', () => {
	let isPromoCode = 0;
	if (promocodeBox.style.display == 'flex') {
		promocodeBox.style.display = 'none';
		isPromoCode = 0;
	} else {
		isPromoCode = 1;
		promocodeBox.style.display = 'flex';
	}
});

let invoice = 0;
invoiceCheckbox.addEventListener('change', () => {
	if (invoiceForm.style.display == 'flex') {
		invoice = 0;
		invoiceForm.style.display = 'none';
	} else {
		invoice = 1;
		invoiceForm.style.display = 'flex';
	}
});

const validateDeliveryAndPayment = () => {
	const radiosDelivery = document.getElementsByName('delivery');
	const radiosPayment = document.getElementsByName('payment');
	const deliveryErrorParagraph = document.querySelector('.delivery-error');
	const paymentErrorParagraph = document.querySelector('.payment-error');

	let delivery = 0;
	let payment = 0;
	radiosDelivery.forEach((element) => {
		if (!element.checked) {
			delivery++;
		}
	});
	radiosPayment.forEach((element) => {
		if (!element.checked) {
			payment++;
		}
	});

	if (delivery == radiosDelivery.length) {
		deliveryErrorParagraph.style.display = 'block';
		deliveryError = true;
	} else {
		deliveryErrorParagraph.style.display = 'none';
		deliveryError = false;
	}

	if (payment == radiosPayment.length) {
		paymentErrorParagraph.style.display = 'block';
		paymentError = true;
	} else {
		paymentErrorParagraph.style.display = 'none';
		paymentError = false;
	}
};

const dataValidation = () => {
	let notNullInputs = [name, address, postcode, city, email];
	let errors = 0;

	notNullInputs.forEach((el) => {
		if (el.value == '') {
			el.nextElementSibling.style.visibility = 'visible';
			errors++;
		} else {
			el.nextElementSibling.style.visibility = 'hidden';
		}
	});

	if (phone.value.length < 11) {
		phone.nextElementSibling.style.visibility = 'visible';
		errors++;
	} else {
		phone.nextElementSibling.style.visibility = 'hidden';
	}

	const re =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if (re.test(email.value)) {
		email.nextElementSibling.style.visibility = 'hidden';
	} else {
		errors++;
		email.nextElementSibling.style.visibility = 'visible';
	}

	if(!agreement.checked) {
		errors++
		agreement.parentElement.previousElementSibling.style.visibility = 'visible';
	} else {
		agreement.parentElement.previousElementSibling.style.visibility = 'hidden';
	}

	if (errors == 0) {
		dataError = false;
	} else {
		dataError = true;
	}
};

const checkPhoneNumber = () => {
	let value = phone.value;
	value = value.replace(/\D+/g, '');
	if (value.length > 3) {
		value = value.slice(0, 3) + ' ' + value.slice(3);
	}
	if (value.length > 7) {
		value = value.slice(0, 7) + ' ' + value.slice(7);
	}
	if (value.length > 11) {
		value = value.slice(0, 11);
	}
	phone.value = value;
};

const checkPostCodeNumber = () => {
	let value = postcode.value;
	value = value.replace(/\D+/g, '');
	if (value.length > 2) {
		value = value.slice(0, 2) + '-' + value.slice(2);
	}
	if (value.length > 6) {
		value = value.slice(0, 6);
	}
	postcode.value = value;
};

orderBtn.addEventListener('mouseover', () => {
	validateDeliveryAndPayment();
	dataValidation();
	if (deliveryError == true || paymentError == true || dataError == true || !agreement.checked) {
		orderBtn.disabled = true;
	} else {
		orderBtn.disabled = false;
	}
});

const calculateTotal = () => {
    let totalValue = parseFloat(total.innerHTML); // Pobierz sumę produktów
    const selectedDelivery = document.querySelector('input[name="delivery"]:checked');
    const selectedPayment = document.querySelector('input[name="payment"]:checked');

    let deliveryCost = 0;
    let paymentCost = 0;

    if (selectedDelivery) {
        deliveryCost = parseFloat(selectedDelivery.parentElement.nextElementSibling.innerHTML.replace(' zł', ''));
    }

    if (selectedPayment) {
        paymentCost = parseFloat(selectedPayment.parentElement.nextElementSibling?.innerHTML.replace(' zł', '') || 0);
    }

    return totalValue + deliveryCost + paymentCost;
};

orderBtn.addEventListener('click', (e) => {
	orderBtn.disabled = true
	const deliveryForm = document.querySelector('#delivery');
	const addressForm = document.querySelector('#address');
	const invoiceForm = document.querySelector('#invoice');
	const paymentForm = document.querySelector('#payment');
	e.preventDefault();

	const shippingData = new FormData(deliveryForm);

	const addressData = new FormData(addressForm);

	const formData = new FormData();

	const paymentData = new FormData(paymentForm);

	for (var pair of shippingData.entries()) {
		formData.append(pair[0], pair[1]);
	}
	for (var pair of paymentData.entries()) {
		formData.append(pair[0], pair[1]);
	}
	for (var pair of addressData.entries()) {
		formData.append(pair[0], pair[1]);
	}
	formData.append('invoice', invoice);
	if (invoice == 1) {
		const invoiceData = new FormData(invoiceForm);
		for (var pair of invoiceData.entries()) {
			formData.append(pair[0], pair[1]);
		}
	}
	const totalValue = calculateTotal();
	formData.append('total', totalValue);

	fetch('../../php/place_order.php', {
		method: 'POST',
		body: formData,
	})
		.then((res) => {
			return res.text();
		})
		.then((body) => {
			const tempForm = document.createElement('form');
			tempForm.action = './summary.php';
			tempForm.method = 'POST';
			var tempInput = document.createElement('input');
			tempInput.type = 'number';
			tempInput.name = 'order_id';
			tempInput.value = body;

			tempForm.appendChild(tempInput);
			document.body.appendChild(tempForm);
			console.log(body);
			tempForm.submit();
		});
});

phone.addEventListener('input', checkPhoneNumber);
postcode.addEventListener('input', checkPostCodeNumber);
