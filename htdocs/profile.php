<?php
session_start();

// Redirects user to login page if not logged in
if (!isset($_SESSION['login_status'])) {
    header(`Location: index.html`);
    exit;
}

// Database Credentials (change the values accordingly)
$HOST = "localhost";
$DATABASE = "myDB";
$USER = "root";
$PASSWORD = "";
$PORT = "3307";

// Connect to the database (using PDO)
try {
    $conn = new PDO("mysql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
} catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

// Use the account ID to get the account info
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id =:id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>