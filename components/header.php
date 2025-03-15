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
            <span class="w-[2px] h-8 bg-gradient-to-b from-sky-700 via-sky-50 to-sky-700"></span>
            <div class="relative flex justify-center group cursor-pointer">
                <p class="text-xl">Favoris</p>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-6 transition-all duration-[300ms] rounded-xl"></span>
            </div>
        </div>
        <div class="relative group">
            <?php if (!empty($_SESSION)) : ?>
                <img src="<?php echo htmlspecialchars($_SESSION['profile_picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="Profil" class="max-w-12 rounded-full">
                <div class="absolute w-48 inset-0 top-16 -left-[200%] h-0 group-hover:h-34 text-black bg-gradient-to-br from-zinc-50 to-zinc-300 border-0 group-hover:border-1 border-transparent group-hover:border-zinc-400 rounded-xl transition-all duration-300 overflow-y-hidden">
                <div class="relative m-4 h-0 group-hover:h-full text-end flex flex-col justify-start items-end gap-y-2 text-md">
                    <a href="profil.php" class="text-md">Mon profil</a>
                    <span class="border-b border-zinc-400 h-[0.1px] w-full"></span>
                    <p class="text-md">Mes favories</p>
                    <p id="logout" class="text-md cursor-pointer">Déconnection</p>
                </div>
            </div>
            <?php else : ?>
            <img src="https://i.pinimg.com/originals/c0/27/be/c027bec07c2dc08b9df60921dfd539bd.webp" alt="dzdz" class="max-w-12 rounded-full">
            <div class="absolute w-48 inset-0 top-16 -left-[200%] h-0 group-hover:h-24 text-black bg-gradient-to-br from-zinc-50 to-zinc-300 border-0 group-hover:border-1 border-transparent group-hover:border-zinc-400 rounded-xl transition-all duration-300 overflow-y-hidden">
                <div class="relative m-4 h-0 group-hover:h-full text-end flex flex-col justify-start items-end gap-y-2 text-md">
                    <a href="login.php" class="text-md">Log in</a>
                    <span class="border-b border-zinc-400 h-[0.1px] w-full"></span>
                    <a href="signup.php" class="text-md">S'inscrire</a>
                </div>
            </div>
            <?php endif ?>
        </div>
    </header>

    <div class="h-2 w-full bg-gradient-to-r from-cyan-500 to-cyan-700 rounded-b-xl"></div>