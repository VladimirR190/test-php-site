<?php

$host = '127.0.0.1';
$user = 'root';
$password = 'Chickibrickipalchickvicken1!@';
$db = 'todo_db';

$conn = new mysqli($host, $user, $password, $db);

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name'] ?? '');
$tel = trim($data['tel'] ?? '');
$email = trim($data['email'] ?? '');
$message = trim($data['message'] ?? '');

if (!$name || !$tel || !$email || !$message) {
    echo json_encode(['success' => false, 'error' => 'Заполните все поля']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO job_applications (name, tel, email, message, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param('ssss', $name, $tel, $email, $message);
if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Ошибка базы данных']);
    exit;
}

// Отправляем письмо пользователю

// PHPMailer SMTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'vovchickkc@yandex.ru';
    $mail->Password = 'wwhjkgoejwbfbxze';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';
    $mail->isHTML(false);
    $mail->setFrom('vovchickkc@yandex.ru', 'Fabrika');
    $mail->addAddress($email, $name);
    $mail->Subject = 'Ваша заявка успешно отправлена';
    $mail->Body = "Здравствуйте, $name!\n\nСпасибо за вашу заявку. Мы свяжемся с вами в ближайшее время.\n\nВаше сообщение: $message";
    $mail->send();
} catch (Exception $e) {
    // Можно залогировать ошибку, но не прерывать выполнение
}

echo json_encode(['success' => true]);