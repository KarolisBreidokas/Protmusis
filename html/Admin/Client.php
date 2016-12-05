<html>
	<head>
		<title>Admin bustine</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="jquery.mousewheel.js"></script>
    <script type="text/javascript" src="scroll.js"></script>
	</head>
	<body>
		<?php
			ini_set('display_errors', 'On');
			session_start();
			// ignore login screen if already loged in
			if(isset($_SESSION['Kt'])){
				unset($_SESSION['Kt']);
				unset($_SESSION['Kn']);
			}
			$mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
			//check connection
			if(mysqli_connect_errno()){
				header("Refresh: 2; url=Killall.php");
				die("neprisijungta: ".$mysqli->connect_error);
			}
			$mysqli->set_charset("UTF8");
			$result = $mysqli->query("UPDATE ServerInfo SET reset=false");
			$fetch=$mysqli->query("SELECT Kn FROM ServerInfo");
			$Kn=$fetch->fetch_row()['0'];
			$fetch=$mysqli->query("SELECT Kt FROM ServerInfo");
			$Kt=$fetch->fetch_row()['0'];
			$fetch=$mysqli->query("SELECT count(*) FROM Klausimai_Testas");
			$rt=$fetch->fetch_row()['0']-1;
			$fetch=$mysqli->query("SELECT count(*) FROM Klausimai_Zodziu");
			$rz=$fetch->fetch_row()['0']-1;
			$fetch=$mysqli->query("SELECT count(*) FROM Klausimai_Vaizdo");
			$rv=$fetch->fetch_row()['0']-1;
			switch ($Kt) {
				case "Testas":
				  $rn=$rt;
					break;
				case 'Vaizdo':
					$rn=$rv;
					break;
				case 'Zodziu':
					$rn=$rz;
					break;
				default:
					$rn=0;
					break;
			}
			if(isset($_POST['add'])){
				$result = $mysqli->query("UPDATE ServerInfo SET reset=true");
				sleep(3);
				$result = $mysqli->query("UPDATE ServerInfo SET reset=false");
				$sql = "UPDATE ServerInfo SET Kn= ".$_POST['Kn'].",Kt= \"".$_POST['Kt']."\"";
				$result = $mysqli->query($sql);
				if(!$result) {
					echo "Klaida: ".mysql_error();
				}
				header("Refresh: 3; url=Client.php");
			}else{
		?>
		<form method = "post" action = "<?php $_PHP_SELF ?>">
			<table width = "500" border = "1" cellspacing = "1" cellpadding = "2">
				<tr>
					<td>Klausimo numeris</td>
					<td><input id="my" name="Kn" type="number" value="<?php echo $Kn?>" step=1 min="0" max=<?php echo $rn ?>></td>
					<td>Dabartinis</td>
					<td><?php echo $Kn ?></td>
				</tr>
				<tr>
					<td rowspan="3" width="100">Klausimo tipas</td>
					<td colspan="3"><input name="Kt" type="radio" <?php if($Kt=="Testas") echo 'checked="checked"'?> onclick="ct()" value="Testas">Testas</td>
				</tr>
				<tr>
					<td colspan="3"><input name="Kt" type="radio" <?php if($Kt=="Zodziu") echo 'checked="checked"'?> onclick="cz()" value="Zodziu">Klausimai žodžiu</td>
				</tr>
				<tr>
					<td colspan="3"><input name="Kt" type="radio" <?php if($Kt=="Vaizdo") echo 'checked="checked"'?> onclick="cv()" value="Vaizdo">Vaizdo klausimai</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td><input name="add" type="submit" value="Pateikti"></td>
					<td></td>
				</tr>
			</table>
		</form>
		<p><a href="Loby.php"><button>Pagrindinis meniu</button></a></p>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
		<?php
				$sql = "SELECT Nr, Pav FROM Komandos";
				$result = $mysqli->query($sql);
				if(! $result )
				{
					die('Could not get data: ' . mysql_error());
				}
				if ($result->field_count>0)
				{
					while ($row=$result->fetch_row()) {
						echo $row['0']." ".$row['1']."<bt>";
					}
				}
		?>
		<script type="text/javascript">
			function ct(){
				document.getElementById("my").max = <?php echo $rt ?>;
			}
			function cz(){
				document.getElementById("my").max = <?php echo $rz ?>;
			}
			function cv(){
				document.getElementById("my").max = <?php echo $rv ?>;
			}
		</script>
		<?php } ?>
	</body>
</html>
