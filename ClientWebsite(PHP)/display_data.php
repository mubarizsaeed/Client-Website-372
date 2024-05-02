<?php
require_once 'db_connect.php';

// Retrieve data from the database
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    $users = $stmt->fetchAll();
    foreach ($users as $user) {
        echo '<p>Username: ' . $user['username'] . '</p>';
    }
} else {
    echo '<p>No user data found.</p>';
}
?>