<?php 
include_once("config.php");
include_once("includes/header.php");


?>
                    <div class="jTitle" style="margin-left:2px;">Latest News</div> 
                    <?php 
                    $page = (isset($_REQUEST['p']) && $_REQUEST['p']>0) ? $_REQUEST['p'] : 1; 
                    $recordsperpage =JFrame::getAppSetting('newsperpage');
                        foreach(JPages::getNews(0," ispublish=1 order by pageid desc limit ".($page-1)*$recordsperpage.", ".$recordsperpage) as $news) { 
                    $filename = ((strlen(trim($news['filepath']))>4) && file_exists("assets/".$config['thumb'].$news['filepath'])) ? "assets/".$config['thumb'].$news['filepath'] : "assets/cms/".JFrame::getAppSetting('noimg'); 
                    ?> 
                        <div style="margin-top:3px">
                            <table cellpadding="0" cellpadding="5">
                                <tr>
                                    <td style="padding-left:0px">
                                        <div style='background:#fff;padding:3px'><img style="border:1px solid #ccc;border-bottom:none;" src="<?php echo $filename;?>" height="90" width="120"><br><img src="assets/images/shadow_220.png" style="margin-top:0px;width:120px"></div></td>
                                    <td style="vertical-align:top;padding-left:5px;">
                                        <div class="jContent">
                                            <a class="jContent_title" style="text-decoration:none" href="index.php?page=<?php echo $news['pageid'];?>"><?php echo $news['pagetitle'];?></a> <Br>
                                           <?php echo strip_tags(substr(strip_tags($news["pagedescription"]),0,130))."... ";?> 
                                        </div>
                                         <div class="jContent" style="padding-top:25px;padding-left:0px;">
                                            Posted On: <span style="color:#444;font-weight:normal;"><?php echo $news["postedon"]; ?></span>&nbsp;&nbsp;
                                            Visitors: <span style="color:#444;font-weight:normal;"><?php echo $news["noofvisit"];?></span>&nbsp;&nbsp; 
                                        </div>   
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style="text-align: center;margin:2px">
                            <hr style="margin:0px;width: 90%;border:none;border-bottom:1px solid #f1f1f1">
                        </div>
                    <?php } ?>
   <?php
            $records = sizeof(JPages::getNews());
            for($i=1;$i<=intval($records/$recordsperpage);$i++) {
                ?>
            <a href="news.php?p=<?php echo $i;?>"><?php echo $i;?></a>
   <?php
            }                  
                   
?>                   
<?php
include_once("includes/footer.php");
?>
