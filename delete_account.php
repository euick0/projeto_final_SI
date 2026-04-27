<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: answers.php');
    exit();
}

$connection = mysqli_connect('localhost', 'root');

if (!$connection) {
    header('Location: answers.php');
    exit();
}

mysqli_select_db($connection, 'projetoFinalSI');

$userId = (int) $_SESSION['user_id'];
$result = mysqli_query($connection, "DELETE FROM user WHERE id = $userId");
mysqli_close($connection);

if (!$result) {
    header('Location: answers.php');
    exit();
}

session_unset();
session_destroy();
header('Location: index.html');
exit();
