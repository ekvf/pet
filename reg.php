<h1>Регистрация</h1>
 <form method="POST"> 
  	<p><input type="text" name="login" value="">Логин</p>
  	<p><input type="text" name="password" value="">Пароль</p>
  	<p><input type="text" name="Phone_number" value="">Номер телефона</p>
  	<p><input type="text" name="Name" value="">Имя</p>
  	<p><input type="text" name="Surname" value="">Фамилия</p>
  	<p><input type="text" name="Address" value="">Адрес</p>
  	<p><input type="submit"></p>
 </form>
 	<a href='auth.php'>Войти</a>
 <?php
 
 if (isset($_POST['login'])) {
 	require_once 'config.php';
 	$connect = mysqli_connect($dbhost, $dbuser, $dbpassword, $database) or die("Connection Error: " . mysqli_error($connect ));
 	if ((trim($_POST['login']) == '') or (trim($_POST['password']) == '') or (trim($_POST['Phone_number']) == '') or (trim($_POST['Name']) == '') or (trim($_POST['Surname']) == '') or (trim($_POST['Address']) == '') )
 	{
	 	die("<h2>Пустое поле</h2>");
 	}
 	
	$login=mysqli_real_escape_string($connect,trim($_POST['login']));
	$pass = hash('sha256', trim($_POST['password']));
	$SQL="SELECT * FROM `Client` WHERE `login` = '$login'";// AND `pass` = '$pass'";
	$check_user = mysqli_query($connect,$SQL) or die("Connection Error: " . mysqli_error($connect));
	if (mysqli_num_rows($check_user) > 0) {
		echo "<h2>Такой пользователь уже есть</h2>";
	} else {
		$SQL="INSERT INTO `Client` (`login`, `password`) VALUES ( '$login', '$pass');";
		$insert=mysqli_query($connect,$SQL) or die("Connection Error: " . mysqli_error($connect));
		if (!$insert) 
		{
			$_SESSION["messageSQL"]=mysqli_error($connect);
		} 
		else
		{
			echo "<h2>Учётная запись создана</h2>";
		}
	}
 }
