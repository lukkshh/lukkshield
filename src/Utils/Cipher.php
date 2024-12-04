<?php

namespace Utils;

set_error_handler(function ($severity, $message, $file, $line) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
});

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

    public function regenerateKey() {
        if(isset($_SESSION["key"])) { unset($_SESSION["key"]); }

        $db = new Database();
        $db = $db->connection();

        $stmt = $db->prepare("DELETE FROM user_credentials WHERE user_id = :user_id" );
        $stmt->execute(array(":user_id" => $_SESSION["user"]));

        $key = openssl_random_pseudo_bytes(32);

        $filename = 'do_not_share.key';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($key));

        echo $key;
        
        $_SESSION["key"] = $key;
        exit();
    }

    public function generateKey() {

        $key = openssl_random_pseudo_bytes(32);

        $filename = 'do_not_share.key';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($key));

        echo $key;
        die;
    }

    public function readKey() {
        if(isset($_FILES['key']) && $_FILES['key']['error'] === UPLOAD_ERR_OK) {
        
            if(pathinfo($_FILES["key"]["name"], PATHINFO_EXTENSION) !== "key") {
                $_SESSION["error"] = "Please upload a .key file.";
                header("Location: /dashboard");
                die;
            }
            
            $key = file_get_contents($_FILES["key"]["tmp_name"]);

            if(strlen($key) !== 32) {
                $_SESSION["error"] = "Please upload a valid key file.";
                header("Location: /dashboard");
                die;
            }

            $_SESSION["key"] = $key;
            header("Location: /dashboard");
            die;
        } else {
            $_SESSION["error"] = "Please upload a key file.";
        }
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

        try {
            $response = openssl_decrypt($ciphertext, $this->cipher, $this->key, 0, $iv);
            return $response;
        } catch (\Exception $e) {
            return "Something went wrong! The key you provided is incorrect, Please verify the key and try again";
        }
    }
    
}   