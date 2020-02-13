<?php
    include_once("config.php");
    define("DOCPATH",dirname(__FILE__));
    define("BaseUrl","http://".$_SERVER['HTTP_HOST']."/".web_path);
    $_SITEPATH="http://".strtolower($_SERVER['HTTP_HOST'])."/";
    
    include_once(web_path."classes/class.pdo.mysql.php");
      
    $app     = new MySql(DBHOST,DBUSER,DBPASS,DBNAME);
    include_once(application_config_path);
    
      
    $appData = $app->select("select * from _japp where concat('www.',Lower(hostname))='".strtolower($_SERVER['HTTP_HOST'])."' or  Lower(hostname)='".strtolower($_SERVER['HTTP_HOST'])."' or  concat('www.',Lower(hosturl))='".strtolower($_SERVER['HTTP_HOST'])."' or  Lower(hosturl)='".strtolower($_SERVER['HTTP_HOST'])."' ");
        
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

    $dataDir = $appData[0]['datadir']; 
    $dataDir = "data"; 

    $config = array("dataDir"         => $dataDir,
                    "thumb"           => $dataDir."/thumb/",
                    "musics"          => $dataDir."/musics/",
                    "photos"          => $dataDir."/photos/",
                    "downloads"       => $dataDir."/download/",
                    "trash"           => $dataDir."/trash/",
                    "backup"          => $dataDir."/backup/",
                    "files"           => $dataDir."/files/",
                    "slider"          => $dataDir."/slider/",
                    "imageArray"      => array("image/jpeg","image/jpg","image/gif","image/png","image/bmp"),
                    "imgMaxSize"      => 20000000,
                    "musicArray"      => array("audio/mp3","audio/mpeg","audio/wav"),
                    "musicMaxSize"    => 20000000,
                    "downloadArray"   => array("image/jpeg","image/jpg","image/gif","image/png","application/pdf","application/doc","application/zip","application/oda","application/odt","application/x-zip-compressed"),
                    "downloadMaxSize" => 20000000); 
    
    $mysql = new MySql(DBHOST,DBUSER,DBPASS,DBNAME);  
    $settings = $mysql->select("select * from _jsitesettings"); 
          
    include_once(web_path."classes/class.jframe.php");
    include_once(web_path."classes/class.jslider.php");
    include_once(web_path."classes/class.jphotogallery.php");
    include_once(web_path."classes/class.jdownload.php");
    include_once(web_path."classes/class.jmusics.php"); 
    include_once(web_path."classes/class.jpage.php");
    include_once(web_path."classes/class.jsuccessstory.php");
    include_once(web_path."classes/class.jfaq.php");
    
    $showTemplateHeader=true;  
    $showTemplateFooter=true;  
                          
    if (isset($_GET['x'])) {
        
        if ($_GET['x']!="") {
           
            $isShowSlider = false;
            $d = explode(".",$_GET['x']);
            if (sizeof($d)==1 || sizeof($d)==2)  {
                $pageContent = $mysql->select("select * from _jpages where pagefilename='".$d[0]."'");
                if (sizeof($pageContent)>0) {
                    $_GET['x']="index";
                } else {
                    $nPath = web_path."includes/user_pages/".$_GET['x'].".php";
                    $mPath = web_path."includes/user_pages/".$_GET['x'];
                    $hideHeaderFooter = array("ResetPassword","Request","register","ResetPassword","password-changed","forget-password-save","forget-password-otp","login","forget-password");
                    if (in_array($_GET['x'], $hideHeaderFooter)) {
                        $showTemplateHeader=false;  
                        $showTemplateFooter=false;  
                    }
                         
                    if (file_exists($nPath)) {
                        $realPath=$nPath;    
                        $_GET['x']="index";
                    }
                    
                    if (file_exists($mPath)) {
                        $realPath=$mPath;
                        $_GET['x']="index.php"; 
                    }
                }
            } 
            include_once(web_path.$_GET['x'].(($d[sizeof($d)-1]=="php") ? "" : ".php"));  
        } else {
            include_once(web_path."index.php");
        }
    } else {
         include_once(web_path."index.php");
    }
?>