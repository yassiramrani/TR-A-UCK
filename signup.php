
<?php
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $fullname = trim($_GET['fullname']);
    $email = trim($_GET['email']);
    $password = trim($_GET['password']);
    $cpassword = trim($_GET['confirm-password']);
    $time=time();

    // Validate passwords
    if ($password !== $cpassword) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hash the password
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement
    $sql = "INSERT INTO users (fullname, email, password_hash, created_at) 
            VALUES ('$fullname','$email', '$hash','$time')";

   
if ($conn->query($sql) === TRUE) {
    echo "
    <div style='
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        font-family: Arial, sans-serif; 
        background-color: #1B1B1B; 
        color: #FFF1E2;'>
        <div style='
            background-color: #555151; 
            padding: 20px; 
            border-radius: 10px; 
            text-align: center; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);'>
            <h2 style='color: #B76E2D;'>Inscription réussie!</h2>
            <p style='margin-bottom: 20px;'>Vous pouvez maintenant <a href='login.html' style='color: #FFF1E2; text-decoration: underline;'>vous connecter</a>.</p>
            <a href='login.html' style='
                display: inline-block; 
                padding: 10px 20px; 
                background-color: #B76E2D; 
                color: #1B1B1B; 
                border-radius: 5px; 
                text-decoration: none; 
                font-weight: bold; 
                transition: background-color 0.3s;'>Se connecter</a>
        </div>
    </div>";
} else {
    echo "<div style='
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        font-family: Arial, sans-serif; 
        background-color: #1B1B1B; 
        color: #FFF1E2;'>
        <div style='
            background-color: #555151; 
            padding: 20px; 
            border-radius: 10px; 
            text-align: center; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);'>
            <h2 style='color: red;'>Erreur</h2>
            <p>Une erreur est survenue lors de votre inscription. Veuillez réessayer.</p>
        </div>
    </div>";
}

    }
?>
