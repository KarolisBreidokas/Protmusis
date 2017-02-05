<html>
  <head>
    <title>Reddirect</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <?php
    ini_set('display_errors', 'On');
    session_start();
    $mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
    //check connection
    if(mysqli_connect_errno()){
      header("Refresh: 2; url=Killall.php");
      die("neprisijungta: ".$mysqli->connect_error);
    }
    $mysqli->set_charset("UTF8");
    $sql="SELECT Kt,reset FROM ServerInfo";
    if ($result = $mysqli->query($sql)){
      $row=$result->fetch_row();
      if($row['1']){
        header("Refresh:3; Wait.php");
        die("Palaukite");
      }
      $Kt=$row['0'];
      echo "Palaukite";
      header("Refresh:3; ".$Kt.".php");
      if(!$Kt){
        die("error: ". $mysqli->error);
      }
    }
    else{
      die("Klaida:".$mysqli->error);
    }
    ?>
  </body>
</html>
