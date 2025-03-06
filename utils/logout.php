<?php
session_start(); // Démarre la session
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header('Location: ../pages/login.php'); // Redirige l'utilisateur après la déconnexion
exit;
?>