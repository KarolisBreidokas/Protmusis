<html>
	<head>
	<title>Viktorina: Testiniai klausimai</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?php
			session_start();
			ini_set('display_errors', 'On');
			$mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
			// check connection
			if(mysqli_connect_errno()){
				header("Refresh: 2; url=Killall.php");
				die("neprisijungta: ".$mysqli->connect_error);
			}
			$mysqli->set_charset("UTF8");
			$sql="SELECT Kn,Kt FROM ServerInfo";
			if ($result = $mysqli->query($sql))
			{
				$row=$result->fetch_row();
				$Kn=$row['0'];
				$Kt=$row['1'];
				if($Kt<>"Testas"){
					header("Refresh: 0; url=Client.php");
				}
			}
			else{
				die("Klaida:");
			}
			if(isset($_POST['add'])) {
				if($Kn<>0){
					$sql="CALL send (".$_SESSION['id'].",".$Kn.",0,".$_POST['Ats'].")";
					if(!($mysqli->query($sql))){
						header("Refresh: 2; url=Client.php");
						die("Klaida");
					}
				}
				header("Refresh: 1; url=Wait.php");
				die("Įvesta teisingai");
			}else {
			$sql="SELECT Klausimas , A , B , C FROM Klausimai_Testas WHERE  Nr='$Kn'";
			if ($result = $mysqli->query($sql))
			{
				$row=$result->fetch_row();
		?>
		<h1>Viktorinos Testiniai klausimai</h1>
		<form method = "post" action = "<?php $_PHP_SELF ?>">
			<input name = "Ats" type = "radio" value=-1 checked="checked" style="display:none">
			<h3><?php echo $Kn.") ".$row['0']?> </h3>
			<p><input name = "Ats" type = "radio" value=1>A)<?php echo $row['1']?></p>
			<p><input name = "Ats" type = "radio" value=2>B)<?php echo $row['2']?></p>
			<p><input name = "Ats" type = "radio" value=3>C)<?php echo $row['3']?></p>
			<p><input id="Form" name = "add" type = "submit" id = "add" value = "Pateikti"></p>
		</form>
		<form method="LINK" action="Killall.php">
			<p><input type="submit" value="Atsijungti"></p>
		</form>
		<script type="text/javascript">
			var source = new EventSource('Admin/reset.php');
			source.onmessage = function(e) {
				document.getElementById("Form").click();
			};
		</script>
		<?php
			}
			else{
				die("Klaida:1");
			}
			}
		?>
	</body>
</html>
