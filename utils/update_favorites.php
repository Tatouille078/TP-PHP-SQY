<?php

session_start();
require_once '../config/pdo.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
    exit;
}

$user_id = $_SESSION['id']; // Récupération de l'ID utilisateur
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["addFavorite"])) {
    $stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $existing_books = $row['book_id'];
        $book_id = $data["addFavorite"];
        // Si le book_id n'est pas déjà dans la liste, on l'ajoute
        if (strpos($existing_books, $book_id) === false) {
            if (count(explode(',', $existing_books)) >= 20) {
                echo json_encode(["success" => false, "message" => "Ne peut pas exceder 20 Favoris"]);
                exit;
            }
            // On concatène le nouveau book_id à la liste
            $new_books = $existing_books . ',' . $book_id;
            $updateStmt = $pdo->prepare("UPDATE favorites SET book_id = ? WHERE user_id = ?");
            if ($updateStmt->execute([$new_books, $user_id])) {
                echo json_encode(["success" => true, "message" => "Ajouté aux favoris!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Livre déjà dans vos favoris"]);
        }
    } else {
        $book_id = $data["addFavorite"]; // Récupération de l'ID du livre
        $stmt = $pdo->prepare("INSERT INTO favorites (user_id, book_id) VALUES (?,?)");
        if ($stmt->execute([$user_id, $book_id])) {
            echo json_encode(["success" => true, "message" => "Ajouté aux favoris!"]);
        }
    }
}

if (isset($data["removeFavorite"])) {
    $book_id_to_remove = $data["removeFavorite"];

    $stmt = $pdo->prepare("SELECT book_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $row = $stmt->fetch();
    $existing_books = explode(',', $row['book_id']);

    // Vérifier si le book_id est bien dans la liste
    if (($key = array_search($book_id_to_remove, $existing_books)) !== false) {
        unset($existing_books[$key]); // Supprimer le livre de la liste
        
        if (!empty($existing_books)) {
            $new_books = implode(',', $existing_books);
            $updateStmt = $pdo->prepare("UPDATE favorites SET book_id = ? WHERE user_id = ?");
            if ($updateStmt->execute([$new_books, $user_id])) {
                echo json_encode(["success" => true, "message" => "Favori supprimé avec succès"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
            }
        } else {
            // Si plus de livres favoris, supprimer l'entrée
            $deleteStmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ?");
            if ($deleteStmt->execute([$user_id])) {
                echo json_encode(["success" => true, "message" => "Tous les favoris supprimés"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de la suppression"]);
            }
        }
    } else {
        echo json_encode(["success" => false, "message" => "Livre non trouvé dans les favoris"]);
    }
}

if (isset($data["requestFavorites"])) {
    $stmt = $pdo->prepare("SELECT book_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $book_ids = explode(',', $row['book_id']); // Convertir la chaîne en tableau

        echo json_encode(["success" => true, "books" => $book_ids]);
    } else {
    echo json_encode(["success" => false, "message" => "Aucun favori trouvé"]);
    }
}