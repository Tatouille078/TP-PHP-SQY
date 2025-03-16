<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Import de la police Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/BiblioClan.png">
    <title>BiblioClan</title>
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

    <header class="h-24 w-full flex justify-between items-center bg-gradient-to-r from-sky-600 to-sky-800 px-24 text-white shadow-xl">
        <div class="w-64 flex justify-start items-center">
            <a href="../index.php">
                <img src="../assets/BiblioClan_white.png" alt="Icon" class="w-16">
            </a>
        </div>
        <div class="flex justify-center items-center gap-x-4">
            <div class="relative flex justify-center group cursor-pointer">
                <a href="library.php" class="text-xl">Bibliothèque</a>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-6 transition-all duration-[300ms] rounded-xl"></span>
            </div>
            <span class="w-[2px] h-8 bg-zinc-100 rounded-xl"></span>
            <div class="relative flex justify-center group cursor-pointer">
                <a href="favorites.php" class="text-xl">Favoris</a>
                <span class="absolute h-2 bg-gradient-to-r from-zinc-50 to-zinc-300 w-0 group-hover:w-full inset-0 top-6 transition-all duration-[300ms] rounded-xl"></span>
            </div>
        </div>
        <div class="relative group w-64 flex justify-end items-center">
            <!-- Si l'user est connecté  on affiche certains éléments en plus ou en moins-->
            <?php if (!empty($_SESSION)) : ?>
                <div class="flex justify-center items-center gap-x-2">
                    <p class="max-w-32 truncate"><?php echo $_SESSION['username'] ?></p>
                    <div class="w-12 h-12">
                        <img src="<?php echo htmlspecialchars($_SESSION['profile_picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="PP" class="w-full h-full object-cover rounded-full">
                    </div>
                </div>
                <div class="absolute w-48 top-12 h-0 inset-0 left-[70px] group-hover:h-[138px] text-black bg-gradient-to-br from-zinc-50 to-zinc-300 border-0 group-hover:border-1 border-transparent group-hover:border-zinc-400 rounded-xl transition-all duration-300 overflow-y-hidden">
                    <div class="relative m-4 h-0 group-hover:h-full text-end flex flex-col justify-start items-end gap-y-2 text-md">
                        <a href="profil.php" class="text-md">Mon profil</a>
                        <span class="border-b border-zinc-400 h-[0.1px] w-full"></span>
                        <a href="favorites.php" class="text-md">Mes favoris</a>
                        <span class="border-b border-zinc-400 h-[0.1px] w-full"></span>
                        <p id="logout" class="text-md cursor-pointer">Déconnection</p>
                    </div>
                </div>
            <!-- Si il n'est pas connecté -->
            <?php else : ?>
                <div class="w-12 h-12">
                    <img src="https://i.pinimg.com/originals/c0/27/be/c027bec07c2dc08b9df60921dfd539bd.webp" alt="PP" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="absolute w-48 inset-0 top-12 left-[70px] h-0 group-hover:h-24 text-black bg-gradient-to-br from-zinc-50 to-zinc-300 border-0 group-hover:border-1 border-transparent group-hover:border-zinc-400 rounded-xl transition-all duration-300 overflow-y-hidden">
                    <div class="relative m-4 h-0 group-hover:h-full text-end flex flex-col justify-start items-end gap-y-2 text-md">
                        <a href="login.php" class="text-md">Log in</a>
                        <span class="border-b border-zinc-400 h-[0.1px] w-full"></span>
                        <a href="signup.php" class="text-md">S'inscrire</a>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </header>

    <!-- Bordure jolie -->
    <div class="h-2 w-full bg-gradient-to-r from-indigo-500 to-indigo-700"></div>