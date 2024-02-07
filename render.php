<?php

require __DIR__ . '/vendor/erusev/parsedown/Parsedown.php';
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $markdownText = file_get_contents('php://input');

    $htmlText = $Parsedown->text($markdownText);

    echo $htmlText;
}