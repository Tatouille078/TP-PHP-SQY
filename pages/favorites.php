<?php 

include '../components/header.php'; 

?>

<div class="w-full h-full min-h-screen flex flex-col items-center pt-8 bg-zinc-100">
    
    <!-- Si connecté : -->
    <?php if (!empty($_SESSION)): ?>

    <div class="w-full h-full flex justify-center items-center mt-16">
        <div class="rounded-lg grid grid-cols-3 gap-4 p-6 favoritesContainer"></div>
    </div>
    
    <!-- Si pas connecté -->
    <?php else : ?>
                
        <div class="p-2 bg-gradient-to-br from-blue-50 to-blue-200 gap-y-2 pb-6 rounded-xl border border-blue-300 justify-center items-center flex flex-col">
            <div class="p-6 bg-gradient-to-br from-blue-200 to-blue-300 rounded-lg border border-blue-400 justify-center items-center flex flex-col">
                <p class="text-xl font-bold">Veuillez vous connecter pour accéder à vos favoris!</p>
            </div>
            <a href="login.php" class="text-md text-blue-700 hover:text-blue-800 hover:underline transition-all pt-4">Page de connexion</a>
            <p class="text-md">Pas de compte? <a href="signup.php" class=" text-blue-700 hover:text-blue-800 hover:underline transition-all ">Créez un compte</a></p>
        </div>
        
    <?php endif ?>

</div>