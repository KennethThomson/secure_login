<?php

session_start();

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

// Checks to see if form was submitted properly
if (!isset($_POST["username"], $_POST["password"], $_POST["email"])) {
    // Exits if form was not submitted properly
    exit("Please enter all the required information.");
}

// Checks to see if form was incomplete
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	exit('Please enter all the required information.');
}

// Checks to see if account with email exists
$email = $_POST['email'];
$username = $_POST['username'];


if ($stmt = $conn->prepare("SELECT * FROM accounts where email=:email")) {
    $stmt->bindParam("email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Email already exists
        echo '<script>alert("Account with email already exists. Please try again.")</script>';
    } else {
        // Create new account
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO accounts (username, password, email) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password, $email]);
        echo '<script>alert("You have successfuly registered. Welcome to Basil.")</script>';
    }
}
?>