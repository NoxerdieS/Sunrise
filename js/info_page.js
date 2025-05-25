fetch(`./privacy`)
    .then((res) => {
        return res.json()
    }).then((body) =>{
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: Header,
                paragraph: Paragraph
            },
            data: body,
            readOnly: true
        })
    })