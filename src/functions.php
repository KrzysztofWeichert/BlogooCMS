<?php 
declare(strict_types = 1);

ini_set('display_errors', '1');

function dumper($var)
{
    echo '<br><div style="display: inline-block; padding: 10px; border: 1px solid black; background: lightblue;"> 
    <pre>';
    print_r($var);
    echo '</pre></div><br>';
}

function showShortText($text, $limit = 150) {
    if (mb_strlen($text) <= $limit) {
        return strip_tags($text);
    }
    
    $text = strip_tags($text);
    $shorted = mb_substr($text, 0, $limit);
    $lastSpace = mb_strrpos($shorted, ' ');

    if ($lastSpace !== false) {
        $shorted = mb_substr($shorted, 0, $lastSpace);
    }

    return $shorted . '...';
}