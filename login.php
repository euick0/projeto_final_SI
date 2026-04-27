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

if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('Acesso inválido.');
}

$connection = mysqli_connect('localhost', 'root');

if (!$connection) {
    redirect_with_error('Erro de ligação à base de dados: ' . mysqli_connect_error());
}

mysqli_select_db($connection, 'projetoFinalSI');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$query = "select id, name, password from user where email = '$email'";
$result = mysqli_query($connection, $query);

if (!$result) {
    redirect_with_error('Erro na consulta: ' . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($result);

if (!$row || !password_verify($password, $row['password'])) {
    redirect_with_error('Credenciais inválidas. Verifica o email e a password.');
}

$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $row['id'];
$_SESSION['email'] = $email;
$_SESSION['name'] = $row['name'];

header('Location: answers.php');
exit();
?>