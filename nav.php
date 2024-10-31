<?php @session_start();
        if(isset($_SESSION['Username']) && $_SESSION['Username']) {
            include 'navLoggedIn.php';
        } else {
            include 'navLoggedOut.php';
        }
?>