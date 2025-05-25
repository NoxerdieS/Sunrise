const userForm = document.querySelector('#updateUserForm')
userForm.addEventListener('submit', () => {
    const formData = new FormData(userForm)
    const address_id = document.querySelector('#address_id').value
    formData.append('address_id', address_id)
    fetch('../../php/user_panel/edit_user_data.php', {
        method: 'POST',
        body: formData
    })
})