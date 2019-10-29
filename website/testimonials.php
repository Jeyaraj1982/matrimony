<?php 
include_once("config.php");
include_once("includes/header.php");


?>
  <div class="jTitle" style="margin-left:2px;">Testimonial</div> 
                    <?php 
                    $page = (isset($_REQUEST['p']) && $_REQUEST['p']>0) ? $_REQUEST['p'] : 1; 
                    $recordsperpage =JFrame::getAppSetting('testmperpage');
                        foreach(JSuccessStory::getTestimonials(0," ispublish=1 order by storyid desc limit ".($page-1)*$recordsperpage.", ".$recordsperpage) as $story) { 
                    $filename = ((strlen(trim($story['filepath']))>4) && file_exists("assets/".$config['thumb'].$story['filepath'])) ? "assets/".$config['thumb'].$story['filepath'] : "assets/cms/".JFrame::getAppSetting('noimg'); 
                    ?> 
                        <div style="margin-top:3px">
                            <table cellpadding="0" cellpadding="5">
                                <tr>
                                    <td style="padding-left:0px">
                                        <div style='background:#fff;padding:3px'><img style="border:1px solid #ccc;border-bottom:none;" src="<?php echo $filename;?>" height="60" width="60"><br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:60px"></div></td>
                                    <td style="vertical-align:top;padding-left:5px;">
                                        <div class="jContent">
                                           <a class="jContent_title" style="text-decoration:none" href="index.php?spage=<?php echo $story['storyid'];?>"><?php echo $story['storytitle'];?></a> <Br> 
                                           <?php echo strip_tags(substr(strip_tags($story["storydescription"]),0,130))."... ";?></div>
                                           <div class="jContent" style="padding:3px;padding-left:0px;">
                                             Name:<span style='color:#444;font-weight:normal;'><?php echo $story['storyname'];?></span>&nbsp;&nbsp;
                                             PostedOn:<span style='color:#444;font-weight:normal;'><?php echo $story['postedon'];?></span>
                                           </div>  </td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;margin:2px">
                            <hr style="margin:0px;width: 90%;border:none;border-bottom:1px solid #f1f1f1">
                        </div>
                    <?php } ?>
   <?php
            $records = sizeof(JSuccessStory::getTestimonials());
            for($i=1;$i<=intval($records/$recordsperpage);$i++) {
                ?>
            <a href="testimonials.php?p=<?php echo $i;?>"><?php echo $i;?></a>
   <?php  } ?>
                   
<?php
include_once("includes/footer.php");
?>
