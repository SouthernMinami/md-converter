let previewType = "html";
let previewHighlighten = false;

require.config({
    paths: {
        vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs'
    }
})
require(['vs/editor/editor.main'], () => {
    window.editor = monaco.editor.create(document.getElementById('editor-container'), {
        value: [
            '# Markdown Editor',
            '---',
            '## Check and learn how the markdown is previewed or converted.',
            '---',
            '```',
            'This is a code block',
            '```',
        ].join('\n'),
        language: 'markdown'
    })
    editor.focus();


    window.addEventListener('load', () => {
        render();
    })


    editor.getModel().onDidChangeContent(() => {
        render();
    })
})

const render = () => {
    const reqJSON = {
        text: editor.getValue(),
        previewType: previewType,
        previewHighlighten: previewHighlighten
    }
    fetch('render.php', {
        method: 'POST',
        body: JSON.stringify(reqJSON),
        headers: {
            'Content-Type': 'text/plain'
        }
    })
        .then(res => res.text())
        .then(data => {
            document.getElementById('preview').innerHTML = data
        })
        .catch(err => console.error(err))
}

const changePreviewType = (type) => {
    previewType = type;
    render();
}

const highlight = () => {
    // highlight the code of monaco editor 
    const button = document.getElementById('highlight-button');
    if (button.innerHTML === 'Highlight ON') {
        button.innerHTML = 'Highlight ON';
        previewHighlighten = false;
    } else {
        button.innerHTML = 'Highlight OFF';
        previewHighlighten = true;
    }
}

const downloadMd = () => {
    const a = document.createElement('a');
    const file = new Blob([editor.getValue()], { type: 'text/markdown' });
    a.href = URL.createObjectURL(file);
    a.download = 'markdown.md';
    a.click();
}

const downloadHTML = () => {
    const reqJSON = {
        text: editor.getValue(),
        previewType: 'html',
        previewHighlighten: false
    }
    fetch('render.php', {
        method: 'POST',
        body: JSON.stringify(reqJSON),
        headers: {
            'Content-Type': 'text/plain'
        }
    })
        .then(res => res.text())
        .then(data => {
            const a = document.createElement('a');
            const file = new Blob([data], { type: 'text/html' });
            a.href = URL.createObjectURL(file);
            a.download = 'markdown.html';
            a.click();
        })
        .catch(err => console.error(err))
}