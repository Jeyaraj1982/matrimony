<?php
session_start();
unset($_SESSION['UserName']);
session_destroy();

header("Location:AdminLogin.php");
exit;
?>