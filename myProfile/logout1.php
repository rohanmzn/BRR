<?php
// Ensure session is started before manipulating session variables
session_start();

// Unset all session variables
$_SESSION = array();

//to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the homepage or login page
echo "<script>window.location.href='../index.php';</script>";
?>