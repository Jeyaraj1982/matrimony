 
<div class="row">
<?php include (web_path."/includes/hp_slider.php"); ?>
</div>
</div>
                                                                     
<div class="row">
    <div class="col-6" style="padding-right:0px;">
        <?php include_once(web_path."includes/user_includes/hp_featured_brides.php");?>    
    </div>
    <div class="col-6"  style="padding-right:0px;" >
        <?php include_once(web_path."includes/user_includes/hp_featured_grooms.php");?>    
    </div>
</div>
 <div class="row">
    <div class="col-12">
        <?php  include_once(web_path."includes/user_includes/hp_featured_recentlyadded.php");?>
    </div>
</div>
 
<?php
    $home = $mysql->select("select * from _jpages where ishomepage=1");
 
    if (sizeof($home)>0) {
        
    $pageContent = $mysql->select("select * from _jpages where pageid=".$home[0]['pageid']);
    echo "<div style='font-family:arial;font-size:13px;text-align:justify;'>";
    if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/cms/".$pageContent[0]['filepath']))) {
        echo "<img style='border:1px solid #ccc;height:140px' src='assets/cms/".$pageContent[0]['filepath']."'  align='right'>";    
    }
    echo $pageContent[0]['pagedescription'];
    echo "</div>";
                                                     
    }
    
?>
       <table style="width:100%;display: none;" cellpadding="0" cellspacing="0">
            <tr>
                <?php if ( (JFrame::getAppSetting('isenablephoto')) || (JFrame::getAppSetting('isenablevideo')) )  {?>
                    <td valign="top">
                        <?php
                        if (JFrame::getAppSetting('isenableevents')) {  
                        include_once("includes/hp_feature_events.php");
                        }
                        ?>
                    </td>
                    <td width="10">&nbsp;</td>
                    <td width="300" style="vertical-align: top;">
                        <?php 
                         if (JFrame::getAppSetting('isenablephoto')) {
                              include_once("includes/hp_feature_photos.php");
                         }
                         echo "<br>";
                         if (JFrame::getAppSetting('isenablevideo')) {
                              include_once("includes/hp_feature_videos.php");
                         } 
                         ?>
                    </td>
                    
                <?php } else { ?>
                    <td colspan="3"  valign="top">
                        <?php 
                          if (JFrame::getAppSetting('isenableevents')) {
                             include_once("includes/hp_feature_events.php");
                          }
                        ?>
                    </td>
                    <?php } ?>
                
            </tr>
             <tr>
                  <td colspan="3">
                     <?php 
                      if (JFrame::getAppSetting('isenablenews')) {
                          include_once("includes/hp_feature_news.php");
                      }
                     ?>
                  </td>
            </tr>
        </table>