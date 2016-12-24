<html>
	<head>
		<title>Komandos registracija</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<?php
		function query($sql,$conn){
			$query=$conn->query($sql);
			if(!$query){
				die ("Klaida ".$mysqli->error);
			}
		}
		session_start();
		ini_set('display_errors', 'On');
		$mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
		// check connection
		if(mysqli_connect_errno()){
			header("Refresh: 2; url=Killall.php");
			die("neprisijungta: ".$mysqli->connect_error);
		}
		$mysqli->set_charset("UTF8");
		if(isset($_POST['add'])){
			$username=mysqli_real_escape_string($mysqli,$_POST['username']);
			$password=mysqli_real_escape_string($mysqli,$_POST['password']);
			$password_rep=mysqli_real_escape_string($mysqli,$_POST['password_rep']);
			$sqlr=$mysqli->query("SELECT COUNT(*) from Komandos where Pav=\"".$username."\"",$conn);
			$row=$sqlr->fetch_row();
			if($row['0']>0){
				header("Refresh: 1; url=Reg.php");
				die ("komandos pavadinimas jau paimtas");
			}
			if($password==$password_rep){
				$sql="GRANT USAGE ON *.* TO '".$username."'@'%' IDENTIFIED BY '".$password."';";
				query($sql,$mysqli);
				$sql="GRANT EXECUTE ON `Info.send`.* TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT SELECT (Klausimas, Nr) ON `Info`.`Klausimai_Vaizdo` TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT INSERT (Ats, Nr, Type, Ko) ON `Info`.`Atsakymai` TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT SELECT (Klausimas, Nr) ON `Info`.`Klausimai_Zodziu` TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT SELECT ON `Info`.`ServerInfo` TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT SELECT (Klausimas, Nr, C, B, A) ON `Info`.`Klausimai_Testas` TO '".$username."'@'%';";
				query($sql,$mysqli);
				$sql="GRANT SELECT ON `Info`.`ServerInfo` TO '".$username."'@'%'";
				query($sql,$mysqli);
				$sql="GRANT SELECT ON `Info`.`Komandos` TO '".$username."'@'%'";
				query($sql,$mysqli);
				$sql="INSERT INTO Komandos (Pav) VALUES ('".$username."')";
				query($sql,$mysqli);
				//header("Refresh: 1; url=Reg.php");
				die ("įvesta");
			}
		}else{
	?>
	<form id='reg' action="<?php $_PHP_SELF ?>" method='post' accept-charset='UTF-8'>
		<fieldset >
			<legend>Komandos registracija</legend>
			<label for='username' >Vartotojo Vardas:</label>
			<input type='text' name='username' id='username'  maxlength="50" />
			<label for='password' >Slaptažodis:</label>
			<input type='password' name='password' id='password' maxlength="50" />
			<label for='password_rep' >Pakartoti Slaptažodį:</label>
			<input type='password' name='password_rep' id='password_rep' maxlength="50" />
			<input type='submit' name='add' id = 'add' value='Submit' />
		</fieldset>
	</form>
	<p><a href="Loby.php"><button>Pagrindinis meniu</button></a></p>
	<p><a href="Killall.php"><button>Atsijungti</button></a></p>
	<?php
		}
	?>
	</body>
</html>
