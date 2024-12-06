<?php session_start(); require "vendor/autoload.php";

use Utils\Tracker;

$tracker = new Tracker();
$tracker->track();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/index.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <title>Lukkshield</title>
  </head>
  <body class="bg-black font-roboto">
    <header class="flex items-center justify-around h-[100px] text-white">
      <p class="font-bold text-2xl uppercase">
        Lukk<span class="text-[#6C63FF]">shield</span>
      </p>
      <ul class="flex space-x-8 text-2xl max-sm:text-base font-normal">
        <li><a href="/privacy-policy">Privacy Policy</a></li>
        <li><a href="/auth/login">Login</a></li>
      </ul>
    </header>
    <section class="flex flex-1 justify-center space-x-4 items-center mt-12 max-lg:flex-col max-sm:mt-2 max-sm:flex-col max-sm:space-x-0 ">
      <div class="flex flex-col justify-center">
        <p class="text-white w-[800px] font-semibold text-[96px] max-sm:text-[48px] max-lg:text-[58px] max-2xl:text-[70px] max-2xl:w-[600px]
        max-2xl:ml-4 max-lg:w-auto max-lg:ml-4 max-sm:ml-4 max-sm:w-auto">
          All Your Data in One
          <span class="text-[#6C63FF] underline">Secure</span> Location.
        </p>
        <p class="text-white text-2xl max-sm:text-sm max-sm:ml-4 max-lg:ml-4 max-lg:text-xl">
          Want To Know How It Works ?
          <span class="underline">Try It Yourself.</span>
        </p>
        <button
          class="w-[220px] h-[60px] max-lg:w-[180px] max-lg:h-[50px] max-lg:ml-4 max-lg:text-base max-sm:w-[140px] max-sm:h-[40px] max-sm:ml-4 max-sm:mt-4 max-sm:text-sm mt-11 rounded-2xl bg-white text-black text-[22px] font-semibold"
        >
          <a href="/auth/signup"> Sign Up Now </a>
        </button>
      </div>
      <div class="max-sm:flex max-sm:justify-center max-sm:items-center max-lg:flex max-lg:justify-center max-lg:items-center ">
        <img class="max-sm:mt-8 max-lg:mt-16 max-sm:w-[75%] max-lg:w-[80%]" src="/static/main-illustration.svg" alt="main illustration" />
      </div>
    </section>
    <footer
      class="max-sm:hidden max-lg:hidden max-2xl:h-[50px] text-xl flex justify-around items-center absolute bottom-0 h-[100px] w-full text-white"
    >
      <a href="">Github Repository</a>
      <p class="font-semibold">2024 © ALL RIGHTS RESERVED | LUKKSHIELD</p>
      <a href="">LUKKSHH</a>
    </footer>
    <?php  require "./components/cookie-consent.php" ?>
  </body>
</html>
