<?php
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "<script>window.location.href = 'index.html';</script>";
    }

    session_start();

    $connection = mysqli_connect('localhost', 'root');
    mysqli_select_db($connection, 'projetoFinalSI');

    if (!$connection) {
        echo ("Connection failed: " . mysqli_connect_error());
        throw new Exception("");
    }

    $name = $_POST['name'] ?? 'Utilizador';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $addUserQuery = "insert into user (email, password) values ('$email', '$hashedPassword')";
    $resultAddUserQuery = mysqli_query($connection, $addUserQuery);

    if (!$resultAddUserQuery) {
        echo ("Error: " . mysqli_error($connection));
        throw new Exception("");
    }

    $queryUserId = "select id from user where email = '$email'";
    $resultUserId = mysqli_query($connection, $queryUserId);

    if (!$resultUserId) {
        echo ("Error: " . mysqli_error($connection));
        throw new Exception("");
    }

    $userId = mysqli_fetch_assoc($resultUserId)['id'];

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $userId;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;

    echo "<script>window.location.href = 'answers.php';</script>";

} catch (Exception $e) {
    echo ("Error: " . $e->getMessage());
}
?>