<?php
$host = '127.0.0.1';
$user = 'root';
$password = 'Chickibrickipalchickvicken1!@';
$db = 'todo_db';

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo " <script> console.log('База данных $db создана или уже существует.'); </script>";
} else {
    die("Ошибка создания базы данных: " . $conn->error);
}

$conn->select_db($db);

$sql = "CREATE TABLE IF NOT EXISTS products (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
price INT NOT NULL,
image VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo " <script> console.log('Таблица products создана или уже существует.');</script>";
} else {
    die("Ошибка создания таблицы products: " . $conn->error);
}

$result = $conn->query("SELECT COUNT(*) as cnt FROM products");
$row = $result->fetch_assoc();
if ($row['cnt'] == 0) {
    $conn->query("INSERT INTO products (name,price,image) VALUES
    ('Детская кровать «Bunny»', 23000,'img/products/product1.jpg'),
    ('Подростковая кровать «London»', 25990,'img/products/product2.jpg'),
    ('Односпальная кровать «Hope»', 27990,'img/products/product3.jpg'),
    ('Двуспальная кровать «Fantasy»', 39000,'img/products/product4.jpg')
");
    echo "<script> console.log('Данные успешно добавлены в таблицу products.'); </script>";
} else {
    echo "<script> console.log('Данные в таблице products уже существуют.'); </script>";
}


$sql = "CREATE TABLE IF NOT EXISTS news(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
description TEXT NOT NULL,
image VARCHAR(255) NOT NULL,
published_at DATETIME NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "<script> console.log('Таблица news успешно создана или уже существует.');</script>";
} else {
    die("Ошибка создания таблицы: " . $conn->error);
}

$result = $conn->query("SELECT COUNT(*) as cnt FROM news");
$row = $result->fetch_assoc();
if ($row['cnt'] == 0) {
    $conn->query(" INSERT INTO news (title,description,image,published_at) VALUES
    ('5 факторов, определяющих стоимость ремонта мягкой мебели','Почему у одних дешево а у других нет? ...','img/news/news1.jpg','2022-09-23 15:30:00'),
    ('Плюсы и минусы мебели-трансформера','Многие наверняка сталкивались с проблемой выбора ...','img/news/news2.jpg','2022-09-23 15:30:00'),
    ('Разбираемся в мебельных тканях','Жаккард, замша, экокожа или шенилл. Как и зачем выбирать подходяющу ...','img/news/news3.jpg','2022-09-23 15:30:00'),
    ('Восстановление или покупка?','Жить или не жить вот в чем вопрос ...','img/news/news4.jpg', '2022-09-23 15:30:00')
    ");
    echo "<script> console.log('Данные успешно добавлены в таблицу news.'); </script>";
} else {
    echo "<script> console.log('Данные в таблице news уже существуют.'); </script>";
}

$sql = "CREATE TABLE IF NOT EXISTS users(
id int AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
surname VARCHAR(255) NOT NULL,
phone VARCHAR(20) NOT NULL,
login VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "<script> console.log('Таблица users успешно создана или уже существует.');</script>";

} else {
    die('Ошибка создания таблицы users: ' . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS job_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    tel VARCHAR(32) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    // ok
} else {
    die('Ошибка создания таблицы job_applications: ' . $conn->error);
}