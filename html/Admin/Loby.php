
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Konslolė</title>
  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION['Kt'])){
        unset($_SESSION['Kt']);
        unset($_SESSION['Kn']);
      }
      $conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION["dbuser"], $_SESSION["dbpass"]);
      if(!$conn) {
        header("Refresh: 1; url=Killall.php");
        die('Could not connect: ' . mysql_error());
      }
    ?>
    <p><a href="Reg.php"><button>Komandos Registracija</button></a></p>
    <p><a href="Client.php"><button>Pagrindiė konsolė</button></a></p>
		<p><a href="Check.php"><button>Teisėjų prieiga</button></a></p>
    <p><a href="Rezultatai.php"><button>Rezultatai</button></a></p>
    <p id="arm"><a href="Armagedon.php"><button>visiškas sistemos perkrovimas</button></a></p>
    <script type="text/javascript">
      if('<?php echo $_SESSION['dbuser']?>'!='root')
      document.getElementById("arm").remove();
    </script>
		<p><a href="Killall.php"><button>Atsijungti</button></a></p>
  </body>
</html>
