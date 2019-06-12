<?php
     include_once("config.php");
     $obj = new $_GET['m']();
     echo $obj->$_GET['a']($_GET['Code']);
     $fr = new $_GET['fr']();
     echo $fr->$_GET['fi']($_GET['Code']);
         
 ?>  