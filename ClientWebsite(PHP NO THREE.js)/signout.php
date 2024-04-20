<?php
$_SESSION = [];                                      // Clear contents of array   


$params = session_get_cookie_params();               // Get session cookie parameters
setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'],
    $params['secure'], $params['httponly']);         // Delete session cookie


session_destroy();                                   // Delete session file
header("Location: login.php");
exit();


?>