<html>
	<head>
		<title>Komandos registracija</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<?php
		function query($sql,$conn){
			$query=mysql_query($sql,$conn);
			if(!$query){
				die ("Klaida ".mysql_error());
			}
		}
		session_start();
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
   			header("Refresh:1; Killall.php");
		}
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
		$conn = mysql_connect($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpass']);
		if(! $conn ) {
			header("Refresh: 2; url=Killall.php");
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset("UTF8", $conn);
		mysql_select_db($_SESSION['db'], $conn);
		if(isset($_POST['add'])){
			$username=mysql_real_escape_string($_POST['username']);
			$password=mysql_real_escape_string($_POST['password']);
			$password_rep=mysql_real_escape_string($_POST['password_rep']);
			$sqlr=mysql_query("SELECT COUNT(*) from Komandos where Pav=\"".$username."\"",$conn);
			if(mysql_result($sqlr,0,0)>0){
				header("Refresh: 1; url=Reg.php");
				die ("komandos pavadinimas jau paimtas");
			}
			if($password==$password_rep){
				$sql="GRANT USAGE ON *.* TO '".$username."'@'%' IDENTIFIED BY '".$password."';";
				query($sql,$conn);
				$sql="GRANT EXECUTE ON `Info.Send`.* TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT SELECT (Klausimas, Nr) ON `Info`.`Klausimai_Vaizdo` TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT INSERT (Ats, Nr, Type, Ko) ON `Info`.`Atsakymai` TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT SELECT (Klausimas, Nr) ON `Info`.`Klausimai_Zodziu` TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT SELECT ON `Info`.`ServerInfo` TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT SELECT (Klausimas, Nr, C, B, A) ON `Info`.`Klausimai_Testas` TO '".$username."'@'%';";
				query($sql,$conn);
				$sql="GRANT SELECT ON `Info`.`ServerInfo` TO '".$username."'@'%'";
				query($sql,$conn);
				$sql="INSERT INTO Komandos (Pav) VALUES ('".$username."')";
				query($sql,$conn);
				header("Refresh: 1; url=Reg.php");
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
	<p><a href="Loby.php"><button>Pahrindinis meniu</button></a></p>
	<p><a href="Killall.php"><button>Atsijungti</button></a></p>
	<?php
		}
	?>
	</body>
</html>
