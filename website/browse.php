<?php

    include_once("config.php");

    $browse=true;
    
    if (isset($_REQUEST["/"])) {
        
        $param = explode("-",$_REQUEST["/"]);
   
        if (isset($_REQUEST["/"])) {
            if ($param[0]>0) {
                $result= JListing::getItem($param[0]);  
                $r = $result[0];
                $item_shortdesc = "Price: ".JFrame::getAppSetting("currencysymbol")." ".$r['itemprice'].". ".$r['shortdescription'];
            }  
        }
    }
    
    if (isset($_REQUEST["itemtitle"])) {
        
        $result= JListing::getItemByTitle($_REQUEST["itemtitle"]);  
        $r = $result[0];
        $item_shortdesc = "Price: ".JFrame::getAppSetting("currencysymbol")." ".$r['itemprice'].". ".$r['shortdescription'];
    }
    
    $description = strip_tags($item_shortdesc);
    $keywords = JFrame::getAppSetting('seometakey');
    $title = $r["itemname"]." - ".JFrame::getAppSetting('sitetitle');
    
    $itemname=$r['itemname'];
    $ogImage = $_SITEPATH.'assets/'.$config['thumb'].$r["filename"];
    $ogUrl = $_SITEPATH."item/".$r["itemfilename"].".html";
    $imgData = getimagesize("assets/".$config['thumb'].$r["filename"]);
    
    /* End Tags */
    include_once(DOCPATH."/includes/header.php");

    if (sizeof($result)>0) {
        include_once(DOCPATH."/includes/browse_itemdetails.php");
    } else {
    
        $categories = JListing::getCategories();
        $result= JListing::getPublishedItems(" order by list.itemid desc"); 
        $i=0;
        $records = sizeof($result);
        $recordsperpage=8; 
        
        if (isset($_REQUEST["l"]) && $_REQUEST["l"]>0) {
          $result= JListing::getPublishedItems(" and lcategory.categoryid ='".$_REQUEST['l']."' order by list.itemid desc "); 
        }  
        if (isset($_REQUEST["s"]) && strlen($_REQUEST["s"])>0) {
          $result= JListing::getPublishedItems(" and list.itemname like '%".$_REQUEST['s']."%' order by list.itemid desc "); 
        }  
    
        include_once(DOCPATH."/includes/browse_allitems.php");
    }                
 
    include_once("includes/footer.php");
?>