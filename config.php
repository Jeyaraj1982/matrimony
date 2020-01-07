<?php
session_start();     

    error_reporting(0);                             
    
    /* Website Config */
    define("DBHOST","localhost");
    define("DBUSER","allsaliy_user");
    define("DBPASS","mysqlPwd@123");
    define("web_path","website/"); 
    define("webadmin_path","website/webadmin/");
    define("application_config_path","Dashboard/web_config.php");      
?>