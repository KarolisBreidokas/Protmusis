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
			session_start();
			if(isset($_SESSION['Kt'])){
				unset($_SESSION['Kt']);
				unset($_SESSION['Kn']);
			}
			$conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION["dbuser"], $_SESSION["dbpass"]);
			if(!$conn) {
				header("Refresh: 1; url=Killall.php");
				die('Could not connect: ' . mysql_error());
			}
			mysql_set_charset("UTF8", $conn);
			mysql_select_db($_SESSION['db'], $conn);
			$retval = mysql_query("UPDATE ServerInfo SET reset=false", $conn );
			$Kn=mysql_result(mysql_query("SELECT Kn FROM ServerInfo",$conn),0,0);
			$Kt=mysql_result(mysql_query("SELECT Kt FROM ServerInfo",$conn),0,0);
			$rt=mysql_result(mysql_query("SELECT count(*) FROM Klausimai_Testas",$conn),0,0)-1;
			$rz=mysql_result(mysql_query("SELECT count(*) FROM Klausimai_Zodziu",$conn),0,0)-1;
			$rv=mysql_result(mysql_query("SELECT count(*) FROM Klausimai_Vaizdo",$conn),0,0)-1;
			if(isset($_POST['add'])){
				mysql_query( "UPDATE ServerInfo SET reset=true", $conn );
				sleep(3);
				mysql_query( "UPDATE ServerInfo SET reset=false", $conn );
				$sql = "UPDATE ServerInfo SET Kn= ".$_POST['Kn'].",Kt= \"".$_POST['Kt']."\"";
				$retval = mysql_query( $sql, $conn );
				if(!$retval ) {
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
				$result = mysql_query($sql, $conn);
				if(! $result )
				{
					die('Could not get data: ' . mysql_error());
				}
				if (mysql_num_rows($result) > 0) {
					for($a=0;$a<mysql_num_rows($result);$a++) {
						echo "<p>".mysql_result($result,$a,0)." ".mysql_result($result,$a,1)."</p>";
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
