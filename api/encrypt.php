<?php

header("Access-Control-Allow-Origin:https://www.imaegoo.com");

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/vendor/autoload.php');

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception as Ex;
use Defuse\Crypto\Key;
use Defuse\Crypto\Encoding;

function encrypt($text, $key, $decrypt) {
  try {
    // Defuse PHP-Encryption requires a key object instead of a string.
    $key = Encoding::saveBytesToChecksummedAsciiSafeString(Key::KEY_CURRENT_VERSION, $key);
    $key = Key::loadFromAsciiSafeString($key);
    if ((bool) $decrypt) {
      return Crypto::decrypt((string) $text, $key);
    } else {
      return Crypto::encrypt((string) $text, $key);
    }
  } catch (Ex\CryptoException $ex) {
    return $decrypt ? 'Decryption failed' : 'Encryption failed';
  }
}

echo(encrypt($_POST['text'], $_POST['key'], $_POST['decrypt']));
