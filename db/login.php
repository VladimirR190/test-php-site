<?php
session_start();
header('Content-Type: application/json');
$host = '127.0.0.1';
$user = 'root';
$password_db = 'Chickibrickipalchickvicken1!@';
$db = 'todo_db';
$conn = new mysqli($host, $user, $password_db, $db);

$data = json_decode(file_get_contents('php://input'), true);
$login = trim($data['login'] ?? '');
$password = trim($data['password'] ?? '');

if (!$login || !$password) {
    echo json_encode(['success' => false, 'error' => 'Заполните все поля']);
    exit;
}

$stmt = $conn->prepare('SELECT id, password FROM users WHERE login = ? LIMIT 1');
$stmt->bind_param('s', $login);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Неверный логин или пароль']);
}
$stmt->close();
$conn->close();
