<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Biblio</title>
    <style>
        .montserrat-normal {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }
    </style>
    <script src="../scripts/index.js" defer></script>
</head>

<?php 
    
    session_start()

?>

<body class="w-full min-h-screen bg-gradient-to-br from-zinc-50 to-zinc-100 montserrat-normal">

    <header class="h-32 w-full flex justify-between items-center bg-gradient-to-r from-sky-600 to-sky-800 px-24 text-white shadow-xl">
        <p class="cursor-pointer text-xl">Icone du site</p>
        <div class="flex justify-center items-center gap-x-4">
            <div class="relative flex justify-center group cursor-pointer">
                <a href="library.php" class="text-xl">Bibliothèque</a>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-6 transition-all duration-[300ms] rounded-xl"></span>
            </div>
            <span class="w-[2px] h-8 bg-gradient-to-b from-zinc-300 to-zinc-100"></span>
            <div class="relative flex justify-center group cursor-pointer">
                <p class="text-xl">Favoris</p>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-6 transition-all duration-[300ms] rounded-xl"></span>
            </div>
        </div>
        <div class="relative group">
            <p class="cursor-pointer border-5 border-transparent bg-sky-700 group-hover:bg-sky-600 transition-all px-2 py-1 rounded-3xl group-hover:border-sky-200 text-xl">Icone du user</p>
            <div class="absolute inset-0 top-10 h-0 group-hover:h-34 text-black bg-gradient-to-br from-zinc-50 to-zinc-300 border-0 group-hover:border-1 border-transparent group-hover:border-zinc-400 rounded-xl transition-all duration-300 overflow-y-hidden">
                <div class="relative m-4 h-0 group-hover:h-full text-end flex flex-col justify-start items-end gap-y-2 text-md">
                    <a href="profil.php" class="text-md">Mon profil</a>
                    <span class="min-h-[1px] max-h-[1px] w-full bg-gradient-to-r from-zinc-700 to-zinc-900"></span>
                    <p class="text-md">Mes favories</p>
                    <span class="min-h-[1px] max-h-[1px] w-full bg-gradient-to-r from-zinc-700 to-zinc-900"></span>
                    <p id="logout" class="text-md">Déconnection</p>
                </div>
            </div>
        </div>
    </header>

    <div class="h-2 w-full bg-gradient-to-r from-cyan-500 to-cyan-700 rounded-b-xl"></div>