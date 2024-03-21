<?php
session_start();
header('Content-Type: application/json');

// Database connection data
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'users_db';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

if (!isset($_SESSION["user"])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET request
    $sql = "SELECT status FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user"]["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST request
    $status = $_POST['status'];
    $sql = "UPDATE users SET status = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $_SESSION["user"]["email"]);
    $stmt->execute();
    echo json_encode(['status' => 'success']);
}
?>