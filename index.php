<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown Converter</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="js/main.js" defer></script>

</head>

<body>
    <main>
        <div id="editor-container" style="height: 500px; width: 800px;"></div>
        <div id="preview-container">
            <h3>Preview</h3>
            <div id="button-container">
                <button id="to-html" onclick="setTimeout(render, 1000);">To HTML</button>
                <button id="to-md-text">To Markdown Text</button>
                <p>Preview will be shown here</p>
            </div>
            <div id="preview"></div>
    </main>
</body>

</html>