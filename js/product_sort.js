const sortOption = document.querySelector('#sort')
const productsContainer = document.querySelector('.products__productContainer')
const sortProducts = () => {
    const products = document.querySelectorAll('.products__product')
    
    let productsData = []
    products.forEach(element => {
        const productId = element.id
        const productName = element.querySelector('.products__product--name').innerHTML
        const productPrice = parseFloat(element.querySelector('.products__product--price').innerHTML.replace(' zł', ''))
        productsData.push([productId, productName, productPrice])
    })
    const comparePrice = (a, b) => {
        if (a[2] === b[2]) {
            return 0;
        }
        else {
            return (a[2] < b[2]) ? -1 : 1;
        }
    }
    const compareName = (a, b) => {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] < b[1]) ? -1 : 1;
        }
    }
    if(sortOption.value == 'price-asc'){
        productsData.sort(comparePrice)
    }else if(sortOption.value == 'price-desc'){
        productsData.sort(comparePrice)
        productsData.reverse()
    }else if(sortOption.value == 'name-asc'){
        productsData.sort(compareName)
    }else{
        productsData.sort(compareName)
        productsData.reverse()
    }
    productsContainer.innerHTML = ''
    for(let i=0; i < productsData.length; i++){
            products.forEach(element => {
            if(element.id == productsData[i][0]){
                productsContainer.appendChild(element)
            }
        })
    }
}
sortProducts();
sortOption.addEventListener('change', sortProducts)