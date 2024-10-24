<?php 
require_once 'config.php';
$connect = mysqli_connect($dbhost, $dbuser, $dbpassword, $database) or die("Connection Error: " . mysqli_error($connect));
if (isset($_GET['logout'])) {
	setcookie("hash", "", time() - 3600);
	header('Location: auth.php');
	
} else if (!empty($_COOKIE['hash'])) {
	
	$hash=mysqli_real_escape_string($connect,$_COOKIE['hash']);
 	$SQL="SELECT * FROM `Client` WHERE `hash` = '$hash' limit 1";
 	$check_user = mysqli_query($connect,$SQL) or die("Connection SQL: " . mysqli_error($connect));
 	while ($row = mysqli_fetch_array($check_user, MYSQLI_ASSOC)) {
    			$id_user=$row['Client_ID'];
    			die("<h2>Привет, {$row['login']}</h2><a href='?logout'>Выйти</a>");
		}
} else if (isset($_POST['login'])) {
	$login=mysqli_real_escape_string($connect,trim($_POST['login']));
	$pass = hash('sha256', trim($_POST['password']));
	$SQL="SELECT * FROM `Client` WHERE `login` = '$login' AND `password` = '$pass' limit 1";
	$check_user = mysqli_query($connect,$SQL) or die("Connection SQL: " . mysqli_error($connect));
	if (mysqli_num_rows($check_user) > 0) {
		$hash=hash('sha256', trim($_POST['password'].trim($_POST['login'].time())));
		
		while ($row = mysqli_fetch_array($check_user, MYSQLI_ASSOC)) {
    			$id_user=$row['Client_ID'];
		}
		//die()
		$SQL="UPDATE `Client` SET `hash` = '$hash' where id='$id_user'";
		mysqli_query($connect,$SQL) or die("Connection SQL: " . mysqli_error($connect));
		setcookie('hash', $hash, time()+3600);
		header('Location: auth.php');
	} else {
		echo "<h2>Логин и пароль не верен</h2>";
	}
 } else 
 echo '<h1>Вход</h1>
 <form method="POST"> 
  	<p><input type="text" name="login" value=""></p>
  	<p><input type="text" name="password" value=""></p>
  	<p><input type="submit"></p>
 </form><a href="reg.php">регистрация</a>';

?>
