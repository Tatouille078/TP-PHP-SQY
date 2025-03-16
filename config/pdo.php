<?php 
// Ici nous allons nous connecter à une BDD avec PDO : PHP Data Object
// Dans le bloc try on tente de se connecter 
// Si cela ne fonctionne pas nous irons dans le bloc catch qui affichera notre erreur
try {
    // On définit d'abord notre username et mot de passe lié à phpmyadmin
    $username = "root";
    $password = "";

    // DSN ou Data Source Name : Les infos qui vont nous permettre de nous connecter 
    $dsn = "mysql:dbname=tpphp;host=localhost";

    // On précise des options pour notre connexion avec PDO 
    // Ici il s'agit de récupérer les données sous fome de tableau associatif
    $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

    // Ici on vient se connecter à la BDD en créant un objet $pdo
    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $error) {

    // Si la connexion échoue on affiche un message d'erreur avec l'erreur en question
    die("Il y a une erreur : " . $error->getMessage());
}

?>