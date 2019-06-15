<?php
    include_once("config.php");
    unset($_SESSION);
    session_destroy();

    if ($_Admin['AdminID']>0) {
        header("Location:AdminLogin");
    }
     
    if ($_Franchisee['FranchiseeID']>0) {
       header("Location:FranchiseeLogin");   
    }
    
    if ($_Member['MemberID']>0) {
      header("Location:../index"); 
    }
?>