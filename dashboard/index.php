<?php session_start(); require __DIR__."/../vendor/autoload.php";

if(!isset($_SESSION["user"])) {
    header("Location: /auth/login");
    die;
}

use Auth\Auth;
use Utils\Cipher;

$auth = new Auth();

if(isset($_POST["logout"])){
    $auth->logout();
}

if(isset($_POST["delete"])){
    $auth->DeleteUserCredential();
}


if(isset($_POST["edit"])){
    $auth->EditUserCredential();
}

if(isset($_POST["add"])){
    $auth->AddNewCredential();
}

if(isset($_SESSION["key"])){
    $cipher = new Cipher();
}   

$data = $auth->GetUserData();

if(isset($_FILES['key']) && $_FILES['key']['error'] === UPLOAD_ERR_OK) {
    $cipher = new Cipher();
    $cipher->readKey();
}

if(isset($_POST["generate-key"])) {
    $cipher = new Cipher();
    $cipher->generateKey();
}

if(isset($_POST["regenerate-key"])) {
    $cipher = new Cipher();
    $cipher->regenerateKey();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <title>Lukkshield | Dashboard</title>
    <style>.shake-horizontal{-webkit-animation:shake-horizontal .8s cubic-bezier(.455,.03,.515,.955) both;animation:shake-horizontal .8s cubic-bezier(.455,.03,.515,.955) both}@-webkit-keyframes shake-horizontal{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%{-webkit-transform:translateX(10px);transform:translateX(10px)}80%{-webkit-transform:translateX(8px);transform:translateX(8px)}90%{-webkit-transform:translateX(-8px);transform:translateX(-8px)}}@keyframes shake-horizontal{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%{-webkit-transform:translateX(10px);transform:translateX(10px)}80%{-webkit-transform:translateX(8px);transform:translateX(8px)}90%{-webkit-transform:translateX(-8px);transform:translateX(-8px)}}.scale-out-center{-webkit-animation:scale-out-center .5s cubic-bezier(.55,.085,.68,.53) both;animation:scale-out-center .5s cubic-bezier(.55,.085,.68,.53) both}@-webkit-keyframes scale-out-center{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(0);transform:scale(0);opacity:1}}@keyframes scale-out-center{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(0);transform:scale(0);opacity:1}}.fade-in{-webkit-animation:fade-in 0.4s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}@-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}</style>
    <script src="/assets/js/dashboard.js" defer></script>
