<?php 

    include_once("config.php");

    include_once("includes/header.php");

    if ($_REQUEST['page']>0) {
        
        //echo "<div style='padding:10px;font-family:arial;font-size:13px;text-align:justify;'>";
        //echo "<div style='font-family:arial;font-size:18px;font-weight:bold;border-bottom:2px solid #222;margin-bottom:10px;padding-bottom:10px;'>".$pageContent[0]['pagetitle']."</div>";
        echo "<h3>".$pageContent[0]['pagetitle']."</h3>";
        if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/".$config['thumb'].$pageContent[0]['filepath']))) {
            echo "<div style='background:#fff;padding:3px'> 
                    <a class='fancybox' rel='gallery1' href='assets/".$config['thumb'].$pageContent[0]['filepath']."' title='".$pageContent[0]['pagetitle']."' style='outline:none'>
                        <img onmouseout='$(this).css('border','1px solid #ccc')' onmouseover='$(this).css('border','1px solid #333')' style='cursor:pointer;border:1px solid #ccc;' src='assets/".$config['thumb'].$pageContent[0]['filepath']."' align='right' height='93' width='129'>
                    </a>
                 </div>";
        }
    
        echo "<br>".str_replace("color: #333333; font-size: medium; font-family: arial, helvetica, sans-serif;","",$pageContent[0]['pagedescription']);
    
    if ( (JFrame::getAppSetting('linkedpage') ==$_REQUEST['page']) && JFrame::getAppSetting('isenablecontact') ) {
        include_once("includes/contactform.php");
    }
    
    $mysql->execute("update _jpages set noofvisit=noofvisit+1 where pageid=".$_REQUEST['page']);
    
    if (JFrame::getAppSetting('sharepage')==1) {
    include_once("includes/sharethis.php");
    }
    
}  else  if ($_REQUEST['spage']>0) {  
    $pageContent = $mysql->select("select * from _jsuccessstory where storyid=".$_REQUEST['spage']);
    echo "<div style='padding:10px;font-family:arial;font-size:13px;text-align:justify;'>";
    echo "<div style='font-family:arial;font-size:18px;font-weight:bold;border-bottom:2px solid #222;margin-bottom:10px;padding-bottom:10px;'>".$pageContent[0]['storytitle']."</div>";
    if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/".$config['thumb'].$pageContent[0]['filepath']))) {
        echo"<div style='background:#fff;padding:3px'> 
              <a class='fancybox' rel='gallery1' href='assets/".$config['thumb'].$pageContent[0]['filepath']."' title='".$pageContent[0]['pagetitle']."' style='outline:none'>
                <img onmouseout='$(this).css('border','1px solid #ccc')' onmouseover='$(this).css('border','1px solid #333')' style='cursor:pointer;border:1px solid #ccc;' src='assets/".$config['thumb'].$pageContent[0]['filepath']."' align='right' height='93' width='129'>
              </a>
             </div>";
    }
    echo $pageContent[0]['storydescription'];
    echo "</div>";
} 
else{
   include_once("includes/home.php");  
}


include_once("includes/footer.php");
?>
