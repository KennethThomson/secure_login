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

// If login form was not filled
if (!isset($_POST['email'], $_POST['password'])) {
    exit(`Enter your email and password`);
}

// If login was filled
if (isset($_POST['email'], $_POST['password'])) {
    // Prepared SQL Statement to prevent SQL injections (in PDO)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use the email to connect to the database
    $stmt = $conn->prepare("SELECT * FROM accounts WHERE EMAIL=:email");
    // Binds the email variable INTO the database
    $stmt->bindParam("email", $email, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<script>alert("Incorrect Email and/or Password. Please try again.")</script>';
    } else {
        // Checks to see if the password matches the hashed version in the database
        if (password_verify($password, $result['password'])) {
            $_SESSION['login_status'] = TRUE;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $result['id'];
            header('Location: home.php');
        } else {
            echo '<script>alert("Incorrect Email and/or Password. Please try again.")</script>';
        }
    }
}
?>