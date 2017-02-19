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
			function FetchRow($mysqli,$sql){
				$fetch=$mysqli->query($sql);
				return $fetch->fetch_row()['0'];
			}
			ini_set('display_errors', 'On');
			include 'connections.php';
			session_start();
			if(isset($_SESSION['Kt'])){
				unset($_SESSION['Kt']);
				unset($_SESSION['Kn']);
			}
			$mysqli=Connect();
			$reset=FetchRow($mysqli,"SELECT reset FROM ServerInfo");
			$Kn=FetchRow($mysqli,"SELECT Kn FROM ServerInfo");
			$Kt=FetchRow($mysqli,"SELECT Kt FROM ServerInfo");
			$rn=FetchRow($mysqli,"SELECT count(*) FROM Klausimai_".$Kt)-1;
			if(isset($_POST['new'])){
				$result = $mysqli->query("UPDATE ServerInfo SET reset=true");
				$reset=true;
				if(!$result) {
					echo "Klaida: ".mysql_error();
				}
			}
			if($reset){
			if(isset($_POST['add'])){
					$sql = "UPDATE ServerInfo SET Kn= ".$_POST['Kn'].",Kt= \"".$_POST['Kt']."\",reset=false";
					$result = $mysqli->query($sql);
					if(!$result) {
						echo "Klaida: ".mysql_error();
					}
					header("Refresh: 100; url=Client.php");
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
		<?php
		}
		}else {
			?>
			<p><form action="<?php $_PHP_SELF ?>" method="post">
				<input type="submit" name="new" value="new">
			</form></p>
			<?php
		}
		?>
		<p><a href="Loby.php"><button>Pagrindinis meniu</button></a></p>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
		<?php
		?>

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
						echo $row['0']." ".$row['1']."<br>";
					}
				}
		?>
		<script type="text/javascript">
			function ct(){
				document.getElementById("my").max = <?php echo FetchRow($mysqli,"SELECT count(*) FROM Klausimai_Testas")-1; ?>;
			}
			function cz(){
				document.getElementById("my").max = <?php echo FetchRow($mysqli,"SELECT count(*) FROM Klausimai_Zodziu")-1; ?>;
			}
			function cv(){
				document.getElementById("my").max = <?php echo FetchRow($mysqli,"SELECT count(*) FROM Klausimai_Vaizdo")-1; ?>;
			}
		</script>
	</body>
</html>
