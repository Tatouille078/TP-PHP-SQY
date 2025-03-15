<?php

session_start();
require_once '../config/pdo.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
    exit;
}

$user_id = $_SESSION['id']; // Récupération de l'ID utilisateur
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username'])) {
    $username = trim($data['username']);

    // Vérification des contraintes
    if (strlen($username) < 4 && strlen($username) > 24 || preg_match('/[^a-zA-Z0-9_]/', $username)) {
        echo json_encode(["success" => false, "message" => "Nom d'utilisateur invalide"]);
        exit;
    }

    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
    if ($stmt->execute([$username, $user_id])) {
        echo json_encode(["success" => true, "message" => "Nom d'utilisateur mis à jour"]);
        $_SESSION['username'] = $username;
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
    }
}

if (isset($data['email'])) {
    $email = trim($data['email']);

    // Vérification des contraintes
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // 6) On vérifie ensuite que le mail n'existe pas déjà en BDD
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Si on ne récupère de user depuis la BDD c'est que l'email n'est pas utilisé
        if (!$user) {
            // Mise à jour dans la base de données
            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            if ($stmt->execute([$email, $user_id])) {
                echo json_encode(["success" => true, "message" => "Email mis à jour"]);
                $_SESSION['email'] = $email;
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Cet email est déjà utilisé"]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email invalide"]);
        exit;
    }
}

if (isset($data['profile_picture'])) {
    $profile_picture = trim($data['profile_picture']);
    // Exemple d'utilisation
    if (isValidImage($profile_picture)) {
        // Mise à jour dans la base de données
        $stmt = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        if ($stmt->execute([$profile_picture, $user_id])) {
            echo json_encode(["success" => true, "message" => "Photo de profil mis à jour"]);
            $_SESSION['profile_picture'] = $profile_picture;
        } else {
            echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
        }
    } else {
        echo "URL invalide ou image inaccessible !";
    }
}

if (isset($data['password_hash'])) {
    $password = trim($data['password_hash']);
    
    if (!preg_match('/^(?=.*\d)(?=.*[^a-zA-Z0-9_]).{8,}$/', $password)) {
        echo json_encode(["success" => false, "message" => "Mot de passe invalide"]);
        exit;
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    if ($stmt->execute([$hash, $user_id])) {
        echo json_encode(["success" => true, "message" => "password mis à jour"]);
        $_SESSION['password_hash'] = $hash;
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
    }
}

function isValidImage($url) {
    $headers = @get_headers($url); // Récupère les en-têtes HTTP
    if ($headers && strpos($headers[0], '200') !== false) {
        return true;
    }
    return false;
}
?>