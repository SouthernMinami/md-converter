
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

    window.addEventListener('load', () => {
        render();
    })

    const debounce = (fn, delay) => {
        return (...args) => {
            if (fn.timer) {
                clearTimeout(fn.timer)
            }
            fn.timer = setTimeout(() => {
                fn(...args);
            }, delay)
        }
    }

    editor.getModel().onDidChangeContent(() => {
        debounce(render, 1000)();
    })
})

const render = () => {
    fetch('render.php', {
        method: 'POST',
        body: editor.getValue(),
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
