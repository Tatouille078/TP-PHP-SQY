<?php include 'components/header.php'; ?>

<?php
// Démarrer la session PHP
session_start();

// Informations de connexion à la base de données
$host = 'localhost';  // Adresse de ton serveur MySQL
$dbname = 'tpphp';  // Nom de ta base de données
$username = 'root';  // Ton nom d'utilisateur
$password = '';  // Ton mot de passe

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer la requête pour vérifier l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, stocker l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Rediriger vers une autre page, comme un tableau de bord
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<div class="w-full h-full flex justify-center items-center pt-22">
    <form action="">
        <div class="p-4 flex flex-col justify-center items-center text-md gap-y-4">
            <p class="text-xl text-sky-800 py-2"><b>Login</b></p>
            <span class="h-[2px] bg-zinc-300 w-full mb-4"></span>
            <div class="flex flex-col gap-y-1 justify-center items-start text-md py-1">
                <p class="pl-2">Username:</p>
                <input type="text" name="username" placeholder="Username..." class="bg-gradient-to-r from-white to-zinc-100 border border-zinc-300 text-md rounded-lg px-2 py-1">
            </div>
            <div class="flex flex-col gap-y-1 justify-center items-start text-md py-1">
                <p class="pl-2">Mot de passe:</p>
                <input type="password" placeholder="Mot de passe..." class="bg-gradient-to-r from-white to-zinc-100 border border-zinc-300 text-md rounded-lg px-2 py-1">
            </div>
            <button type="submit" name="password" class="cursor-pointer bg-zinc-50 border border-zinc-300 hover:bg-sky-700 transition-all hover:border-sky-800 hover:text-white w-full rounded-lg mt-6">Se connecter</button>
        </div>
    </form>
</div>