<?php
// Start and destroy a session
session_start();
session_destroy();

// Redirect to login page
header('Location: index.html');
?>