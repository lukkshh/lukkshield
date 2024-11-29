<?php session_start(); require __DIR__."/../vendor/autoload.php";

if(!isset($_SESSION["user"])) {
    header("Location: /auth/login");
    die;
}

if(isset($_POST["logout"])){
    $auth = new Auth\Auth();
    $auth->logout();
}

echo $_SESSION["user"];

?>
<form action="" method="POST">
    <button name="logout" type="submit">logout</button>
</form>