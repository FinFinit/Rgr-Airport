<?php

    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`ID`, `full_name`, `Email`, `password`) VALUES (NULL, '$login', '$Email', '$password')");

        $_SESSION['message'] = 'Регістрація пройшла успішно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Паролі не співпадають';
        header('Location: ../register.php');
    }

?>