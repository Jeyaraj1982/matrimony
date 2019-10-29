<?php 
include_once("config.php");
include_once("includes/header.php");


?>
 <div class="jTitle">Video Galary</div>
 
    <?php if (isset($_REQUEST['viewvid']) && ($_REQUEST['viewvid']>0)) { 
        
    $videos = JVideos::getVideos($_REQUEST['viewvid']);
    if(sizeof($videos)==1) {
        $videos = $videos[0];
        $youtube = new youTube($videos['videourl']);
    ?>
    <br>
    <table width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td style="color: #047d9b;font-family:'Droid Sans';font-size: 15px;font-weight: bold;"><?php echo $youtube->getTitle();?></td>
        </tr>
        <tr>
            <td><iframe width='420' height='315' src='http://www.youtube.com/embed/<?php echo $videos['videourl'];?>' frameborder='0' allowfullscreen></iframe></td>
        </tr>
    </table>
    <br>
    <?php
         $count=0;
                    foreach(JVideos::getVideos() as $videos) {
                         
                        if ($count<10) {
                             $youtube = new youTube($videos['videourl']);
                     ?>
                        <div style="margin:2px;float:left;width:131px;height:138px;margin-right:13px;overflow:hidden">
                            <table cellpadding="0" cellpadding="0">
                                <tr>
                                    <td style="padding-left:0px">
                                        <div style='background:#fff;padding:3px'>
                                            <a href="videos.php?viewvid=<?php echo $videos['videoid'];?>" style="outline:none"><img onmouseout="$(this).css('border','none')" onmouseover="$(this).css('border','1px solid #333')" style=";cursor:pointer;border:1px solid #ccc;border-bottom:none;" src="<?php echo $youtube->getImage();?>" height="93" width="129"></a>
                                            <br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:129px">
                                        </div>
                                        <div class="jContent" style="font-size:10px;color:#222;text-align:center">
                                        <a href="videos.php?viewvid=<?php echo $videos['videoid'];?>" class="viewmore"><?php echo $youtube->getTitle();?></a></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php }
                    $count++;
                    } ?>
                   <div style="clear: both;">&nbsp;</div>
                     <a class="jMore" href="videos.php">More Videos</a>
                     <?php
    } else {
        echo "Page Not Found";
    }
    ?>
    
    
    <?php } else { ?>
   
        <?php 
            $count=0;
            foreach(JVideos::getVideos() as $videos) {
                $youtube = new youTube($videos['videourl']);
        ?>
        <div style="margin:2px;float:left;width:131px;height:138px;margin-right:13px;overflow:hidden">
            <table cellpadding="0" cellpadding="0">
                <tr>
                    <td style="padding-left:0px">
                        <div style='background:#fff;padding:3px'>
                            <a href="videos.php?viewvid=<?php echo $videos['videoid'];?>" style="outline:none"><img onmouseout="$(this).css('border','none')" onmouseover="$(this).css('border','1px solid #333')" style=";cursor:pointer;border:1px solid #ccc;border-bottom:none;" src="<?php echo $youtube->getImage();?>" height="93" width="129"></a>
                            <br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:129px">
                        </div>
                        <div class="jContent" style="font-size:10px;color:#222;text-align:center">
                            <a href="videos.php?viewvid=<?php echo $videos['videoid'];?>" class="viewmore"><?php echo $youtube->getTitle();?></a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php  } ?>
     <?php } ?>                    
<?php
include_once("includes/footer.php");
?>
