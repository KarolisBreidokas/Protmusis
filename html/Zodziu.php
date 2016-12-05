<html>
	<head>
	<title>Viktorina: Testiniai klausimai</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?php
			session_start();
			if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
   				header("Refresh:1; Killall.php");
			}
			$conn = mysql_connect($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpass']);
			if(!$conn) {
				header("Refresh: 1; url=Killall.php");
				die('Could not connect: ' . mysql_error());
			}
			mysql_set_charset("UTF8", $conn);
			mysql_select_db($_SESSION['db'], $conn);
			$Kn=mysql_result(mysql_query("SELECT Kn FROM ServerInfo",$conn),0,0);
			if(isset($_POST['add'])) {
				if($Kn<>0){
					$sql="CALL send (".$_SESSION['id'].",".$Kn.",1,\"".mysql_real_escape_string($_POST['Ats'])."\")";
					if($mysqli->query($sql)){
						echo "good";
					}
					else echo "bad: ".mysqli_error($mysqli);
			}else {
				$sql="SELECT Klausimas FROM Info.Klausimai_Zodziu WHERE  Nr='$Kn'";
				if ($result = $mysqli->query($sql))
				{
					$row=$result->fetch_row();
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
