<html>
  <head>
    <title>Reddirect</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <?php
    ini_set('display_errors', 'On');
    include 'Admin/connections.php';
    session_start();
    $mysqli =Connect();
    $sql="SELECT Kt,reset FROM ServerInfo";
    if ($result = $mysqli->query($sql)){
      $row=$result->fetch_row();
      if($row['1']){
        header("Refresh:1; Wait.php");
        die("Palaukite");
      }
      $Kt=$row['0'];
      echo "Palaukite";
      if(!$Kt){
        die("error: ". $mysqli->error);
      }
      header("Refresh:1; ".$Kt.".php");
    }
    else{
      die("Klaida:".$mysqli->error);
    }
    ?>
  </body>
</html>
