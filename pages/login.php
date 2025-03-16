<?php

ob_start();

// On inclut la connexion à notre BDD
include "../components/header.php";
include "../config/pdo.php";

// On vérifie que le form ait bien été soumois avec POST
if (($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["submit"])) {

    // On vérifie que les champs ne soient pas laissé vides 
    if (!empty($_POST["username"]) && (!empty($_POST["password"]))) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        // On effectue une requete préparée à l'aide $pdo qui est définit dans notre fichier pdo.php
        // et qui est importé plus haut sur cette page  
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);

        // On vient fetch (récupérer) les éventuels résultats 
        $result = $stmt->fetch();

        //Si on récupère les informations donc le user existe
        if ($result) {

            // on vérifie le mot de passe
            $password_hash = $result["password_hash"];

            // Si le password et le hash sont correct:
            if (password_verify($password, $password_hash)) {

                // On démarre une session
                session_start();

                // On place dans le tableau $_SESSION les infos du user qu'on récupère de la BDD
                $_SESSION = $result;

                // On redirige le user vers la homepage
                header("Location: ../index.php");

                // A l'aide d'un buffer je retarde l'éxecution de mon bloc de code afin d'éviter les erreurs liées à l'envoi 
                // - mofification des headers 
                ob_flush();

                $error = "connected";

            } else {
                $error = "Le mot de passe n'est pas le bon";
            }

        } else {
            $error = "Aucun utilisateur trouvé avec cette email";
        }
        // Si jamais des champs sont laissés vides ...
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}

?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <img src="../assets/BiblioClan_logo.png" alt="Logo" class="h-48 object-contain mx-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <!-- Ici notre formulaire de Login  -->
    <form class="space-y-6" action="#" method="POST">

      <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
        <div class="mt-2">
          <input type="text" name="username" id="username" autocomplete="username"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <!-- <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div> -->
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
      
    </form>

    <div class="flex justify-center pt-4">
      <p>Pas de compte? <a href="signup.php" class="text-sky-600 underline hover:text-sky-800">créer un compte</a></p>
    </div>

    <?php if (isset($error)) : ?>
        <!-- s'il y a une erreur -->
        <p class="text-red-700"><?= $error ?></p>

    <?php endif ?>

  </div>
</div>