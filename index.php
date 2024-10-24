<table>
  	<tr><td>
 	<form method="POST"> 
  		<p>POST
  		<p><input type="text" name="login" value=""></p>
  		<p><input type="text" name="password" value=""></p>
  		<p><input type="submit"></p>
 	</form>
 	</td><td>
  	<form method="GET"> 
  		<p>GET
  		<p><input type="text" name="login" value=""></p>
  		<p><input type="text" name="password" value=""></p>
  		<p><input type="submit"></p>
 	</form>
 </td></tr>
 </table>
<a href='auth.php'>Войти</a><br>
<a href="reg.php">Rегистрация</a>
<?php
echo "<h3>_GET</h3>";
foreach ($_GET as $key => $value) {
	echo "$key = $value<br>";
}

//echo $_GET['id'];

echo "<br><br>";
echo "<h3>_POST</h3>";
foreach ($_POST as $key => $value) {
echo "$key = $value<br>";
}
echo "<br><br>";
echo "<h3>_SERVER</h3>";

foreach ($_SERVER as $key => $value) {
echo "$key = $value<br>";
}
echo "<br><br>";
echo "<h3>_COOKIE</h3>";
foreach ($_COOKIE as $key => $value) {
echo "$key = $value<br>";



}

?>
