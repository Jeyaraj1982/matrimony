<?php 
    include_once("config.php");
    
    $pageContent = $mysql->select("select * from _jpages where pagefilename='".$_REQUEST['pageurl']."'");
    
    $description = $pageContent[0]['description'];
    $keywords = $pageContent[0]['keywords'];
    $title = $pageContent[0]['pagetitle'];
    
    $itemname = $pageContent[0]['pagetitle'];
    $ogImage = $_SITEPATH.'assets/'.$config['thumb'].$r["filename"];
    $ogUrl = $_SITEPATH."pages/".$pageContent[0]['pagefilename'].".html";

    include_once("includes/header.php");
    
    echo "<div style='padding-left: 10px;font-family:arial;font-size:14px;line-height:22px;color:#444'>";
   
    //if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/".$config['thumb'].$pageContent[0]['filepath']))) {
        //echo"<div style='background:#fff;padding:3px'> 
              //<a class='fancybox' rel='gallery1' href='assets/".$config['thumb'].$pageContent[0]['filepath']."' title='".$pageContent[0]['pagetitle']."' style='outline:none'>
//                <img onmouseout='$(this).css('border','1px solid #ccc')' onmouseover='$(this).css('border','1px solid #333')' style='cursor:pointer;border:1px solid #ccc;' src='assets/".$config['thumb'].$pageContent[0]['filepath']."' align='right' height='93' width='129'>
  //            </a>
    //         </div>";
    //}
    $data =  str_replace("content node-page","",$pageContent[0]['pagedescription']);
    $data = str_replace('class="drop_cap"',"",$data);
    echo $data;
    
    echo "</div>";
    
    if ( (JFrame::getAppSetting('linkedpage') ==$_REQUEST['page']) && JFrame::getAppSetting('isenablecontact') ) {
        include_once("includes/contactform.php");
    }
    
    $mysql->execute("update _jpages set noofvisit=noofvisit+1 where pageid=".$_REQUEST['page']);
    
    if (JFrame::getAppSetting('sharepage')==1) {
        include_once("includes/sharethis.php");
    }
    
    ?>
   
       <?php
 

include_once("includes/footer.php");
?>
