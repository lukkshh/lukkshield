<?php

namespace Utils;

class Tracker {
    private  $db;

    public function __construct() {
        $pdo = new Database();
        $this->db = $pdo->connection();
        unset($pdo); 
    }

    public function track() {
        
        if (!isset($_GET["referer"])) {
            return;
        }
        
        if(isset($_SESSION["visited_once"])) {
            return;
        }
        
        $referer = $_GET["referer"];

        $allowedReferers = ['lukkshh.github.io', 'github.com'];
        
        if (!in_array($referer, $allowedReferers)) {
            return;  
        }
        
        $page = $_SERVER["HTTP_HOST"] . strtok($_SERVER["REQUEST_URI"], "?");
        
        $stmt = $this->db->prepare("INSERT INTO tracker (referer, page) VALUES (:referer, :page)");
        $stmt = $stmt->execute(array(":referer" => $referer, ":page" => $page));
        
        $_SESSION["visited_once"] = true;
    }
    
}