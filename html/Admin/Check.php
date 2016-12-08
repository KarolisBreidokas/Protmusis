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
			$st;
			if($_SESSION['dbuser']!="root"){
        echo "<script type='text/javascript'>alert('Tik turint root privilegijas How the f**k you got there');</script>";
        header("Refresh: 0; url=Loby.php");
      }
      $mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
      //check connection
      if(mysqli_connect_errno()){
        header("Refresh: 2; url=Killall.php");
        die("neprisijungta: ".$mysqli->connect_error);
      }
      $mysqli->set_charset("UTF8");
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
			$sql="SELECT * FROM ".$Table[$_SESSION['Kt']]." WHERE Nr=".$_SESSION['Kn'];
			$ret= $mysqli->query($sql);
			if(!$ret){
				die('Klaida: ');
			}
			$row=$ret->fetch_row();
			echo "<p>Klausimas: ".$row['1']."</p>";
			echo "<p>Atsakymas: ".$row['2']."</p>";
			$sql = "SELECT Ko,Ats,Teis FROM Atsakymai WHERE Nr=".$_SESSION['Kn']." AND Type=".$_SESSION['Kt']." ORDER BY Ko";
			$retval = $mysqli->query( $sql);
			if(!$retval){
				die('Klaida: ' . $sql);
			}
			if(isset($_POST['Vert'])){
				foreach ($st as $key => $value) {
					$id=$value['0'];
					$sql="UPDATE Atsakymai SET Teis=".$_POST[$i]." WHERE Nr=".$_SESSION['Kn']." AND Type=".$_SESSION['Kt']." AND Ko=".$id;
					$query=$mysqli->query($sql,$conn);
					if(!$query){
						die ("Klaida ".mysql_error());
					}
				}
				header("Refresh: 0; url=Check.php");
			}else{
				if($retval->num_rows>0){
		?>
		<form action="<?php $_PHP_SELF ?>" method="post">
			<table width = "400" border = "1" cellspacing = "1" cellpadding = "2">
				<tr>
					<th width="70%">Atsakymas</th>
					<th colspan="3">Vertinimas</th>
				</tr>
				<?php

					while ($row=$retval->fetch_row()) {
						$st[$row['0']]=$row;
						echo "<tr>";
						echo "<td>".$row['1']."</td>";
						echo "<td>".$row['2']."</td>";
						echo "<td><input name=\"".$n."\" type=\"radio\" ";
						$n++;
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
		else{
				echo "Nėra atsakymų";
		}
	}
		?>
  </body>
</html>
