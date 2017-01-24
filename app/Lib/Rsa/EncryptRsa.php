<?php
namespace App\Lib\Rsa;

class EncryptRsa
{
    public static function encrypt($content, $key = null)
    {
        if ($key === null) {
            $key = self::getKey('public');
        }

        openssl_public_encrypt($content, $encrypted, $key);

        return base64_encode($encrypted);
    }

    public static function decrypt($content, $key = null)
    {
        if ($key === null) {
            $key = self::getKey('private');
        }

        $encrypted = base64_decode($content);

        openssl_private_decrypt($encrypted, $decrypted, $key);

        return $decrypted;
    }

    public static function getKey($type)
    {
        $key = config('ylc');

        return $key[$type];
    }
}
