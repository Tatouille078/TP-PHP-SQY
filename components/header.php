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
</head>
<body class="w-full min-h-screen bg-zinc-100 montserrat-normal">

    <header class="h-32 w-full flex justify-between items-center bg-gradient-to-r from-sky-600 to-sky-800 px-24 text-white text-xl">
        <p class="cursor-pointer">Icone du site</p>
        <div class="flex justify-center items-center gap-x-4">
            <div class="relative flex justify-center group cursor-pointer">
                <p>Bibliothèque</p>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-8 transition-all duration-[300ms] rounded-xl"></span>
            </div>
            <span class="w-[2px] h-8 bg-gradient-to-b from-zinc-300 to-zinc-100"></span>
            <div class="relative flex justify-center group cursor-pointer">
                <p>Favoris</p>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-8 transition-all duration-[300ms] rounded-xl"></span>
            </div>
        </div>
        <p class="cursor-pointer">Icone du user</p>
    </header>

    <div class="h-2 w-full bg-gradient-to-r from-cyan-500 to-cyan-700 rounded-b-xl"></div>