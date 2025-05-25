const registerButton = document.querySelector('#register_form_send');
const registerForm = document.querySelector('#register_form');
const firstname = document.querySelector('#name-register');
const lastname = document.querySelector('#lastname-register');
const phone = document.querySelector('#phone-register');
const email = document.querySelector('#email-register');
const login = document.querySelector('#login-register');
const password = document.querySelector('#password-register');
const password2 = document.querySelector('#password2-register');
const address = document.querySelector('#address-register');
const postcode = document.querySelector('#postcode-register');
const city = document.querySelector('#city-register');
const popUp = document.querySelector('.register__popup');
const popUpCloseBtn = document.querySelector('.register__popup--closeBtn');
const formData = new FormData();

const showError = (input, name) => {
	const formBox = input.parentElement;
	const errorMsg = formBox.querySelector(`.error-${name}`);
	errorMsg.classList.add('visible');
};

const clearError = (input, name) => {
	const formBox = input.parentElement;
	const errorMsg = formBox.querySelector(`.error-${name}`);
	errorMsg.classList.remove('visible');
};

const checkForm = (input) => {
	input.forEach((el) => {
		if (el.value === '') {
			showError(el, el.name);
		} else {
			clearError(el, el.name);
		}
	});
};

const checkLength = (input, min) => {
	if (input.value.length < min) {
		showError(input, input.name);
	}
};

const checkPassword = (pass1, pass2) => {
	if (pass1.value !== pass2.value) {
		showError(pass2, pass2.name);
	} else {
		clearError(pass2, pass2.name);
	}
};

const checkMail = (email) => {
	const re =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if (re.test(email.value)) {
		clearError(email, email.name);
	} else {
		showError(email, email.name);
	}
};

const checkPhone = (phone) => {
	if (phone.value.length < 11) {
		const formBox = phone.parentElement.parentElement;
		const errorMsg = formBox.querySelector(`.error-${phone.name}`);
		errorMsg.classList.add('visible');
	} else {
		const formBox = phone.parentElement.parentElement;
		const errorMsg = formBox.querySelector(`.error-${phone.name}`);
		errorMsg.classList.remove('visible');
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

const register = async () => {
	let result;
	formData.append('name', firstname.value);
	formData.append('lastname', lastname.value);
	formData.append('email', email.value);
	formData.append('phone', phone.value);
	formData.append('login', login.value);
	formData.append('password', password.value);
	formData.append('address', address.value);
	formData.append('postcode', postcode.value);
	formData.append('city', city.value);

	fetch('../php/register.php', {
		method: 'POST',
		body: formData,
	})
		.then(function (response) {
			return response.text();
		})
		.then(function (body) {
			result = body;
			if (result === 'success') {
				popUp.style.visibility = 'visible';
				registerButton.disabled = true;
			} else if(result === 'Podany login jest już zajęty') {
				const loginError = document.querySelector('.error-login')
				loginError.textContent = 'Podany login jest zajęty'
				loginError.classList.add('visible');
			}
		});
};

const checkErrors = () => {
	const allInputs = document.querySelectorAll('p');
	let errorCount = 0;

	allInputs.forEach((el) => {
		if (el.classList.contains('visible')) {
			errorCount++;
		}
	});

	if (errorCount === 0) {
		register();
	}
};

const closePopUp = () => {
	popUp.style.visibility = 'hidden';
	registerButton.disabled = false;
};

registerButton.addEventListener('click', (e) => {
	e.preventDefault();
	checkForm([
		firstname,
		lastname,
		email,
		login,
		password,
		address,
		postcode,
		city,
	]);
	checkLength(login, 3);
	checkLength(password, 8);
	checkLength(postcode, 6);
	checkPassword(password, password2);
	checkMail(email);
	checkPhone(phone);
	checkErrors();
});

phone.addEventListener('input', checkPhoneNumber);
postcode.addEventListener('input', checkPostCodeNumber);
popUpCloseBtn.addEventListener('click', closePopUp);
