<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

 
 
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
    echo "<script>location.href='".filter_var($authUrl, FILTER_SANITIZE_URL)."';</script>";
 
?>
 