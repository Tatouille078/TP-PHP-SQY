<?php 

include "../components/header.php";

?>

<div class="w-full h-full flex flex-col items-center pt-16">
    <div class="grid grid-cols-3 w-[70%] border border-zinc-400 rounded-lg">
        <div class="flex flex-col items-center w-full border-r border-zinc-300 min-h-64 bg-zinc-100 py-4 rounded-l-lg">
            <p class="profile-button py-4 hover:bg-zinc-300 bg-transparent w-full pl-4 border-y border-transparent hover:border-zinc-400 transition-all cursor-pointer">Pseudonyme</p>
            <p class="password-button py-4 hover:bg-zinc-300 bg-transparent w-full pl-4 border-y border-transparent hover:border-zinc-400 transition-all cursor-pointer">Mot de passe</p>
            <p class="mail-button py-4 hover:bg-zinc-300 bg-transparent w-full pl-4 border-y border-transparent hover:border-zinc-400 transition-all cursor-pointer">Mail</p>
            <p class="pp-button py-4 hover:bg-zinc-300 bg-transparent w-full pl-4 border-y border-transparent hover:border-zinc-400 transition-all cursor-pointer">Photo de profil</p>
        </div>
        <div class="col-span-2 flex flex-col w-full py-4 pr-4">
            <h1 class="profile-title w-full font-bold text-center h-12 text-2xl">Profil</h1>
            <div class="text-md profile-container p-6 flex flex-col">
                <p>Votre espace profil.</p>
                <p>En cliquant sur les menus de gauche vous pouvez modifier vos informations.</p>
            </div>
        </div>
    </div>
</div>