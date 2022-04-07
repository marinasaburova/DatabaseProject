<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['emploggedin'])) {
    header('Location: ../index.html');
    exit;
}
