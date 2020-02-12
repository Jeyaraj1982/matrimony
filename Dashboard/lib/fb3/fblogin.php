<?php
session_start();
require_once( 'Facebook/autoload.php' );
$fb = new Facebook\Facebook([
    'app_id' => '2466720886885490',
    'app_secret' => 'b4adde9656e8267b8c156de3312b3530',
    'default_graph_version' => 'v2.12']);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://www.iuongo.com/app/services/signup/fb3/callback.php?close', $permissions);
header("location: ".$loginUrl);

?>