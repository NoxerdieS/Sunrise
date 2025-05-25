let editor
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        fetch(`../info_pages/${urlParams.get('item')}`)
        .then((res) => {
            return res.json()
        }).then((body) =>{
            editor = new EditorJS({
                holder: 'editorjs',
                autofocus: true,
                tools: {
                    header: Header,
                    paragraph: Paragraph
                },
                data: body
            })
        })
        const submitBtn = document.querySelector('#submitBtn')
        submitBtn.addEventListener('click', () => {
            editor.save().then((outputData) => {
                editor.clear()
                console.log(outputData)
                const filename = document.querySelector('#filename')
                const name = document.querySelector('#name')
                const formData = new FormData();
                formData.append("filename", filename.value);
                formData.append("name", name.value);
                formData.append("text", JSON.stringify(outputData));
                fetch('../../php/admin_panel/edit_info_page.php', {
                    method: 'POST',
                    body: formData
                }).then(
                    window.location.replace('./info_editor.php')
                )
    
            })
        })