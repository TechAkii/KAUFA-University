<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "kaufa");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        header("Location: lms.html");
        exit();
    } else {
        header("Location: login.html?error=invalid_password");
        exit();
    }
} else {
    header("Location: login.html?error=user_not_found");
    exit();
}

$stmt->close();
$conn->close();
?>