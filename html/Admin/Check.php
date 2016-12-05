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
	  	$conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION["dbuser"], $_SESSION["dbpass"]);
			if(! $conn ) {
				header("Refresh: 2; url=Killall.php");
				die('Could not connect: ' . mysql_error());
			}
			mysql_set_charset("UTF8", $conn);
	  	mysql_select_db($_SESSION['db'], $conn);
			$Table = array('1' => "Klausimai_Zodziu",
										 '2' => "Klausimai_Vaizdo",
										);
			if(!isset($_SESSION['Kt'])){
				$_SESSION['Kt']=1;
				$_SESSION['Kn']=1;
			}
	  ?>
		<form method = "post" action = "<?php $_PHP_SELF ?>" >
			<table width = "500" border = "1" cellspacing = "1" cellpadding = "2">
				<tr>
					<td >Klausimo numeris</td>
					<td><input id="my" name="Kn" type="number" value="<?php echo $_SESSION['Kn'] ?>" step="1" min="0" max="100"></td>
				</tr>
				<tr>
					<td rowspan="2" width="100">Klausimo tipas</td>
					<td ><input name="Kt" type="radio" <?php if($_SESSION['Kt']==1) echo "checked "; ?> value="1">Klausimai žodžiu</td>
				</tr>
				<tr>
					<td><input name="Kt" type="radio" <?php if($_SESSION['Kt']==2) echo "checked "; ?> value="2">Vaizdo klausimai</td>
				</tr>
				<tr>
					<td></td>
					<td><input name="update" type="submit" value="Pateikti"></td>

				</tr>
			</table>
		</form>
		<p><a href="Loby.php"><button>Pahrindinis meniu</button></a></p>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
		<?php
			if(isset($_POST['update'])){
				$_SESSION['Kn']=$_POST['Kn'];
				$_SESSION['Kt']=$_POST['Kt'];
				header("Refresh: 0; url=Check.php");
			}
			echo $_SESSION['Kn']."<br>".$_SESSION['Kt']."<br>";
			$sqli="SELECT * FROM ".$Table[$_SESSION['Kt']]." WHERE Nr=".$_SESSION['Kn'];
			$ret= mysql_query($sqli,$conn);
			if(!$ret){
				die('Klaida: ' . $sqli);
			}
			echo "<p>Klausimas: ".mysql_result($ret,0,1)."</p>";
			echo "<p>Atsakymas: ".mysql_result($ret,0,2)."</p>";
			$sql = "SELECT Ko,Ats,Teis FROM Atsakymai WHERE Nr=".$_SESSION['Kn']." AND Type=".$_SESSION['Kt']." ORDER BY Ko";
			$retval = mysql_query( $sql, $conn );
			if(!$retval){
				die('Klaida: ' . $sql);
			}
			if(isset($_POST['Vert'])){
				for ($i=0; $i < mysql_num_rows($retval); $i++) {
					$id=mysql_result($retval,$i,0);
					$sql="UPDATE Atsakymai SET Teis=".$_POST[$i]." WHERE Nr=".$_SESSION['Kn']." AND Type=".$_SESSION['Kt']." AND Ko=".$id;
					$query=mysql_query($sql,$conn);
					if(!$query){
						die ("Klaida ".mysql_error());
					}
				}
				header("Refresh: 0; url=Check.php");
			}else{
		?>
		<form action="<?php $_PHP_SELF ?>" method="post">
			<table width = "400" border = "1" cellspacing = "1" cellpadding = "2">
				<tr>
					<th width="70%">Atsakymas</th>
					<th colspan="3">Vertinimas</th>
				</tr>
				<?php
					for ($i=0; $i < mysql_num_rows($retval); $i++) {
						echo "<tr>";
						echo "<td>".mysql_result($retval,$i,1)."</td>";
						echo "<td>".mysql_result($retval,$i,2)."</td>";
						echo "<td><input name=\"".$i."\" type=\"radio\" ";
						if(mysql_result($retval,$i,2)==1) echo "checked";
						echo " value=1>1</td>";
						echo "<td><input name=\"".$i."\" type=\"radio\" ";
						if(mysql_result($retval,$i,2)==0) echo "checked";
						echo " value=0>0</td>";
						echo "</tr>";
					}
				?>
				<tr>
					<td></td>
					<td colspan="3"><input name="Vert" type="submit" value="Pateikti"></td>
				</tr>
			</table>
		</form>
		<?php
			}
		?>
  </body>
</html>
