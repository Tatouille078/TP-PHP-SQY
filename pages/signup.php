<?php

ob_start();

include "../components/header.php";
include "../config/pdo.php";

// Processus de SIGNUP (aidez vous du login !)

// On vient vérifier que le form ait été soumis en POST et que le bouton de submit ait bien été cliqué
if (($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["submit"])) {

  // On vient vérifier que tous les champs soient remplis
  if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"])) {

    // On vérifie si le username correspond aux contraintes
    if (strlen($username) <= 4 && strlen($username) >= 24 && preg_match('/[^a-zA-Z0-9_]/', $username)) {
      $error = "Le pseudo doit contenir entre 5 et 24 caractères et ne peut contenir que des lettres, des chiffres et des underscores";
    }
      // On check ensuite que le mdp et la confirmation soient identiques 
      if ($_POST["password"] === $_POST["confirm-password"]) {

        // On vérifie si le mot de passe rentre dans les contraintes
        if (preg_match('/^(?=.*\d)(?=.*[^a-zA-Z0-9_]).{8,}$/', $_POST["password"])) {
        
          // On vient vérifier les données que l'on récupère (pas de caractères soucieux sur le username et que l'email soit bien un email - filter_var)
          $username = htmlspecialchars($_POST["username"]);
          $email = $_POST["email"];
          $password = $_POST["password"];

          // Je vérifie que l'email est bien au bon format sinon erreur
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // On vérifie ensuite que le mail n'existe pas déjà en BDD
            $sql = "SELECT * FROM users WHERE email = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Si on ne récupère de user depuis la BDD c'est que l'email n'est pas utilisé
            if (!$user) {

              // On va créér le hash pour le mot de passe
              $hash = password_hash($password, PASSWORD_DEFAULT);

              // On insère le nouveau user en BDD 
              $sql = "INSERT INTO users(username, password_hash, email) VALUES(?, ?, ?)";

              $stmt = $pdo->prepare($sql);
              $stmt->execute([$username, $hash, $email]);

              // Si tout va bien on redirige vers le login
              header("Location: login.php");

              ob_flush();

            } else {
              $error = "L'email est déjà utilisé";
            }
          } else {
            $error = "L'email n'est pas au bon format";
          }
        } else {
          $error = "Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule et un chiffre";
        }
      } else {
        $error = "Les mots de passe sont différents";
      }
  } else {
    $error = "Veuillez remplir tous les champs";
  }
}
?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
<img src="../assets/BiblioClan_logo.png" alt="Logo" class="h-48 object-contain mx-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign up</h2>
  </div>

  <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">

    <!-- Ici notre formulaire de Login  -->
    <form class="space-y-6" action="#" method="POST">

      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
        <div class="mt-1">
          <input type="text" name="email" id="email" autocomplete="email"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
        <div class="mt-1">
          <input type="text" name="username" id="username" autocomplete="username"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <!-- <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div> -->
        </div>
        <div class="mt-1">
          <input type="password" name="password" id="password" autocomplete="current-password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="confirm-password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
        </div>
        <div class="mt-1">
          <input type="password" name="confirm-password" id="confirm-password" autocomplete="confirm-password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">S'inscrire</button>
      </div>

    </form>

    <div class="flex justify-center pt-4">
      <p>Déjà un compte? <a href="login.php" class="text-sky-600 underline hover:text-sky-800">Se connecter</a></p>
    </div>

    <?php if (isset($error)): ?>

      <div class="pt-1 flex justify-center">
        <p class="text-red-700 max-w-[700px]"><?= $error ?></p>
      </div>

    <?php endif ?>

  </div>
</div>