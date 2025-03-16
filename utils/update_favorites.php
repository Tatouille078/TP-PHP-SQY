<?php

// On récupère les informations sur la BDD et la Session
session_start();
require_once '../config/pdo.php';

// On vérifie si jamais le user n'est pas connecter
if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
    exit;
}

$user_id = $_SESSION['id']; // Récupération de l'ID utilisateur
$data = json_decode(file_get_contents("php://input"), true);

// Partie servant à ajouter un book au favoris dans la BDD
if (isset($data["addFavorite"])) {
    
    $stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Si le user à déjà un row attribué dans la table
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $existing_books = $row['book_id'];
        $book_id = $data["addFavorite"];

        // Si le book_id n'est pas déjà dans la liste, on l'ajoute
        if (strpos($existing_books, $book_id) === false) {
            
            // On vérifie si on excède pas la limite de 20 books dans la table (Afin d'éviter des conflits avec le VARCHAR(255))
            if (count(explode(',', $existing_books)) >= 19) {
                echo json_encode(["success" => false, "message" => "Ne peut pas exceder 19 Favoris"]);
                exit;
            }

            // On concatène le nouveau book_id à la liste
            $new_books = $existing_books . ',' . $book_id;
            $updateStmt = $pdo->prepare("UPDATE favorites SET book_id = ? WHERE user_id = ?");
            if ($updateStmt->execute([$new_books, $user_id])) {
                echo json_encode(["success" => true, "message" => "Ajouté aux favoris!"]);
            } else {
                // Si jamais une erreur se produit durant l'envoit à la BDD
                echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout"]);
            }
        } else {
            // Si le livre est déjà dans les favoris
            echo json_encode(["success" => false, "message" => "Livre déjà dans vos favoris"]);
        }
    } else {
        // Si le user n'a pas encore de favoris, on lui fait un row dédié.
        $book_id = $data["addFavorite"];
        $stmt = $pdo->prepare("INSERT INTO favorites (user_id, book_id) VALUES (?,?)");
        if ($stmt->execute([$user_id, $book_id])) {
            echo json_encode(["success" => true, "message" => "Ajouté aux favoris!"]);
        }
    }
}

// Partie servant à supprimer un book des favoris dans la BDD
if (isset($data["removeFavorite"])) {
    $book_id_to_remove = $data["removeFavorite"];

    $stmt = $pdo->prepare("SELECT book_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Récupérer la liste des book_id existants dans la BDD
    $row = $stmt->fetch();
    $existing_books = explode(',', $row['book_id']);

    // Vérifier si le book_id est bien dans la liste
    if (($key = array_search($book_id_to_remove, $existing_books)) !== false) {
        unset($existing_books[$key]); // Supprimer le livre de la liste
        
        // Vérifie si le book_id est bien dans la BDD
        if (!empty($existing_books)) {
            $new_books = implode(',', $existing_books);
            $updateStmt = $pdo->prepare("UPDATE favorites SET book_id = ? WHERE user_id = ?");
            if ($updateStmt->execute([$new_books, $user_id])) {
                echo json_encode(["success" => true, "message" => "Favori supprimé avec succès"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
            }
        } else {
            // Si plus de livres dans les favoris, alors on supprimer le row de user
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

// Partie servant à récupérer les favoris d'un utilisateur dans la BDD
if (isset($data["requestFavorites"])) {
    $stmt = $pdo->prepare("SELECT book_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Récupérer la liste des book_id s'ils existent dans la BDD
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $book_ids = explode(',', $row['book_id']); // Convertir la chaîne en tableau

        echo json_encode(["success" => true, "books" => $book_ids]);
    } else {
    echo json_encode(["success" => false, "message" => "Aucun favori trouvé"]);
    }
}