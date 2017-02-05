<html>
  <head>
    <title>Rezultatų lentė</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    $sql = "SELECT Pav AS Komanda,Teisingai FROM Komandos AS a LEFT JOIN
              (SELECT Ko,Count(*) AS Teisingai FROM Atsakymai WHERE Teis=1 GROUP BY Ko) as b ON a.Nr=b.Ko
              WHERE Pav<>\"root\" ORDER BY Teisingai DESC";
      $retval = $mysqli->query($sql);
      if(! $retval ) {
        die($mysqli->error);
      }
      if($retval->num_rows==0){
        echo "Komandų nėra";
      }else{
    ?>
    <table width = "500" border = "1" cellspacing = "1" cellpadding = "2">
      <?ph
        while ($row=$retval->fetch_field()) {
          echo "<th>".$row->name."</th>\n";
        }
        while ($row=$retval->fetch_row()) {
          echo "<tr>\n";
          foreach ($row as $key => $value) {
            echo "<td>".$value."</td>\n";
          }
          echo "</tr>\n";
        }
      ?>
    </table>
    <p><a href="Loby.php"><button>Pagrindinis meniu</button></a></p>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
    <?php
      }
    ?>
  </body>
</html>
