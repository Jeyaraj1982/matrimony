<?php
	include_once("config.php");

    /* Remove unwanted sliders files in slider folder */
    $remove_filecount=0;
    $path = "assets/".$config['slider'];
    $q= scandir($path);
    foreach($q as $q1) {
        if (!($q1=="." || $q1=="..")) {
            if (sizeof($mysql->select("select * from _jslider where filepath='".$q1."'"))==0) {
                unlink($path."/".$q1);
                $remove_filecount++;
            }
        }    
    }
    echo $remove_filecount." files are deleted";
    /* End of Remove unwanted sliders files in slider folder */
?>