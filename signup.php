<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "kaufa");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

if (empty($email) || empty($password)) {
    header("Location: signup.html?error=empty_fields");
    exit();
}

if ($password !== $confirm_password) {
    header("Location: signup.html?error=password_mismatch");
    exit();
}

/* 🔍 CHECK IF EMAIL EXISTS */
$check = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($check);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: signup.html?error=email_exists");
    exit();
}

$stmt->close();

/* 🔐 HASH PASSWORD */
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

/* ➕ INSERT USER */
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashedPassword);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: signup.html?success=1");
exit();
?>