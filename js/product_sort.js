document.addEventListener('DOMContentLoaded', function() {
  const sortOption = document.querySelector('#sort');
  const productsContainer = document.querySelector('.products__productContainer');

  const sortProducts = () => {
    const products = document.querySelectorAll('.products__product');
    if (products.length === 0) {
      productsContainer.innerHTML = '<p style="font-size:2.3rem;">Brak produktów do wyświetlenia.</p>';
      return;
    }

    let productsData = [];
    products.forEach(element => {
      const productId = element.id;
      const productName = element.querySelector('.products__product--name').innerText;

      let priceText = element
        .querySelector('.products__product--price')
        .innerText
        .replace(' zł', '')
        .replace(/\s/g, '')
        .replace(',', '.');
      const productPrice = parseFloat(priceText);

      productsData.push([productId, productName, productPrice, element]);
    });

    const comparePrice = (a, b) => a[2] - b[2];
    const compareName  = (a, b) => a[1].localeCompare(b[1], 'pl-PL');

    if (sortOption.value === 'price-asc') {
      productsData.sort(comparePrice);
    } else if (sortOption.value === 'price-desc') {
      productsData.sort(comparePrice).reverse();
    } else if (sortOption.value === 'name-asc') {
      productsData.sort(compareName);
    } else if (sortOption.value === 'name-desc') {
      productsData.sort(compareName).reverse();
    } else {
      productsData.sort(compareName);
    }

    productsContainer.innerHTML = '';
    productsData.forEach(item => {
      productsContainer.appendChild(item[3]);
    });

    if (productsContainer.querySelectorAll('.products__product').length === 0) {
      productsContainer.innerHTML = '<p style="font-size:2.3rem;">Brak produktów do wyświetlenia.</p>';
    }
  };

  sortProducts();
  sortOption.addEventListener('change', sortProducts);
});
