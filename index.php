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
	
	<form id="f2" action="signin.php" method="post">
		<label>Логін</label>
		<input id="i1" type="text" name="login" placeholder="Введіть повне ім'я">
		<label>Пароль</label>
		<input id="i2" type="password" name="password" placeholder="Введіть пароль">
		<button type="submit">Увійти</button>
		<p>
			Немає аккаунта? - <a href="register.php"> зарегеструйтесь</a>
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