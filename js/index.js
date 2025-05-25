const mobileMenuButton = document.querySelector('.nav__mobile--bars');
const mobileMenu = document.querySelector('.nav__mobileMenu');
const allMobileMenuItems = document.querySelectorAll('.menu-item');
const allMobileDropdowns = document.querySelectorAll('.dropdown');


const showMenu = () => {
	mobileMenu.classList.toggle('visible');
};

const showMobileMenuItems = (num) => () => {
	allMobileDropdowns.forEach((element) => {
        if (element.classList.contains(`dropdown-${num}`)) {
			element.classList.toggle('visible-menu');
		} 
	});
};

const searchBar = document.querySelector('#searchBar')
const searchBtn = document.querySelector('#searchBtn')

searchBtn.addEventListener('click', () => {
	window.location.replace(`./html/category_pages/product_search.php?searchValue=${searchBar.value}`)
})

mobileMenuButton.addEventListener('click', showMenu);
allMobileMenuItems[0].addEventListener('click', showMobileMenuItems('one'));
allMobileMenuItems[1].addEventListener('click', showMobileMenuItems('two'));
allMobileMenuItems[2].addEventListener('click', showMobileMenuItems('three'));
