const detailsBtns = document.querySelectorAll('.details');
const returnBtns = document.querySelectorAll('.return')
const popup = document.querySelector('.user__popup');

detailsBtns.forEach((element) => {
    element.addEventListener('click', () => {
        const id = element.parentElement.lastElementChild.value
		fetch(`../../html/user_panel/order_details.php?id=${id}`)
        .then((res) => {
            return res.text();
        })
        .then((body) => {
            popup.innerHTML = body;
            popup.style.display = 'flex';
            
            const popupCloseBtn = document.querySelector('#closeBtn');
                popupCloseBtn.addEventListener('click', () => {
                    popup.style.display = 'none';
                });
			});
	});
});

returnBtns.forEach((element) => {
    element.addEventListener('click', () => {
        const id = element.parentElement.lastElementChild.value;
        fetch(`../../html/user_panel/return_form.php?id=${id}`)
            .then((res) => res.text())
            .then((html) => {
                popup.innerHTML = html;
                popup.style.display = 'flex';

                const popupCloseBtn = document.querySelector('#closeBtn');
                popupCloseBtn.addEventListener('click', () => {
                    popup.style.display = 'none';
                });
            });
    });
});

popup.addEventListener('submit', function(e) {
    if (e.target.id === 'return-form') {
        e.preventDefault();

        const formData = new FormData(e.target);

        fetch('../../php/user_panel/submit_return.php', {
            method: 'POST',
            body: formData,
        })
        .then(res => res.text())
        .then(body => {
            popup.innerHTML = body;


            const popupCloseBtn = document.querySelector('#closeBtn');
            if (popupCloseBtn) {
                popupCloseBtn.addEventListener('click', () => {
                    popup.style.display = 'none';
                    window.location.reload();
                });
            }
        });
    }
});
