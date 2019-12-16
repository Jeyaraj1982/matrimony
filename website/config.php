<?php 
    error_reporting(0);
    session_start();                              
    define("DBHOST","localhost");
    define("DBUSER","onlin5zs_jframe");
    define("DBPASS","welcome@82");
    
    include_once("classes/class.mysql.php");
    $app     = new MySql(DBHOST,DBUSER,DBPASS,"onlin5zs_jframe");
   
    
    $appData = $app->select("select * from _japp where Lower(hostname)='".strtolower($_SERVER['HTTP_HOST'])."' or  Lower(hosturl)='".strtolower($_SERVER['HTTP_HOST'])."' or  concat('www.',Lower(hostname))='".strtolower($_SERVER['HTTP_HOST'])."' or  concat('www.',Lower(hosturl))='".strtolower($_SERVER['HTTP_HOST'])."' ");
    
     

    if (sizeof($appData)==0) {
        echo "Configuration Failed. ";
        exit;
    }

    function String2FileName($string) {
        
        $filename = str_replace("'","",trim($string));
        $filename = str_replace('"',"",trim($filename));
        $filename = str_replace("&","",trim($filename));
        $filename = str_replace("~","",trim($filename));
        $filename = str_replace("`","",trim($filename));
        $filename = str_replace("!","",trim($filename));
        $filename = str_replace("@","",trim($filename));
        $filename = str_replace("#","",trim($filename));
        $filename = str_replace("\$","",trim($filename));
        $filename = str_replace("%","",trim($filename));
        $filename = str_replace("^","",trim($filename));
        $filename = str_replace("&","",trim($filename));
        $filename = str_replace("*","",trim($filename));
        $filename = str_replace("(","",trim($filename));
        $filename = str_replace("}","",trim($filename));
        $filename = str_replace("_","-",trim($filename));
        $filename = str_replace("+","",trim($filename));
        $filename = str_replace("=","",trim($filename));
        $filename = str_replace("{","",trim($filename));
        $filename = str_replace("}","",trim($filename));
        $filename = str_replace("[","",trim($filename));
        $filename = str_replace("]","",trim($filename));
        $filename = str_replace("|","",trim($filename));
        $filename = str_replace("\\","",trim($filename));
        $filename = str_replace("?","",trim($filename));
        $filename = str_replace(":","",trim($filename));
        $filename = str_replace(";","",trim($filename));
        $filename = str_replace(",","",trim($filename));
        $filename = str_replace("<","",trim($filename));
        $filename = str_replace(">","",trim($filename));
        $filename = str_replace(".","",trim($filename));
        $filename = str_replace("/","",trim($filename));
        $filename = str_replace("   "," ",trim($filename));
        $filename = str_replace("  "," ",trim($filename));
        
        $filename = str_replace(" ","-",trim($filename));
        return strtolower($filename);
    }
   define("DOCPATH",dirname(__FILE__));
    
    $_SITEPATH="http://".strtolower($_SERVER['HTTP_HOST'])."/";
    $dataDir = $appData[0]['datadir']; 

    $config = array("dataDir"         => $dataDir,
                    "thumb"           => "cms/".$dataDir."/thumb/",
                    "musics"          => "cms/".$dataDir."/musics/",
                    "photos"          => "cms/".$dataDir."/photos/",
                    "downloads"       => "cms/".$dataDir."/download/",
                    "trash"           => "cms/".$dataDir."/trash/",
                    "backup"          => "cms/".$dataDir."/backup/",
                    "files"           => "cms/".$dataDir."/files/",
                    "slider"          => "cms/".$dataDir."/slider/",
                    "imageArray"      => array("image/jpeg","image/jpg","image/gif","image/png","image/bmp"),
                    "imgMaxSize"      => 20000000,
                    "musicArray"      => array("audio/mp3","audio/mpeg","audio/wav"),
                    "musicMaxSize"    => 20000000,
                    "downloadArray"   => array("image/jpeg","image/jpg","image/gif","image/png","application/pdf","application/doc","application/zip","application/oda","application/odt","application/x-zip-compressed"),
                    "downloadMaxSize" => 20000000); 
                               
    $mysql = new MySql(DBHOST,DBUSER,DBPASS,$appData[0]['dbname']);   
    $settings = $mysql->select("select * from _jsitesettings"); 
     
    include_once("classes/class.jframe.php");
    include_once("classes/class.jslider.php");
    include_once("classes/class.jphotogallery.php");
    include_once("classes/class.jdownload.php");
    include_once("classes/class.jmusics.php"); 
    include_once("classes/class.jpage.php");
    include_once("classes/class.jsuccessstory.php");
    include_once("classes/class.jfaq.php");
    include_once("classes/class.jvideos.php");
    
?>