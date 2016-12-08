<?php
    ini_set('display_errors', 'On');
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
    $row=$ret->fetch_row();
    if($row['0']){
        sendMsg();
        sendMsg();
    }
?>
