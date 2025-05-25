const password = document.querySelector('#password');
const password2 = document.querySelector('#password2');
const error = document.querySelector('.error');
const sendBtn = document.querySelector('#change_pass_form_send');
const formData = new FormData();

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const email = urlParams.get('email');
const activationHash = urlParams.get('activationHash');

const checkPassword = (pass1, pass2) => {
	if (pass1.value !== pass2.value) {
		error.style.display = 'block';
	} else {
		error.style.display = 'none';
	}
};

const remember_password = async () => {
	formData.append('email', email);
	formData.append('activationHash', activationHash);
	formData.append('password', password.value);
	fetch('../php/remember_password.php', {
		method: 'POST',
		body: formData,
	})
		.then(function (response) {
			return response.text();
		})
		.then(function (body) {
			location.replace(body);
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
		remember_password();
	}
};

sendBtn.addEventListener('click', (e) => {
	e.preventDefault();
	checkPassword(password, password2);
	checkErrors();
});
