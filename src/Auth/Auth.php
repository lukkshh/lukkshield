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

    /**
     * Fetches user data from the user_credentials table
     *
     * @return array|false - Returns an array of user data if found, otherwise false
     */
    public function GetUserData(){
        $stmt = $this->db->prepare("SELECT * FROM user_credentials WHERE user_id = :id");
        $stmt->execute(array(":id" => $_SESSION["user"]));

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    public function DeleteUser($id) {

    }


    public function DeleteUserCredential() {
        
        $stmt = $this->db->prepare("SELECT * FROM user_credentials WHERE user_id = :user_id AND id = :id" );
        $stmt->execute(array(":user_id" => $_SESSION["user"], ":id" => $_POST["id"]));

        if ($stmt->rowCount() > 0) {
            $_SESSION["success"] = "Deleted successfully!";
            $stmt = $this->db->prepare("DELETE FROM user_credentials WHERE user_id = :user_id AND id = :id" );
            $stmt->execute(array(":user_id" => $_SESSION["user"], ":id" => $_POST["id"]));
            header("Location: /dashboard");
            die;
        } else {
            $_SESSION["error"] = "You do not have permission to delete this credential!";
            header("Location: /dashboard");
            die;
        }
    }

    public function EditUserCredential() {
        $stmt = $this->db->prepare("SELECT * FROM user_credentials WHERE user_id = :user_id AND id = :id" );
        $stmt->execute(array(":user_id" => $_SESSION["user"], ":id" => $_POST["id"]));


        $app = htmlspecialchars($_POST["app"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        
        if($app == "" || $email == "" || $password == "") {
            $_SESSION["error"] = "Please fill in all fields!";
            header("Location: /dashboard");
            die;
        }

        if ($stmt->rowCount() > 0) {
            $_SESSION["success"] = "Edited successfully!";

            $stmt = $this->db->prepare("UPDATE user_credentials SET app = :app , email = :email, password = :password WHERE user_id = :user_id AND id = :id" );
            $stmt->execute(array(":app" => $app, ":email" => $email, ":password" => $password, ":user_id" => $_SESSION["user"], ":id" => $_POST["id"]));
            
            header("Location: /dashboard");
            die;
        } else {
            $_SESSION["error"] = "You do not have permission to edit this credential!";
            header("Location: /dashboard");
            die;
        }
    }

    public function AddNewCredential() {    
        $app = htmlspecialchars($_POST["app"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        if($app == "" || $email == "" || $password == "") {
            $_SESSION["error"] = "Please fill in all fields!";
            header("Location: /dashboard");
            die;
        }


        $stmt = $this->db->prepare("INSERT INTO user_credentials (user_id, app, email, password) VALUES (:user_id, :app, :email, :password)");
        $stmt->execute(array(":user_id" => $_SESSION["user"], ":app" => $app, ":email" => $email, ":password" => $password));
        $_SESSION["success"] = "Added successfully!";
        header("Location: /dashboard");
        die;
    }
}