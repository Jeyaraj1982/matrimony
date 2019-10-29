    <div class="jTitle">Video Galary</div>
    <?php 
    $count=0;
    foreach(JVideos::getVideos() as $videos) {
         
        if ($count<4) {
             $youtube = new youTube($videos['videourl']);
     ?>
        <div style="margin:2px;float:left;width:131px;height:138px;margin-right:13px;overflow:hidden">
            <table cellpadding="0" cellpadding="0">
                <tr>
                    <td style="padding-left:0px">
                        <div style='background:#fff;padding:3px'>
                            <a href="videos.php?viewvid=<?php echo $videos['videoid'];?>" style="outline:none"><img onmouseout="$(this).css('border','none')" onmouseover="$(this).css('border','1px solid #333')" style=";cursor:pointer;border:1px solid #ccc;border-bottom:none;" src="<?php echo $youtube->getImage();?>" height="93" width="124"></a>
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
    <a class="jMore" href="videos.php">More Videos</a>