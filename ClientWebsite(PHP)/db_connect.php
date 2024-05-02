<?php
$type = 'mysql'; // Type of database
$server = '192.185.2.183'; // Server the database is on
$db = 'mubarizs_users'; // Name of the database
$port = '3306'; // Port is usually 3306 in Cpanel
$charset = 'utf8mb4'; // UTF-8 encoding using 4 bytes of data per char
$username = 'mubarizs_users'; // Enter YOUR cPanel username and user here
$password = 'Hisoka514!'; // Enter YOUR user password here

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}
?>