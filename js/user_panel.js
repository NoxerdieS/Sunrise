const detailsBtns = document.querySelectorAll('.details');
const popup = document.querySelector('.user__popup');

detailsBtns.forEach((element) => {
    element.addEventListener('click', () => {
        const id = element.nextElementSibling.value;
		fetch(`../../html/user_panel/order_details.php?id=${id}`)
        .then((res) => {
            return res.text();
        })
        .then((body) => {
            popup.innerHTML = body;
            popup.innerHTML += '<button class="admin__contentContainer--closeBtn closeBtn" id="closeBtn"><i class="fa-solid fa-x"></i></button>';
            popup.style.display = 'flex';
            
            const popupCloseBtn = document.querySelector('#closeBtn');
                popupCloseBtn.addEventListener('click', () => {
                    popup.style.display = 'none';
                });
			});
	});
});

