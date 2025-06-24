<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

// CSRF protection
if (!isset($_SESSION['admin_csrf'])) {
    $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
}
?>