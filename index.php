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
            <div id="render-buttons">
                <button id="preview-button" onclick="changePreviewType('html')">Preview</button>
                <button id="html-code-button" onclick="changePreviewType('html code')">HTML Code</button>
            </div>
            <div id="editor-buttons">
                <button id="highlight-button" onclick="highlight()">Highlight OFF</button>
                <button id="clear-button" onclick="clear()">Clear</button>
            </div>
            <div>
                <button id="download-md-button" onclick="downloadMd()">Download MD</button>
                <button id="download-html-button" onclick="downloadHTML()">Download HTML</button>
            </div>
            <div id="preview"></div>
        </div>
    </main>
</body>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">

</html>