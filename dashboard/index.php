<?php session_start(); require __DIR__."/../vendor/autoload.php";

if(!isset($_SESSION["user"])) {
    header("Location: /auth/login");
    die;
}

use Auth\Auth;

$auth = new Auth();

if(isset($_POST["logout"])){
    $auth->logout();
}

$data = $auth->GetUserData();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <title>Lukkshield | Dashboard</title>
</head>
<body class="bg-black text-white">
    <header class="flex items-center justify-between h-[100px] text-white">
        <p class="translate-x-[150px] font-bold text-2xl uppercase">
            Lukk<span class="text-[#6C63FF]">shield</span>
        </p>
        <ul class="translate-x-[-150px] flex space-x-8 text-2xl font-normal">
            <form action="" method="POST"><button type="submit" name="logout">Logout</button></form>
        </ul>
    </header>
    <section>
        <?php if($data): ?>
            <div class="grid grid-cols-[100px_0.5fr_0.8fr_1fr_0.4fr] m-6">
                <!-- Header -->
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center rounded-tl-lg">#</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">App</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">Email</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center">Password</div>
                <div class="border-[1px] text-[#6C63FF] border-zinc-600 bg-zinc-900 h-[50px] flex justify-center items-center rounded-tr-lg">Action</div>
                <!-- Items -->
                <?php $id = 1; foreach ($data as $item): $bgClass = ($id % 2 == 0) ? 'bg-zinc-900' : 'bg-zinc-800'; ?>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 h-[50px] flex justify-center items-center'>
                        <p title='<?= $id ?>' class='truncate w-[50px] text-center'><?= $id ?></p>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 h-[50px] flex justify-center items-center'>
                        <p title='<?= $item["app"] ?>' class='truncate w-3/4 text-center'><?= $item['app'] ?></p>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 h-[50px] flex justify-center items-center'>
                        <?= $item['email'] ?>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 h-[50px] flex justify-center items-center'>
                        <?= $item['password'] ?>
                    </div>
                    <div class='<?= $bgClass ?> bg-zinc-800 border-[1px] border-zinc-600 h-[50px] flex justify-center items-center'>
                        <?= $item['id'] ?>
                    </div>
                <?php $id++; endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>