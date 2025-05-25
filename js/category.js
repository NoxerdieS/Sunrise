const productsBtns = document.querySelectorAll('.products__product--addToCart');
const productAdded = document.querySelector('.nav__user--popup');
const closeBtn = document.querySelector('.closeBtn');
const addToCartBtn = document.querySelectorAll('.products__product--addToCart');
let link;

const formData = new FormData();

productsBtns.forEach((element) => {
	element.addEventListener('click', () => {
		formData.append('id', element.parentElement.id);
		formData.append('quantity', 1);
		fetch('../../php/add_to_cart.php', {
			method: 'POST',
			body: formData,
		}).then((productAdded.style.display = 'block'));
	});
});

closeBtn.addEventListener('click', () => {
	productAdded.style.display = 'none';
});

addToCartBtn.forEach((el) => {
    el.addEventListener('mouseover', () => {
        link = el.parentElement.getAttribute('href');
        el.parentElement.setAttribute('href', '#')
    });
});
addToCartBtn.forEach((el) => {
    el.addEventListener('mouseleave', () => {
        el.parentElement.setAttribute('href', link)
    });
});
