<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Optionally, delete the session cookie (if used)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page or homepage
header('Location: login.php');
exit();
?>
