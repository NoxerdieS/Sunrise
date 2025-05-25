const loginForm = document.querySelector('#loginForm')

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
	const formData = new FormData(loginForm);

    fetch('../../php/login.php', {
		method: 'POST',
		body: formData,
	})
	.then(function (response) {
		return response.text();
	})
    .then(body => {
        if(body == '2'){
            location.replace('./order.php')
        }
    })
})