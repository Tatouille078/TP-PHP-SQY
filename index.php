<?php
session_start(); // Démarrer la session

// Vérifier si $_SESSION est vide
if (empty($_SESSION)) {
    // Si la session est vide, rediriger vers login.php
    header("Location: pages/login.php");
    exit(); // Assurez-vous de quitter le script après la redirection
} else {
    // Si la session n'est pas vide, rediriger vers library.php
    header("Location: pages/library.php");
    exit();
}
?>