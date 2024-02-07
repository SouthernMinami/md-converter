<?php

require __DIR__ . '/vendor/autoload.php';
$Parsedown = new Parsedown();
$highlighter = new Highlight\Highlighter();
$Parsedown->setSafeMode(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req = json_decode(file_get_contents('php://input'), true);
    $markdown_text = $req['text'];
    $preview_type = $req['previewType'];
    $preview_highlighten = $req['previewHighlighten'];

    if ($preview_type === 'html') {
        if ($preview_highlighten) {
            // コードブロックをハイライトする
            $Parsedown->setMarkupEscaped(false);
            $Parsedown->setSafeMode(false);
            $Parsedown->setUrlsLinked(false);
            $Parsedown->setBreaksEnabled(true);
            $Parsedown->blockCodeClass = '';
            $Parsedown->blockCodeAttributes = function ($String, $Block) use ($highlighter) {
                $highlighted = $highlighter->highlightAuto($String);
                return [
                    'class' => 'hljs ' . $highlighted->language,
                    'innerHTML' => $highlighted->value,
                ];
            };
        }
        $html_text = $Parsedown->text($markdown_text);
        echo $html_text;
    } else if ($preview_type === 'html code') {

        // nl2br()で\nを<br>に変換
        // htmlspecialchars()でマークダウンをHTMLコードに変換
        $html_text = nl2br(htmlspecialchars($Parsedown->text($markdown_text)));
        echo $html_text;
    }


}