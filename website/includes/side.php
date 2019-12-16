<?php if (JFrame::getAppSetting('layout')==1) { ?>
    <td width="242" valign="top" style="border-left:1px dashed #ccc;background:#fff;padding:0px;padding-top:0px">        
<?php } ?>
<?php if (JFrame::getAppSetting('layout')==2) { ?>
    <td width="242" valign="top" style="border-right :1px dashed #ccc;background:#fff;padding:0px;padding-top:0px">        
<?php } ?>
             <div style="padding-top:10px"> 
             <div  class="subMenu" style="clear:both;padding:10px;color:#fff;font-size:13px;font-family:arial;font-weight:bold;height:auto">Latest Products </div>
             
             <?php
              $result= JListing::getLatestPublishedItems(); 
    $i=0;       
    foreach ($result as $r)
    {
        echo Type_003($r);
    }

       ?>
         
       
             
         <!--    <div style="padding:10px; ">Most Viewed</div>-->
             
               <?php
           //   $result= JListing::getMostViewedPublishedItems(); 
  //  $i=0;       
   // foreach ($result as $r)
   // {
     //   echo Type_003($r);
   // }

       ?>
              
              
             
             
           <!--   <div style="padding:10px; ">Customized</div>-->
             
               <?php
           //   $result= JListing::getMostViewedPublishedItems(); 
 //   $i=0;       
  //  foreach ($result as $r)
 //   {
 //       echo Type_003($r);
   // }
  //
       ?>
              

             <div style='font-family:"comic sans ms";font-size:14px;font-weight:bold;color:#222;'>Links</div>
             <table>
                <?php if (JFrame::getAppSetting('isenablephoto')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="photos.php">Photo Galary</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenablevideo')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="videos.php">Videos</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenablemusic')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="musics.php">Musics</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenabledownloads')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="downloads.php">Downloads</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenableproduct')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="product.php">Product</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenablenews')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="news.php">News</a></td></tr>
                <?php } ?>
                <?php if (JFrame::getAppSetting('isenableevents')) { ?>
                <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="events.php">Events</a></td></tr>
                <?php } ?>
             </table>
                                
</td>