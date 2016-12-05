<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reset</title>
  </head>

  <body>
    <?php
			session_start();
      if($_SESSION['dbuser']!="root"){
        echo "<script type='text/javascript'>alert('Tik turint root privilegijas How the f**k you got there');</script>";
        header("Refresh: 0; url=Loby.php");
      }
			$conn = mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION['dbuser'], $_SESSION['dbpass']);
			if(! $conn ) {
				header("Refresh: 2; url=Killall.php");
				die('Could not connect: ' . mysql_error());
			}
			mysql_set_charset("UTF8", $conn);
			mysql_select_db($_SESSION['db'], $conn);
      if(isset($_POST['submit'])){
        if($_POST['confirm']==$_SESSION['dbpass']){
          $retval=mysql_query("SELECT Pav FROM Komandos WHERE Nr>0",$conn);
          if(!$retval ) {
  					die("Klaida: ".mysql_error());
  				}
          for ($i=0; $i < mysql_num_rows($retval); $i++) {
            $rem=mysql_result($retval,$i,0);
            $sql="DROP USER ".$rem;
            $query=mysql_query($sql,$conn);
            if(!$query ) {
    					die("Klaida: ".mysql_error());
    				}
          }
          $retval=mysql_query("SELECT Pav FROM Admins WHERE Nr>0",$conn);
          for ($i=0; $i < mysql_num_rows($retval); $i++) {
            $rem=mysql_result($retval,$i,0);
            $sql="DROP USER ".$rem;
            $query=mysql_query($sql,$conn);
            if(!$query ) {
    					die("Klaida: ".mysql_error());
    				}
          }
          $query=mysql_query("CALL reset",$conn);
          if(!$query ) {
            die("Klaida: ".mysql_error());
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
