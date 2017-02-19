<?php
session_start();
	session_unset();
	session_destroy();
	echo "saugiai atsijungta";
	header("Refresh: 0; url=index.php");
?>
