<?php 
    include_once("config.php");
    include_once("header.php");

    if (isset($_GET['p'])) {
        if (file_exists("views/".UserRole."/".trim($_GET['p']).".php")) {
            include_once("views/".UserRole."/".trim($_GET['p']).".php");    
        } else {
            include_once("views/".UserRole."/Dashboard.php");
        }
    } else {
        include_once("views/".UserRole."/Dashboard.php");
    }
    
    include_once("footer.php");
?>