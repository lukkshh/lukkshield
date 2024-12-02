<?php

namespace Utils;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();

class Cipher {

    private $cipher; 
    private $key;

    public function __construct() {
        $this->cipher = $_ENV["encryption_method"];
        $this->key = isset($_SESSION["key"]);
    }

    public function generateKey() {

        $key = openssl_random_pseudo_bytes(32);

        $filename = 'encryption_key.key';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($key));

        echo $key;
        die;
    }

    /**
     * Encrypts a given plaintext string using the Cipher's key and
     * configured encryption method.
     *
     * @param string $plaintext The plaintext string to encrypt
     *
     * @return string The encrypted string, base64 encoded
     */
    public function encrypt($plaintext)
    {

        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    
        $encrypted = openssl_encrypt($plaintext, $this->cipher, $this->key, 0, $iv);
    
        return base64_encode($iv . $encrypted);
    }

    /**
     * Decrypts a given ciphertext string using the Cipher's key and
     * configured encryption method.
     *
     * @param string $encryptedData The ciphertext string to decrypt
     * @param string $key The encryption key to use for decryption
     *
     * @return string The decrypted string
     */
    function decrypt($encryptedData) {
        $data = base64_decode($encryptedData);

        $ivLength = openssl_cipher_iv_length($this->cipher);

        $iv = substr($data, 0, $ivLength); 

        $ciphertext = substr($data, $ivLength); 

        return openssl_decrypt($ciphertext, $this->cipher, $this->key, 0, $iv);
    }
    
}   