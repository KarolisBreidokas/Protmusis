<?php
    session_start();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    $mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
    function sendMsg() {
      echo "id: 100 \n" . PHP_EOL;
      echo "data: 100 \n\n" . PHP_EOL;
      echo PHP_EOL;
    }
    $ret=$mysqli->query("SELECT reset FROM ServerInfo");
    if($ret->fetch_row()['0']){
        sendMsg();
    }
?>
