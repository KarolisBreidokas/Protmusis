<html>
	<head>
		<title>Prisijungimas prie vartotojo sistemos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<?php
			session_start();
			if(isset($_SESSION['dbuser'])==true){
				header("Refresh: 1; url=Loby.php");
				die("Palaukite");
			}
	 		if(isset($_POST['add'])){
				$_SESSION['dbuser']=$_POST['username'];
				$_SESSION['dbpass']=$_POST['password'];
				$_SESSION['db']="Info";
				$_SESSION['dbhost']=$_SERVER['SERVER_ADDR'];
				$conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION['dbuser'], $_SESSION['dbpass']);
				if(! $conn ) {
					header("Refresh: 2; url=Killall.php");
					die('Could not connect: ' . mysql_error());
				}
				mysql_set_charset("UTF8", $conn);
				mysql_select_db($_SESSION['db'], $conn);
				$_SESSION['id']=mysql_result(mysql_query("SELECT Nr FROM Admins WHERE Pav=\"".$_SESSION['dbuser']."\"",$conn),0,0);
				if(is_null($_SESSION['id'])){
					header("Refresh: 2; url=Killall.php");
					die("Check Your privilege".mysql_error());
				}
				$_SESSION['Admin']=true;
				echo "Palaukite";
				header("Refresh: 1; url=Loby.php");
			}else{
		?>
		<form id='login' action="<?php $_PHP_SELF ?>" method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend>Prisijungimas prie Administratoriaus sistemos</legend>
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
