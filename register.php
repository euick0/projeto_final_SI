<?php
session_start();

function redirect_with_error(string $message, string $type = 'danger'): void
{
    echo '<!DOCTYPE html><html><body>';
    echo '<form id="ef" method="post" action="index.php">';
    echo '<input type="hidden" name="message" value="' . htmlspecialchars($message, ENT_QUOTES) . '">';
    echo '<input type="hidden" name="type" value="' . htmlspecialchars($type, ENT_QUOTES) . '">';
    echo '</form>';
    echo '<script>document.getElementById("ef").submit();</script>';
    echo '</body></html>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('Acesso inválido.');
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    redirect_with_error('Email e password são obrigatórios.');
}

$connection = mysqli_connect('localhost', 'root');

if (!$connection) {
    redirect_with_error('Erro de ligação à base de dados: ' . mysqli_connect_error());
}

mysqli_select_db($connection, 'projetoFinalSI');

$name           = $name !== '' ? $name : 'Utilizador';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$addUserQuery       = "insert into user (name, email, password) values ('$name', '$email', '$hashedPassword')";
$resultAddUserQuery = mysqli_query($connection, $addUserQuery);

if (!$resultAddUserQuery) {
    redirect_with_error('Erro ao registar: ' . mysqli_error($connection));
}

$queryUserId  = "select id from user where email = '$email'";
$resultUserId = mysqli_query($connection, $queryUserId);

if (!$resultUserId) {
    redirect_with_error('Erro ao obter utilizador: ' . mysqli_error($connection));
}

$userId = mysqli_fetch_assoc($resultUserId)['id'];

$_SESSION['logged_in'] = true;
$_SESSION['user_id']   = $userId;
$_SESSION['email']     = $email;
$_SESSION['name']      = $name;

header('Location: answers.php');
exit();