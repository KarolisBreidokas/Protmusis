<html>
	<head>
		<title>Viktorina: Testiniai klausimai</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?php
		session_start();
		include 'Admin/connections.php';
		ini_set('display_errors', 'On');
		$mysqli = ClientConnect();
		$sql="SELECT Kn,Kt FROM ServerInfo";
		if ($result = $mysqli->query($sql))
		{
			$row=$result->fetch_row();
			$Kn=$row['0'];
			$Kt=$row['1'];
			if($Kt<>"Zodziu"){
				header("Refresh: 0; url=Client.php");
			}
		}else{
			die("Klaida:".$mysqli->error);
		}
			if(isset($_POST['add'])) {
				if($Kn<>0){
					$sql="CALL send (".$_SESSION['id'].",".$Kn.",1,\"".mysql_real_escape_string($_POST['Ats'])."\")";
					if(!($mysqli->query($sql))){
						header("Refresh: 2; url=Wait.php");
					  die( "bad: ".mysqli_error($mysqli));
				 }
			 }
			 header("Refresh: 1; url=Wait.php");
				die("Įvesta teisingai");
			}else {
				$sql="SELECT Klausimas FROM Klausimai_Zodziu WHERE Nr='$Kn'";
				if ($result = $mysqli->query($sql))
				{
					$row=$result->fetch_row();
				}
		?>
		<h1>Viktorinos Klausimai Žodžiu</h1>
		<form id="zod" method = "post" action = "<?php $_PHP_SELF ?>">
			<h3><?php echo $Kn.") ".$row[0]?> </h3>
			<textarea rows="4" cols="50" form="zod" name="Ats" autofocus></textarea>
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
		?>
	</body>
</html>
