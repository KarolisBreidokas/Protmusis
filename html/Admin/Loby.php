
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Konslolė</title>
  </head>
  <body>
    <?php
      ini_set('display_errors', 'On');
      session_start();
      // ignore login screen if already loged in
      if(isset($_SESSION['Kt'])){
        unset($_SESSION['Kt']);
        unset($_SESSION['Kn']);
      }
      $mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
      //check connection
      if(mysqli_connect_errno()){
        header("Refresh: 2; url=Killall.php");
        die("neprisijungta: ".$mysqli->connect_error);
      }
      $sql="SELECT Nr FROM Admins WHERE Pav=\"".$_SESSION['dbuser']."\"";
      if ($result = $mysqli->query($sql))
      {
        $row=$result->fetch_row();
        $_SESSION['id']=$row['0'];
        if(is_null($_SESSION['id'])){
          header("Refresh: 1; url=Killall.php");
          die("Invalid access");
        }
    ?>
    <p><a href="Reg.php"><button>Komandos Registracija</button></a></p>
    <p><a href="Client.php"><button>Pagrindiė konsolė</button></a></p>
		<p><a href="Check.php"><button>Teisėjų prieiga</button></a></p>
    <p><a href="Rezultatai.php"><button>Rezultatai</button></a></p>
    <p id="arm"><a href="Armagedon.php"><button>Visiškas sistemos perkrovimas</button></a></p>
    <script type="text/javascript">
      if('<?php echo $_SESSION['dbuser']?>'!='root')
      document.getElementById("arm").remove();
    </script>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
    <?php }?>
  </body>
</html>
