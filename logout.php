<?php
	session_start();
	session_destroy();
	session_unset();
	echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    exit();
?>