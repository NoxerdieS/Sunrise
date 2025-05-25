window.addEventListener('DOMContentLoaded', ()=> {
    const addParam = document.querySelector('#addParam')
    let i = 0;
    addParam.addEventListener('click', () => {
        const container = document.createElement('div')
        container.classList.add('admin__formContainer')
        addParam.insertAdjacentElement('beforebegin', container)
        container.innerHTML = `<input type="text" name="param_name${i}" class="admin__contentContainer--input" placeholder="Nazwa parametru">
        <input type="text" name="param_value${i}" class="admin__contentContainer--input" placeholder="Wartość parametru">`
        i++
    })
})