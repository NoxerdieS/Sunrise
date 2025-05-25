searchBtn.addEventListener('click', () => {
    const searchBar = document.querySelector('#searchBar')
    const searchRes = document.querySelectorAll('.admin__product--name')
    const adminProducts = document.querySelector('.admin__products')
    adminProducts.innerHTML =''
    searchRes.forEach(element =>{
        if(element.innerHTML.includes(searchBar.value)){
            adminProducts.appendChild(element.parentElement)
        }
    })

    let searchResetBtn = document.createElement('i')
    searchResetBtn.classList.add('fa-solid', 'fa-x')
    searchResetBtn.setAttribute('id', 'resetSearchBtn')
    searchBtn.replaceWith(searchResetBtn)
    searchResetBtn = document.querySelector('#resetSearchBtn')
    searchResetBtn.addEventListener('click', () => {
        searchBar.value = ""
        adminProducts.innerHTML = ""
        searchRes.forEach(element =>{
            adminProducts.appendChild(element.parentElement)
        })
        searchResetBtn.replaceWith(searchBtn)
    })
})