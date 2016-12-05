<html>
	<head>
	    <title>Prisijungimas prie vartotojo sistemos</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<?php
		ini_set('display_errors', 'On');
			session_start();
			// ignore login screen if already loged in
			if(isset($_SESSION['dbuser'])==true){
				header("Refresh: 1; url=Client.php");
				die("Palaukite");
			}
		 		if(isset($_POST['add'])){
					//add info to session
					$_SESSION['dbuser']=$_POST['username'];
					$_SESSION['dbpass']=$_POST['password'];
					$_SESSION['db']="Info";
					$_SESSION['dbhost']=$_SERVER['SERVER_ADDR'];
					$mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
					//check connection
					if(mysqli_connect_errno()){
						header("Refresh: 2; url=Killall.php");
						die("neprisijungta: ".$mysqli->connect_error);
					}
          $mysqli->set_charset("UTF8");
					$sql="SELECT Nr FROM Komandos";
					if ($result = $mysqli->query($sql))
					{
						$row=$result->fetch_row();
						$_SESSION['id']=$row['0'];
						header("Refresh: 1; url=Client.php");
					}
					else{
						die("Klaida:1");
					}

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
