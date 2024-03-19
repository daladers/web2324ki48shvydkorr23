<?php
$host = 'localhost';
$db   = 'business_card_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$message = $_REQUEST["message"];

$sql = "INSERT INTO responce_table (name, email, message) VALUES (:name, :email, :message)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);
echo "Thank you, $name. We received your message and will contact you at $email.";
?>