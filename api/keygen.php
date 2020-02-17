<?php

header("Access-Control-Allow-Origin:https://www.imaegoo.com");

function keygen($length)
{
    $token = '';
    $tokenlength = round($length * 4 / 3);
    for ($i = 0; $i < $tokenlength; ++$i) {
        $token .= chr(rand(32, 1024));
    }
    $token = base64_encode(str_shuffle($token));
    return substr($token, 0, $length);
}

if (isset($_POST['bit'])) {
    $bit = $_POST['bit'];
    $length = round($bit / 8);
    echo keygen($length);
} else {
    echo 'bit is required';
}
