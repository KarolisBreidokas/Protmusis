<?php
  function Connect()
  {
    $mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
    //check connection
    if(mysqli_connect_errno()){
      header("Refresh: 2; url=Killall.php");
      die("neprisijungta: ".$mysqli->connect_error);
    }
    $mysqli->set_charset("UTF8");
    return $mysqli;
  }
  function AdminConnect($reqroot=false)
  {
    $mysqli=Connect();
    $sql="SELECT Nr FROM Admins WHERE Pav=\"".$_SESSION['dbuser']."\"";
    if ($result = $mysqli->query($sql))
    {
      $_SESSION['id']=$result->fetch_row()['0'];
      if(is_null($_SESSION['id'])||($reqroot&&$_SESSION['dbuser']<>"root")){
        header("Refresh: 1; url=Killall.php");
        die("Invalid access");
      }
    }else{
      die("Klaida:1");
    }
    return $mysqli;
  }
  function ClientConnect(){
    $mysqli = Connect();
		$sql="SELECT Nr FROM Komandos where pav=\"".$_SESSION['dbuser']."\"";
		if ($result = $mysqli->query($sql))
		{
			$_SESSION['id']=$result->fetch_row()['0'];
      if(is_null($_SESSION['id'])){
        header("Refresh: 1; url=Killall.php");
        die("Invalid access");
      }
		}else{
			die("Klaida: ".$mysqli->error);
		}
    return $mysqli;
  }

?>
