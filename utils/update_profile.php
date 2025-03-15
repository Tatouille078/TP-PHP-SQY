<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
    exit;
}

$user_id = $_SESSION['user_id']; // Récupération de l'ID utilisateur
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username'])) {
    $username = trim($data['username']);

    // Vérification des contraintes
    if (strlen($username) < 4 || preg_match('/[^a-zA-Z0-9_]/', $username)) {
        echo json_encode(["success" => false, "message" => "Nom d'utilisateur invalide"]);
        exit;
    }

    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
    if ($stmt->execute([$username, $user_id])) {
        echo json_encode(["success" => true, "message" => "Nom d'utilisateur mis à jour"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
    }
}
?>