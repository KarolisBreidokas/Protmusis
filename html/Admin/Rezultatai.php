<html>
  <head>
    <title>Rezultatų lentė</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php
      session_start();
      $conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION["dbuser"], $_SESSION["dbpass"]);
			if(!$conn) {
				header("Refresh: 1; url=Killall.php");
				die('Could not connect: ' . mysql_error());
			}
      mysql_set_charset("UTF8", $conn);
			mysql_select_db($_SESSION['db'], $conn);
      $sql = "SELECT Pav AS Komanda,Teisingai FROM Komandos AS a LEFT JOIN
              (SELECT Ko,Count(*) AS Teisingai FROM Atsakymai WHERE Teis=1 GROUP BY Ko) as b ON a.Nr=b.Ko
              WHERE Pav<>\"root\" ORDER BY Teisingai DESC";
      $retval = mysql_query( $sql, $conn );
      if(! $retval ) {
        die(mysql_error());
      }
      if(mysql_num_rows($retval)==0){
        echo "Komandų nėra";
      }else{
    ?>
    <table width = "500" border = "1" cellspacing = "1" cellpadding = "2">
      <?php
        for ($a=0; $a <mysql_num_fields($retval) ; $a++) {
          echo "<th>".mysql_field_name($retval,$a)."</th>\n";
        }
        for ($i=0; $i < mysql_num_rows($retval) ; $i++) {
          $id=mysql_result($retval,$i,0);
          echo "<tr>\n";
          for ($a=0; $a <mysql_num_fields($retval) ; $a++) {
            echo "<td>".mysql_result($retval,$i,$a)."</td>\n";
          }
          echo "<tr>\n";
        }
      ?>
    </table>
    <p><a href="Loby.php"><button>Pahrindinis meniu</button></a></p>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
    <?php
      }
    ?>
  </body>
</html>
