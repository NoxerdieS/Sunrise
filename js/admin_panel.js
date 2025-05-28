const addProductBtn = document.querySelector('.admin__add--addBtn');
const popupCloseBtn = document.querySelector(
	'.admin__contentContainer--closeBtn'
);
const popupShadow = document.querySelector('.admin__popup--shadow');
const popup = document.querySelector('.admin__popup');
const searchBtn = document.querySelector('#searchBtn');
const searchRes = document.querySelectorAll('.admin__product--name');
const adminProducts =
	document.querySelector('.admin__products') ||
	document.querySelector('.admin__categories');
const addForm = document.querySelector('#create-product-form');

// WYSZUKIWANIE
if (searchBtn && adminProducts) {
	searchBtn.addEventListener('click', () => {
		const searchBar = document.querySelector('#searchBar');
		adminProducts.innerHTML = '';

		searchRes.forEach((element) => {
			if (
				element.innerHTML.toLowerCase().includes(searchBar.value.toLowerCase())
			) {
				adminProducts.appendChild(element.parentElement);
			}
		});

		const searchResetBtn = document.createElement('i');
		searchResetBtn.classList.add('fa-solid', 'fa-x');
		searchResetBtn.setAttribute('id', 'resetSearchBtn');
		searchBtn.replaceWith(searchResetBtn);

		searchResetBtn.addEventListener('click', () => {
			searchBar.value = '';
			adminProducts.innerHTML = '';
			searchRes.forEach((element) => {
				adminProducts.appendChild(element.parentElement);
			});
			searchResetBtn.replaceWith(searchBtn);
		});
	});
}

// POPUP OTWARCIE/ZAMKNIĘCIE
if (addProductBtn && popup && popupShadow) {
	addProductBtn.addEventListener('click', () => {
		popup.classList.add('visible');
		popupShadow.classList.add('visible');
	});
}

if (popupCloseBtn && popup && popupShadow) {
	popupCloseBtn.addEventListener('click', () => {
		popup.classList.remove('visible');
		popupShadow.classList.remove('visible');
	});
}

// FORMULARZ DODAWANIA
if (addForm) {
	addForm.addEventListener('submit', (e) => {
		e.preventDefault();

		const formData = new FormData(addForm);
		const filename = formData.get('filename');
		const errors = [];

		if (filename === 'index') {
			const name = document.querySelector('#name')?.value.trim();
			const price = document.querySelector('#price')?.value.trim();
			const description = document.querySelector('#description')?.value.trim();
			const quantity = document.querySelector('#quantity')?.value.trim();
			const image = document.querySelector('#image')?.files[0];

			if (!name) errors.push('Nazwa produktu jest wymagana.');
			if (!price || isNaN(price) || parseFloat(price) <= 0)
				errors.push('Podaj poprawną cenę.');
			if (!description) errors.push('Opis produktu jest wymagany.');
			if (!quantity || isNaN(quantity) || parseInt(quantity) < 0)
				errors.push('Podaj poprawną ilość.');
			if (!image) errors.push('Zdjęcie produktu jest wymagane (.png).');
			else if (!image.name.endsWith('.png'))
				errors.push('Obsługiwany jest tylko format .png.');
		} else if (filename === 'customers') {
			const firstname = document.querySelector('#firstname')?.value.trim();
			const lastname = document.querySelector('#lastname')?.value.trim();
			const email = document.querySelector('#email')?.value.trim();
			const login = document.querySelector('#login')?.value.trim();
			const phone = document.querySelector('#phone')?.value.trim();
			const postcode = document.querySelector('#postcode')?.value.trim();
			const city = document.querySelector('#city')?.value.trim();
			const password = document.querySelector('#password')?.value;
			const password2 = document.querySelector('#password2')?.value;

			if (!firstname) errors.push('Imię jest wymagane.');
			if (!lastname) errors.push('Nazwisko jest wymagane.');
			if (!email || !email.includes('@'))
				errors.push('Podaj poprawny adres e-mail.');
			if (!login) errors.push('Login jest wymagany.');
			if (!phone || isNaN(phone)) errors.push('Podaj poprawny numer telefonu.');
			if (!postcode || !/^\d{2}-\d{3}$/.test(postcode))
				errors.push('Podaj kod pocztowy w formacie 00-000.');
			if (!city) errors.push('Miasto jest wymagane.');

			if (password || password2) {
				if (password !== password2) {
					errors.push('Hasła muszą być identyczne.');
				} else if (password.length < 6) {
					errors.push('Hasło musi mieć co najmniej 6 znaków.');
				}
			}

			const addressIdInput = document.querySelector('input[name="addressId"]');
			if (addressIdInput) {
				formData.append('addressId', addressIdInput.value);
			}
		} else if (filename === 'orders') {
			const orderId = document.querySelector('#order_id')?.value.trim();
			const total = document.querySelector('#total')?.value.trim();
			const shipping = document.querySelector('#shipping')?.value.trim();
			const payment = document.querySelector('#payment')?.value.trim();
			const firstname = document.querySelector('#firstname')?.value.trim();
			const lastname = document.querySelector('#lastname')?.value.trim();
			const email = document.querySelector('#email')?.value.trim();
			const phone = document.querySelector('#phone')?.value.trim();
			const address = document.querySelector('#address')?.value.trim();
			const postcode = document.querySelector('#postcode')?.value.trim();
			const city = document.querySelector('#city')?.value.trim();

			if (!orderId || isNaN(orderId)) errors.push('Błędny numer zamówienia.');
			if (!total || isNaN(total) || parseFloat(total) < 0)
				errors.push('Podaj poprawną wartość zamówienia.');
			if (!shipping) errors.push('Sposób dostawy jest wymagany.');
			if (!payment) errors.push('Sposób płatności jest wymagany.');
			if (!firstname) errors.push('Imię jest wymagane.');
			if (!lastname) errors.push('Nazwisko jest wymagane.');
			if (!email || !email.includes('@'))
				errors.push('Podaj poprawny adres e-mail.');
			if (!phone || isNaN(phone)) errors.push('Podaj poprawny numer telefonu.');
			if (!address) errors.push('Adres jest wymagany.');
			if (!postcode || !/^\d{2}-\d{3}$/.test(postcode))
				errors.push('Kod pocztowy musi być w formacie 00-000.');
			if (!city) errors.push('Miasto jest wymagane.');
		}

		if (errors.length > 0) {
			alert(errors.join('\n'));
			return;
		}

		let target = '../../php/admin_panel/add_item.php';
		if (
			filename === 'customers' &&
			document.querySelector('input[name="oldLogin"]')
		) {
			target = '../../php/admin_panel/edit_customer.php';
		} else if (filename === 'orders') {
			target = '../../php/admin_panel/edit_order.php';
		}

		fetch(target, {
			method: 'POST',
			body: formData,
		})
			.then(() => {
				if (filename === 'customers') {
					window.location.href = '../../html/admin_panel/customers.php';
				} else if (filename === 'orders') {
					window.location.href = '../../html/admin_panel/orders.php';
				} else {
					window.location.reload();
				}
			})
			.catch((err) => {
				alert('Wystąpił błąd podczas zapisu.');
				console.error(err);
			});
	});
}
