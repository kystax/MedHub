<?php
// Start a session
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'medhub';
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['username'] = $username;

        // Redirect to dashboard
        header('Location: ../dashboard/dashboard.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
