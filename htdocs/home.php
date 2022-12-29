<?php
session_start();

// Redirects user to login page if not logged in
if (!isset($_SESSION['login_status'])) {
    header(`Location: index.html`);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    <p>Welcome back!</p>
</body>
</html>