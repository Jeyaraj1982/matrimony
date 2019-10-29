      
                    
    <div class="jTitle">Photo Galary</div>
    
  <?php 
    $count=0;
      foreach(JPhotogallery::getPhotoGalleries() as $gallery) {
      $photos= $mysql->select("select * from _jphotos where groupid=".$gallery['groupid']);
         
        if ($count<4) {
        ?>
        <div style="margin:2px;float:left;width:131px;height:138px;margin-right:13px;overflow:hidden">
            <table cellpadding="0" cellpadding="0">
                <tr>
                    <td style="padding-left:0px">
                        <div style='background:#fff;padding:3px'>
                            <a href="photos.php?groupid=<?php echo $gallery['groupid'];?>" style="outline:none" id="manual1">
                            <img onmouseout="$(this).css('border','none')" onmouseover="$(this).css('border','1px solid #333')" style=";cursor:pointer;border:1px solid #ccc;border-bottom:none;" src="assets/<?php echo $config['photos'].$gallery['filepath'];?>" height="93" width="124"></a>
                            <br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:129px">
                        </div>
                        <div class="jContent" style="font-size:10px;color:#222;text-align:center">
                        <a href="photos.php?groupid=<?php echo $gallery['groupid'];?>" class="viewmore"><?php echo $gallery['groupname'];?></a> 
                         (<?php echo sizeof($photos);?>)<br>
                        </div>   
                    </td>
                </tr>    
            </table>                                          
        </div>
    <?php 
    $count++;
        }  ?>
        
    <?php
     
     }?>
    <a class="jMore" href="photos.php">More Photo Gallery</a>
     <div style="clear:both"></div>
         