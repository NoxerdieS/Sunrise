window.addEventListener('DOMContentLoaded', () => {
    const filterSubmit = document.querySelector('#filterSubmit');
    const productsContainer = document.querySelector('.products__productContainer');
    const products = document.querySelectorAll('.products__product');
    const minPrice = document.querySelector('#minPrice');
    const maxPrice = document.querySelector('#maxPrice');
    const filterCheckboxes = document.querySelectorAll('.filter_checkbox');

    filterSubmit.addEventListener('click', () => {
        let checkedBoxes = [];
        filterCheckboxes.forEach(element => {
            if (element.checked) {
                checkedBoxes.push(element.id);
            }
        });

        let minPriceValue = (minPrice.value < 0 || minPrice.value === '') ? 0 : parseFloat(minPrice.value);
        let maxPriceValue = (maxPrice.value < 0 || maxPrice.value === '') ? 99999 : parseFloat(maxPrice.value);

        const url = window.location.pathname;
        const filename = url.substring(url.lastIndexOf('-') + 1).replace('.php', '');

        let formData = new FormData();
        checkedBoxes.forEach(param => {
            formData.append('filters[]', param); 
        });
        formData.append('category', filename);

        fetch('../../php/filter.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(filteredIds => {
            productsContainer.innerHTML = '';

            let visible = 0;
            products.forEach(element => {
                const id = parseInt(element.id);
                const price = parseFloat(element.querySelector('.products__product--price').innerHTML.replace(' zł', ''));

                const passesId = filteredIds.includes(id);
                const passesPrice = price >= minPriceValue && price <= maxPriceValue;

                if (passesId && passesPrice) {
                    productsContainer.appendChild(element);
                    visible++;
                }
            });

            if (visible === 0) {
                productsContainer.innerHTML = "Nie znaleziono produktów spełniających wymagania. Przepraszamy.";
            }
        })
        .catch(err => {
            console.error("Błąd filtrowania:", err);
            productsContainer.innerHTML = "Wystąpił błąd filtrowania.";
        });
    });

    const filterReset = document.querySelector('#filterReset');
    filterReset.addEventListener('click', () => {
        filterCheckboxes.forEach(element => {
            element.checked = false;
        });
        minPrice.value = '';
        maxPrice.value = '';
        productsContainer.innerHTML = '';
        products.forEach(element => {
            productsContainer.appendChild(element);
        });
    });
});
