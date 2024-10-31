<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
}
?>