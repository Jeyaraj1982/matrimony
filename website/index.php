
<?php 
    $description = JFrame::getAppSetting('seometadesc');
    $keywords = JFrame::getAppSetting('seometakey');
    $title = JFrame::getAppSetting('sitetitle');
    
    $itemname=$r['itemname'];
    $ogImage = $_SITEPATH.'assets/'.$config['thumb'].$r["filename"];
    $ogUrl = $_SITEPATH;
    if ($showTemplateHeader && $showTemplateFooter) {
    include_once(web_path."includes/header.php");

    if (isset($pageContent) && sizeof($pageContent)>0) {
        echo "<br>";
   echo "<div class='row'>";
   echo "<div class='col-12'>";
   echo " <div class='card'>";
   echo " <div class='card-body'>";
   echo "<h5 class='card-title'>".$pageContent[0]['pagetitle']."</h5>";
   
    //<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
//    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

   // echo "<div style='font-family:arial;font-size:13px;text-align:justify;'>";
    if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/".$config['thumb'].$pageContent[0]['filepath']))) {
       // echo"<div style='background:#fff;padding:3px'> 
         //     <a class='fancybox' rel='gallery1' href='assets/".$config['thumb'].$pageContent[0]['filepath']."' title='".$pageContent[0]['pagetitle']."' style='outline:none'>
           //     <img onmouseout='$(this).css('border','1px solid #ccc')' onmouseover='$(this).css('border','1px solid #333')' style='cursor:pointer;border:1px solid #ccc;' src='assets/".$config['thumb'].$pageContent[0]['filepath']."' align='right' height='93' width='129'>
            //  </a>
            // </div>";
    }
   
    echo "<p class='card-text'>".str_replace("content node-page","",$pageContent[0]['pagedescription'])."</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    
    if ( (JFrame::getAppSetting('linkedpage') ==$_REQUEST['page']) && JFrame::getAppSetting('isenablecontact') ) {
        include_once(web_path."includes/contactform.php");
    }
     
    $mysql->execute("update `_jpages` set `noofvisit`=noofvisit+1 where `pageid`='".$_REQUEST['page']."'");
  
    if (JFrame::getAppSetting('sharepage')==1) {
        include_once(web_path."includes/sharethis.php");
    }
    
    }  else  if ($_REQUEST['spage']>0) {
    $pageContent = $mysql->select("select * from _jsuccessstory where storyid=".$_REQUEST['spage']);
    echo "<div style='font-family:arial;font-size:13px;text-align:justify;'>";
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
 
    }  else  if (isset($realPath)) { 
        include_once($realPath); 
    } else{
        include_once(web_path."includes/home.php");  
    }
    echo "<br>";

    include_once(web_path."includes/footer.php");
    } else {
        
          include_once($realPath); 
    }
?>