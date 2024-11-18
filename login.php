<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        // Prepare the query to fetch user by email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['fullname']) . ".";
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
