<?php

namespace Auth;

use Utils\Database;

class Auth {
    private $db;

    public function __construct() {
        $pdo = new Database();
        $this->db = $pdo->connection();
        unset($pdo); 
    }

    public function login() {

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        if($email == "" || $password == "") {
            $_SESSION["error"] = "Please fill in all fields!";
            header("Location: /auth/login");
            die;
        }

        $stmt = $this->db->prepare("SELECT id,password FROM users WHERE email = :email");
        $stmt->execute(array(":email" => $email));

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!$user) {
            $_SESSION["error"] = "Invalid email or password.";
            header("Location: /auth/login");
            die;
        }

        if(!password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Invalid email or password.";
            header("Location: /auth/login");
            die;
        }

        $_SESSION["user"] = $user["id"];
        header("Location: /dashboard");

    }

    public function register() {
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        if($email == "" || $password == "") {
            $_SESSION["error"] = "Please fill in all fields!";
            header("Location: /auth/signup");
            die;
        }

        if(strlen($password) < 8) {
            $_SESSION["p_error"] = "Password must be at least 8 characters!";
            header("Location: /auth/signup");
            die;
        }

        if(strlen($password) >= 16){
            $_SESSION["p_error"] = "Password must be less than 16 characters!";
            header("Location: /auth/signup");
            die;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $stmt = $stmt->execute(array(":email" => $email, ":password" => $hashedPassword));
        }  catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $_SESSION["error"] = "The email address has already been taken.";
                header("Location: /auth/signup");
                die;
            }
        }


        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(array(":email" => $email));
        
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        $_SESSION["user"] = $user["id"];

        header("Location: /dashboard");
        
    }

    public function logout() {
        session_destroy();
        header("Location: /auth/login");
    }

}