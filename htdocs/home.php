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
$stmt = $conn->prepare('SELECT password, username FROM accounts WHERE id =:id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div class="navbar">
        <img src="assets/logo.svg" alt="logo" />
    </div>
    <div class="info">
        <h2>welcome back, <?=$result["username"]?>!</h1>
        <p>here is your account information:
            <table>
					<tr>
						<td><span>email:</span></td>
						<td><?=$_SESSION['email']?></td>
					</tr>
					<tr>
						<td><span>password:</span></td>
						<td><?=$result["password"]?></td>
					</tr>
			</table>
        </p>
        <input type="submit" value="log out" name="logout" id="logout" onclick="window.location.href='logout.php'">
    </div>
</body>
</html>