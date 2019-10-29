<?php 
include_once("config.php");
include_once("includes/header.php");


?>
 <div class="jTitle">Photo Galary</div>
 
   <?php 
   if (isset($_REQUEST['groupid'])) {
       ?>
       
<script type="text/javascript" src="assets/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<link rel="stylesheet" href="assets/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="assets/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<link rel="stylesheet" href="assets/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

       <?php
        $photos= $mysql->select("select * from _jphotos where groupid=".$_REQUEST['groupid']);    
        foreach($photos as $p) {
            ?>
          <!--  <a class="fancybox" rel="gallery1" href="assets/cms/<?php echo $p['photofilepath'];?>" title="<?php echo $group['phototitle'];?>">
    <img src="assets/cms/<?php echo $p['photofilepath'];?>" alt="" height="93" width="129"   />
</a>   -->

             <div style="margin:2px;float:left;width:137px;height:138px;margin-right:13px;overflow:hidden">
            <table cellpadding="0" cellpadding="0">
                <tr>
                    <td style="padding-left:0px">
                        <div style='background:#fff;padding:3px'>
                        <a class="fancybox" rel="gallery1" href="assets/<?php echo $config['photos'].$p['photofilepath'];?>" title="<?php echo $p['phototitle'];?>" style="outline:none">
                            <img onmouseout="$(this).css('border','1px solid #ccc')" onmouseover="$(this).css('border','1px solid #333')" style="cursor:pointer;border:1px solid #ccc;" src="assets/<?php echo $config['photos'].$p['photofilepath'];?>" height="93" width="129">
                             </a>
                        </div>
                        <div class="jContent" style="font-size:10px;color:#222;text-align:center">
                        <?php echo $p['phototitle'];?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>   
            <?php
        }
       ?>
         <script>
         
         $(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect    : 'none',
        closeEffect    : 'none'
    });
});

</script>
       <?php
   } else {
    $count=0;
     foreach(JPhotogallery::getPhotoGalleries() as $gallery) {
     $photos= $mysql->select("select * from _jphotos where groupid=".$gallery['groupid']);    
        if ($count<4) { 
     ?>
       <div style="margin:2px;float:left;width:137px;height:138px;margin-right:13px;overflow:hidden">
            <table cellpadding="0" cellpadding="0">
                <tr>
                    <td style="padding-left:0px">
                        <div style='background:#fff;padding:3px'>
                            <a href="photos.php?groupid=<?php echo $gallery['groupid'];?>" style="outline:none">
                            <img onmouseout="$(this).css('border','none')" onmouseover="$(this).css('border','1px solid #333')" style=";cursor:pointer;border:1px solid #ccc;border-bottom:none;" src="assets/<?php echo $config['photos'].$gallery['filepath'];?>" height="93" width="129"></a>
                            <br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:129px;">
                        </div>
                        <div class="jContent" style="font-size:10px;color:#222;text-align:center">
                        <a href="photos.php?groupid=<?php echo $gallery['groupid'];?>" class="viewmore"><?php echo $gallery['groupname'];?></a>
                        (<?php echo sizeof($photos);?>)<br></div>
                    </td>
                </tr>
            </table>
        </div>
          
      <?php 
    $count++;
        }?>
    
    <?php
     
     }
   }?>
     
<?php
include_once("includes/footer.php");
?>
