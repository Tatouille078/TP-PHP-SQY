<?php include 'components/header.php'; ?>

<?php 

// 1 - Pouvoir chercher des livres (genre ou nom) via l'API google Books soit avec JS (fetch ou axios) soit cURL
// 2 - UN système de login et signup pour les Users (si pas login, il peut pas chercher)
// 3 - Une fois connecté le user peut ajouter des livres en favoris qui s'enregistrent en BDD. Il doit pouvoir aussi 
// supprimer ceux qu'il veut effacer => Pour tout ce qui est BDD avec PHP on utilise PDO et de requetes préparées
// 4 - Le user a un espace de profil dont il peut modifier les informations (ex : nom, email, avatar)
// 5 - Faire une doc d'utilisation (format word) qui explique comment fonctionne l'app et comment se servir des fonctionnalités
// 6 - Faire du code propre (indentation) et commenté

// Pour Google Books API : 
// - Il faut votre compte google
// - Vous allez devoir générer une clé API
// - Dans la partie API et services de votre compte vous devrez ajouter la Books API

// Notions à utiliser en PHP : 
// - les superglobales ($_POST, $_GET, $_SESSION)
// - PDO pour se connecter à la BDD 
// - Faire des requetes SQL (et préparées si besoin)
// - cURL pour faire des requetes API (ou sinon fetch / axios avec JS)

// Notions en JS :  
// - fetch ou axios pour le call API si pas en PHP

// En BDD (phpMyAdmin) : 
// - Créer les tables nécessaires (au moins User et Livres)

// Pour l'API :     
// https://developers.google.com/books

// Autre remarques : 

// PDO : Connexion à la BDD => cf le cours. On vient créer un objet $pdo qu'on réutilise dans nos pages pour faire nos requetes SQL

// Include et require vont vous permettre d'inclure du code modulable dans vos pages 

// cURL pour les requetes API ou fetch en JS 

// Pour le signup et le login => hasher les mdp avant la BDD.

// Vous devrez utiliser les sessions => quand un user se connecte vous démarrez une session 
// On enregistre généralement dans la superglobale $_SESSION lles infos du User resupérées de la BDD (et ainsi utiliser les sessions dans vos différentes pages)

// Pkoi pas utiliser les cookies si besoin (cf $_COOKIES et setcookie())

// Il faudra faire attention aux input (attaques XSS, injections SQL) => NTUI : NEVER TRUST USER INPUT

// Vous pouvez également ajouter composer à votre projet et installer des dépendances si besoin 

// Commenter les parties importantes de votre code ²

