<?php
    include_once("config.php");
    
    include_once(web_path."classes/class.mysql.php");
    
    $app     = new MySql(DBHOST,DBUSER,DBPASS,"onlin5zs_jframe");
    $appData = $app->select("select * from _japp where Lower(hostname)='".strtolower($_SERVER['HTTP_HOST'])."' or  Lower(hosturl)='".strtolower($_SERVER['HTTP_HOST'])."' ");
  
    if (sizeof($appData)==0) {
        echo "Configuration Failed. ";
        exit;
    }
     
    $dataDir = $appData[0]['datadir']; 
     
    $config = array("dataDir"         => $dataDir,
                    "thumb"           => web_path.$dataDir."/thumb/",
                    "musics"          => web_path.$dataDir."/musics/",
                    "photos"          => web_path.$dataDir."/photos/",
                    "downloads"       => web_path.$dataDir."/download/",
                    "trash"           => web_path.$dataDir."/trash/",
                    "backup"          => web_path.$dataDir."/backup/",
                    "files"           => web_path.$dataDir."/files/",
                    "slider"          => web_path.$dataDir."/slider/",
                    "imageArray"      => array("image/jpeg","image/jpg","image/gif","image/png","image/bmp"),
                    "imgMaxSize"      => 20000000,
                    "musicArray"      => array("audio/mp3","audio/mpeg","audio/wav"),
                    "musicMaxSize"    => 20000000,
                    "downloadArray"   => array("image/jpeg","image/jpg","image/gif","image/png","application/pdf","application/doc","application/zip","application/oda","application/odt","application/x-zip-compressed"),
                    "downloadMaxSize" => 20000000);            
    
    include_once(web_path."classes/class.jframe.php");
    include_once(web_path."classes/class.jslider.php");
    include_once(web_path."classes/class.jphotogallery.php");
    include_once(web_path."classes/class.jdownload.php");
    include_once(web_path."classes/class.jmusics.php"); 
    include_once(web_path."classes/class.jpage.php");
    include_once(web_path."classes/class.jsuccessstory.php");
    include_once(web_path."classes/class.jfaq.php");
    include_once(web_path."classes/class.jvideos.php");
 
    $mysql = new MySql(DBHOST,DBUSER,DBPASS,$appData[0]['dbname']);    

    if (isset($_GET['x'])) {
        if ($_GET['x']!="") {
            $d = explode(".",$_GET['x']);
            if (sizeof($d)==1) {
                $pageContent = $mysql->select("select * from _jpages where pagefilename='".$d[0]."'");
                if (sizeof($pageContent)>0) {
                    $_GET['x']="index";
                    $_REQUEST['page']="1";    
                }
            }
            $ext = ($d[sizeof($d)-1]=="php") ? "" : ".php";
            include_once(web_path.$_GET['x'].$ext);                
        } else {
            include_once(web_path."index.php");
        }
    }
?>