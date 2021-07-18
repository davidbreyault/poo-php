<?php

function render(string $path, array $variables = []) {
    // extract(['color => 'Blue, 'size' => 'Medium']);
    // $color = 'Blue';
    // $size = 'Medium';
    extract($variables);
    ob_start();
    require('templates/' . $path . '.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
}

function redirect(string $url): void
{
    header("Location: $url");
    exit();
}