let result;
const loginForm = document.querySelector('#login_form');
const rememberMe = document.querySelector('#remember');
$loginCookie = document.cookie.split("; ").find((row) => row.startsWith("sunriseLogin="));
if($loginCookie != undefined){
	$loginCookie = $loginCookie.split("=")[1];
}else{
	$loginCookie = '';
}
if($loginCookie != ''){
	loginForm.elements['login'].value = $loginCookie;
	rememberMe.checked = true;
}
const login = async (e) => {
	e.preventDefault();
	const formData = new FormData();
	formData.append('login', loginForm.elements['login'].value);
	formData.append('password', loginForm.elements['password'].value);
	if(rememberMe.checked){
		document.cookie = "sunriseLogin="+loginForm.elements['login'].value;
	}else{
		document.cookie = "sunriseLogin= "
	}
	fetch('../php/login.php', {
		method: 'POST',
		body: formData,
	})
		.then(function (response) {
			return response.text();
		})
		.then(function (body) {
			result = body;
			const errorMsg = document.querySelector('.error');
			if (result == '0') {
				errorMsg.textContent = 'Wprowadzono nieprawidłowe dane';
        		errorMsg.style.display = 'block';
			} else if (result == '1') {
				errorMsg.textContent = 'Konto nie jest aktywne';
        		errorMsg.style.display = 'block';
			} else	{
				location.replace('../html/user_panel/')
			}
		});
};
const loginButton = document.querySelector('#login_form_send');
loginButton.addEventListener('click', login);
