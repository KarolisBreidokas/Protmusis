<?php
    session_start();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    $conn=mysql_connect($_SERVER['SERVER_ADDR'], $_SESSION["dbuser"], $_SESSION["dbpass"]);
    function sendMsg($id, $msg) {
      echo "id: 100 \n" . PHP_EOL;
      echo "data: 100 \n\n" . PHP_EOL;
      echo PHP_EOL;
    }
    if(mysql_result(mysql_query("SELECT reset FROM Info.ServerInfo",$conn),0,0)==true){
        sendMsg();
    }
?>
