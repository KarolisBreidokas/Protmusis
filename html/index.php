<html>
	<head>
  	<title>Prisijungimas prie vartotojo sistemos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<?php
	ini_set('display_errors', 'On');
	include 'Admin/connections.php';
	session_start();
	// ignore login screen if already loged in
	if(isset($_SESSION['dbuser'])){
		header("Refresh: 1; url=Client.php");
		die("Palaukite");
	}
	if(isset($_POST['add'])){
		//add info to session
		$_SESSION['dbuser']=$_POST['username'];
		$_SESSION['dbpass']=$_POST['password'];
		$_SESSION['db']="Info";
		$_SESSION['dbhost']=$_SERVER['SERVER_ADDR'];
		$mysqli=ClientConnect();
	}else{
	?>
		<form id='login' action="<?php $_PHP_SELF ?>" method='post' accept-charset='UTF-8'>
		<fieldset >
		<legend>Prisijungimas prie protmušio sistemos</legend>
		<label for='username' >Vartotojo vardas:</label>
		<input type='text' name='username' id='username'  maxlength="50" />
		<label for='password' >Slaptažodis:</label>
		<input type='password' name='password' id='password' maxlength="50" />
		<input type='submit' name='add' id = 'add' value='Submit' />
		</fieldset>
		</form>
	<?php
	}
	?>
	</body>
</html>
