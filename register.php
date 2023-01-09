<?php
	session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Авторізація та регестрація</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body id="body1">
	
	<form action="signup.php" method="post">
		<label>Логін</label>
		<input type="text" name="login" placeholder="Введіть повне ім'я">
		<label>Пошта</label>
		<input type="text" name="email" placeholder="Введіть пошту">
		<label>Пароль</label>
		<input type="password" name="password" placeholder="Введіть пароль">
		<label>Підтвердження паролю</label>
		<input type="password" name="password_confirm" placeholder="Підтвердіть пароль">
		<button>Регестрація</button>
		<p>
			Є аккаунт? - <a href="index.php"> Увійти</a>
		</p>
		<?php
			if($_SESSION['message']){
				echo '<p class="msg">'.$_SESSION['message'] .'</p>';
			}
			unset($_SESSION['message']);
		?>


		
	</form>
</body>
</html>