<?php
require_once 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Головна сторінка</title>
</head>
<body>
	<main>
		<header>
			SHulezhko Airlines
		</header>
		<nav id="menu">
	<a href="Airport.php">Квитки</a>
    <a href="Passenger.php">Пасажири</a>
    <a href="flight.php">Рейси</a>
		</nav>
		<article>
			<article id="a1">
		<p id="p1">Найдешевші авіабілети у будь-яку точку Землі</p>
		<a id="a2" href="search.php">Шукати квитки</a>
    		</article>
    		<article id="a3">
    		<p id="p2">Не проґавте гарні ціни</p>
    		<?php
    		$Email = "";
    		function getPosts()
            {
                $posts = array();
                $posts[2]= $_POST('Email');
            }
    		if(isset($_POST['Enter']))
            {
            $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
            if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['message'] = 'Неправильний email';
            }
            else{
            	$_SESSION['message'] = 'Скоро ви отримуєте перше повідомлення';

            }
	        }
            ?>  <form id="f3" action="main.php" method="post">
    			<input id="i3" type="text" name="Email" placeholder="Email address" value="<?php echo $Email;?>">
    			<div>  
    			<input id="i3"  type="submit" name="Enter" value="Отримувати розсилку">
    			</div>
    			<?php
    			if($_SESSION['message']){
		    	echo '<p class="mainmsg">'.$_SESSION['message'] .'</p>';
		        } unset($_SESSION['message']);
    			?>
    			</form>
    		</article>
		</article>
		<footer>
			Rgr
		</footer>
	</main>
	
</body>
</html>