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
mysqli_select_db($connection, 'projetoFinalSI');

if ($connection) {
    $userId = (int) $_SESSION['user_id'];
    mysqli_query($connection, "DELETE FROM user WHERE id = $userId");
    mysqli_close($connection);
}

session_unset();
session_destroy();
header('Location: index.html');
exit();
