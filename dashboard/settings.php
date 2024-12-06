<?php session_start(); require __DIR__."/../vendor/autoload.php";

if(!isset($_SESSION["user"])) {
    header("Location: /auth/login");
    die;
}

use Auth\Auth;

if(isset($_POST["logout"])){
    $auth = new Auth();
    $auth->logout();
}

if(isset($_POST["deactivate_acc"])){
    $auth = new Auth();
    $auth->DeactivateAccount();
}

if(isset($_POST["change_password"])){
    $auth = new Auth();

    $auth->ChangePassword();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/settings.css">
    <style>.shake-horizontal{-webkit-animation:shake-horizontal .8s cubic-bezier(.455,.03,.515,.955) both;animation:shake-horizontal .8s cubic-bezier(.455,.03,.515,.955) both}@-webkit-keyframes shake-horizontal{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%{-webkit-transform:translateX(10px);transform:translateX(10px)}80%{-webkit-transform:translateX(8px);transform:translateX(8px)}90%{-webkit-transform:translateX(-8px);transform:translateX(-8px)}}@keyframes shake-horizontal{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%{-webkit-transform:translateX(10px);transform:translateX(10px)}80%{-webkit-transform:translateX(8px);transform:translateX(8px)}90%{-webkit-transform:translateX(-8px);transform:translateX(-8px)}}.scale-out-center{-webkit-animation:scale-out-center .5s cubic-bezier(.55,.085,.68,.53) both;animation:scale-out-center .5s cubic-bezier(.55,.085,.68,.53) both}@-webkit-keyframes scale-out-center{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(0);transform:scale(0);opacity:1}}@keyframes scale-out-center{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(0);transform:scale(0);opacity:1}}.fade-in{-webkit-animation:fade-in 0.4s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}@-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}</style>
    <title>Lukkshield | Settings</title>
</head>
<body class="bg-black font-roboto">
    <header class="flex items-center justify-around h-[100px] text-white">
      <p class=" font-bold text-2xl uppercase">
        Lukk<span class="text-[#6C63FF]">shield</span>
      </p>
      <ul class="flex space-x-4 text-2xl font-normal">
        <li>
            <a href="/dashboard">
                <button class="pl-4 pr-4 h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md">Dashboard</button>
            </a>
        </li>
        <li><form action="" method="POST"><button class="w-[80px] h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md" type="submit" name="logout">Logout</button></form></li>
      </ul> 
    </header>
    <section class="text-white bg-[#222222] m-44 ml-[25rem] mr-[25rem] p-6 rounded-lg">
        <div>
            <p class="text-xl font-semibold">Settings</p>
        </div>
        <div class="flex m-6 space-x-12">
            <div>
                <form
            action=""
            method="POST"
            class="flex flex-col justify-center items-center space-y-6 mt-4"
            >
            <div class="w-[380px]">
                <p>Change Password</p>
            </div>
            <div class="relative">
                <input
                autocomplete="off"
                class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent"
                id="password"
                name="password"
                type="password"
                placeholder=" "
                />
                <label
                for="password"
                class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4"
                >Old Password</label
                >
                <div id="password_error" class="text-red-500 w-[385px]"> <?php echo isset($_SESSION["p_error"]) ? $_SESSION["p_error"] : "" ?> </div>
            </div>
            <div class="relative">
                <input
                autocomplete="off"
                class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent"
                id="new-password"
                name="new-password"
                type="password"
                placeholder=" "
                />
                <label
                for="new-password"
                class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4"
                >New Password</label
                >
                <div id="new_password_error" class="text-red-500 w-[385px]"><?php echo isset($_SESSION["np_error"]) ? $_SESSION["np_error"] : "" ?></div>
            </div>
            <button name="change_password" type="submit" class="w-[100px] h-[40px] text-lg bg-green-700 border-green-800 border-2 rounded-md">Save</button>
            </form>
            </div>
            <div>
                <form action="" method="POST">
                    <p class="mt-2">Account Deletion</p>
                    <p class="m-4">By clicking "Deactivate Account," your account will be permanently deleted. Please note that once your account is deactivated, you will no longer have access to any data, and all your information will be erased from our system. We do not retain or save any data, and it will be deleted immediately. This action is irreversible.</p>
                    <div class="flex justify-end w-full">
                        <button name="deactivate_acc" class="pl-4 pr-4 h-[40px] font-bold text-lg bg-red-700 border-red-800 border-2 rounded-md">Deactivate Account</button>
                    </div>
                </form>
            </div>
        </div>
        <?php if(isset($_SESSION["success"])): ?>
            <div id="success" class="fade-in absolute bottom-5 left-5 pl-4 pr-6 flex items-center justify-between text-base h-[55px] bg-green-800 border-2 border-green-700 rounded-lg">
                <?php echo $_SESSION["success"]; ?> 
                <button class="ml-6" onclick="document.getElementById('success').remove()">X</button>
            </div>
            <script>setTimeout(()=>{document.getElementById("success").classList.add("scale-out-center"),setTimeout(()=>{document.getElementById("success").remove()},500)},2500);</script>
        <?php endif; ?>
    </section>
</body>
</html>
<?php unset($_SESSION["p_error"]); unset($_SESSION["np_error"]); unset($_SESSION["success"]); ?>