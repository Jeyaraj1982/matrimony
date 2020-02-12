<?php
session_start();
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

$clientId       = '566587912868-hvvqbmuo5eok6g8bonok3tb0e764mrm0.apps.googleusercontent.com'; //Google client ID
$clientSecret   = 'XqaOHL6Vu4M_nva_iTUDTUQT'; //Google client secret
$redirectURL    = 'https://www.iuongo.com/app/services/signup/google/process.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to QAWebprints');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>