<?php
session_start();
if(isset($_SESSION['log']) && $_SESSION['log']==="true")
{}
else
{
    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    exit();
}
$email1 = $_SESSION['login_user'];
$id1 = $_SESSION['id'];
?>