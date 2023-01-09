<?php
	session_start();
	require_once 'connect.php';
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `full_name` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "ID" => $user['ID'],
            "full_name" => $user['full_name'],
            "email" => $user['email']
        ];

        header('Location: ../main.php');

    } else {
        $_SESSION['message'] = 'Неправильний логін або пароль';
        header('Location: ../index.php');
    }
    ?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
?>