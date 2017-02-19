<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reset</title>
  </head>

  <body>
    <?php
			ini_set('display_errors', 'On');
      include 'connections.php';
      session_start();;
      $mysqli=AdminConnect(true);
      if(isset($_POST['submit'])){
        if($_POST['confirm']==$_SESSION['dbpass']){
          $retval=$mysqli->query("SELECT Pav FROM Komandos WHERE Nr>0");
          if(!$retval ) {
  					die("Klaida: ");
  				}
          while ($rem=$retval->fetch_row()) {
            $sql="DROP USER ".$rem['0'];
            $query=$mysqli->query($sql);
            if(!$query) {
    					die("Klaida: ");
            }
          }
          $retval=$mysqli->query("SELECT Pav FROM Admins WHERE Nr>0");
          while ($rem=$retval->fetch_row()) {
            $sql="DROP USER ".$rem['0'];
            $query=$mysqli->query($sql);
            if(!$query) {
              die("Klaida: ");
            }
          }
          $query=$mysqli->query("CALL reset");
          if(!$query ) {
            die("Klaida: ");
          }
          header("Refresh: 3; url=Killall.php");
          die("ištrinta teisingai");
        }else die("Klaida");
      }else{
      ?>
      <script type="text/javascript">
        function func(){
          return confirm("Ar Tikrai norite ištrinti");
        }
      </script>
      <form name="myForm" action="<?php $_PHP_SELF ?>" method="post">
          Patvirtinimo slaptažodis:<input type="password" id="confirm" name="confirm">
          <input type="submit" name="submit" onclick="return func()" value="Submit">
      </form>
      <?php } ?>
  </body>
</html>