</head>
<body class="bg-black text-white">
    <header class="flex items-center justify-around h-[100px] text-white">
        <p class="font-bold text-2xl uppercase">
            Lukk<span class="text-[#6C63FF]">shield</span>
        </p>    
        <div class="space-x-4">
            <?php if(isset($_SESSION["key"])): ?>
                <button class="w-[80px] h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md" onclick="open_add_modal()">Add</button>
                <button onclick="open_change_key_modal()" class=" pl-4 pr-4 h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md">Change Key</button>
                <?php endif; ?>
            <?php if(isset($_SESSION["key"]) || $data):  ?>
                    <button onclick="open_regenerate_modal()" type="submit" name="delete" class="w-[140px] h-[35px] bg-red-700 border-red-800 text-base border-2 rounded-md">Regenerate Key</button>
                    <?php endif; ?>
            </div>
            <div class="flex justify-center items-center space-x-4">
                <a href="./settings">
                    <button class="pl-4 pr-4 h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md" name="logout">Settings</button>
                </a>
                <form action="" method="POST"><button class="w-[80px] h-[35px] text-base bg-gray-700 border-gray-800 border-2 rounded-md" type="submit" name="logout">Logout</button></form>
            </div>
    </header>
    <section id="section">  
        <?php if(isset($_SESSION["key"])):  ?>
        <?php if($data): ?>
            <div class="grid grid-cols-[100px_0.5fr_0.8fr_1fr_0.4fr] row-auto m-6">
                <!-- Header -->
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center rounded-tl-lg">#</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">App</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">Email</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">Password</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center rounded-tr-lg">Action</div>
                <!-- Items -->
                <?php $id = 1; foreach ($data as $item): $bgClass = ($id % 2 == 0) ? 'bg-zinc-900' : 'bg-zinc-800'; ?>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 min-h-[50px] flex justify-center items-center'>
                        <p title='<?= $id ?>' class='truncate w-[50px] text-center'><?= $id ?></p>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 min-h-[50px] flex justify-center items-center'>
                        <p title='<?= $item["app"] ?>' class='truncate w-3/4 text-center'><?= $item['app'] ?></p>
                    </div>
                    <div class='<?= $bgClass ?> p-4 bg-zinc-800 border-[1px] border-zinc-600 min-h-[50px] flex justify-center items-center'>
                        <?= $cipher->decrypt($item['email']) ?>
                    </div>
                    <div class='<?= $bgClass ?> p-4 bg-zinc-800 border-[1px] border-zinc-600 min-h-[50px] flex justify-center items-center'>
                        <?= $cipher->decrypt($item['password']) ?>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 min-h-[50px] space-x-4 flex justify-center items-center'>
                        <button onclick="Edit(event)" data-id="<?= $item["id"] ?>" data-app="<?= $item["app"] ?>" data-email="<?= $cipher->decrypt($item["email"]) ?>" data-password="<?= $cipher->decrypt($item["password"]) ?>" type="" class="w-[80px] h-[35px] bg-gray-600 border-gray-700 border-2 rounded-md">Edit</button>
                        <form action="" method="POST">  
                            <input type="hidden" name="id" value="<?= $item["id"] ?>">
                            <button type="submit" name="delete" class="w-[80px] h-[35px] bg-red-700 border-red-800 border-2 rounded-md">Delete</button>
                        </form>
                    </div>
                <?php $id++; endforeach; ?>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if($data): ?>
                <div class="flex justify-center items-center min-h-[400px] space-x-4">
                    <form action="" method="POST" enctype="multipart/form-data" id="key_upload">
                            <input type="file" hidden name="key" id="key" accept=".key">
                            <label for="key" class="flex flex-col justify-center items-center cursor-pointer space-y-2 rounded-lg min-w-[290px] min-h-[180px] bg-[#222222]">
                                <p class="text-xl font-semibold">Upload Key</p>
                                <img class="w-[100px] h-[100px]" src="/static/upload.svg" alt="upload logo">
                            </label>
                    </form>
                    <script>document.getElementById('key').addEventListener('change', function() {document.getElementById('key_upload').submit();});</script>   
                </div>
            <?php else: ?>                    
                <div class="flex justify-center items-center min-h-[100px] text-2xl font-semibold">Welcome, To Get Started:</div>
                <div class="flex justify-center items-center min-h-[400px] space-x-4">
                    <form action="" method="POST" enctype="multipart/form-data" id="key_upload">
                        <input type="file" hidden name="key" id="key" accept=".key">
                        <label for="key" class="flex flex-col justify-center items-center cursor-pointer space-y-2 rounded-lg min-w-[290px] min-h-[180px] bg-[#222222]">
                            <p class="text-xl font-semibold">Upload Key</p>
                            <img class="w-[100px] h-[100px]" src="/static/upload.svg" alt="upload logo">
                        </label>
                    </form>
                    <script>document.getElementById('key').addEventListener('change', function() {document.getElementById('key_upload').submit();});</script>
                    
                    <p class="text-2xl font-semibold">OR</p>
                    <form id="generate_key_form" action="" method="POST">
                        <button type="submit" name="generate-key" class="flex flex-col justify-center items-center cursor-pointer space-y-2 rounded-lg min-w-[290px] min-h-[180px] bg-[#222222]">
                            <p class="text-xl font-semibold">Get Key</p>
                            <img class="w-[100px] h-[100px]" src="/static/key.svg" alt="key logo">
                        </button>
                    </form>
                    <script>const form = document.getElementById('generate_key_form');form.addEventListener('submit', function(event) {setTimeout(function() {location.reload();}, 1000);});</script>
                </div>
            <?php endif; ?>

        <?php endif; ?>
        <?php if(isset($_SESSION["error"])): ?>
            <div id="error" class="shake-horizontal absolute bottom-5 left-5 pl-4 pr-6 flex items-center justify-between text-base h-[70px] bg-red-800 border-2 border-red-700 rounded-lg">
                <?php echo $_SESSION["error"]; ?> 
                <button class="ml-6" onclick="document.getElementById('error').remove()">X</button>
            </div>
            <script>setTimeout(()=>{document.getElementById("error").classList.add("scale-out-center"),setTimeout(()=>{document.getElementById("error").remove()},500)},2700);</script>
        <?php endif; ?>
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

<?php unset($_SESSION["error"]); unset($_SESSION["success"]); ?>