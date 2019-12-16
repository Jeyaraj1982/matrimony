<?php include_once(__DIR__."/../header.php"); ?>
<div class="title_Bar">Menu </div> 
        <?php 
           
            
            $obj = new CommonController(); 
                
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
                
            if (isset($_POST{"save"})) {
            
                $param=array("menuname"=>str_replace('"','\"',str_replace("'","\'",$_POST['menuname'])),"isHeader"=>$_POST['isHeader'],"target"=>$_POST['target'],"linkedto"=>$_POST['linkTo']);               
 
                if (!((strlen(trim($_POST['menuname']))>=3))) {
                    echo $obj->printError("Please Enter Valid Menu Name");    
                }

                switch($_POST['linkTo']) {
                    case 'frmgrp'       :  $param["customurl"] = $_POST['customurlG'];
                                           $param['pagenameid'] = 0;
                                           break; 
                    case 'exturl'       :  $param["customurl"] = $_POST['customurl'];
                                           $param['pagenameid'] = 0;
                                           break;
                    case 'frmpage'      :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmpageNo'];
                                           break;
                                           
                    case 'frmevent'     :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmeventNo'];
                                           break;
                                           
                    case 'frmnews'      :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmnewsNo'];
                                           break;
                                          
                    case 'frmphotos'    :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmphotosNo'];
                                           break;
                                          
                    case 'frmdownload'  :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmdownloadNo'];
                                           break;
                                          
                    case 'frmmusic'     :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmmusicNo'];
                                           break;
                                           
                    case 'frmvideo'     :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmvideoNo'];
                                           break;
                        
                }  
                if ($obj->err==0) {
                    echo (MenuItems::addMenu($param)>0) ? $obj->printSuccess("New Menu Added successfully") : $obj->printError("Error Occured Adding New Menu");
                } 
            } 
        ?>
        <form action="" method="post" style="height: 20px;">
            <table style="margin:10px;width:450px;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="padding-left:10px;">Menu Name</td>
                    <td><input type="text" name="menuname" style="width:272px;"></td> 
                </tr>
                <tr>
                    <td style="padding-left:10px;">Target</td>
                    <td>
                        <select style="width:110px;" name="target" id="target">
                            <option value="0">Self Window</option>
                            <option value="1">New Window</option>
                        </select>
                        &nbsp;Menu Position
                        <select name="isHeader">
                            <option value="1">Header</option>
                            <option value="0">Footer</option>
                        </select>
                    </td>
                </tr>                                   
                <tr>
                    <td style="vertical-align: text-bottom;padding-left:10px;">Linked To</td>
                    <td>
                        <select name="linkTo" id="linkTo" style="width:272px;" onchange="getOpt()">
                            <option value="frmpage">From Page</option>
                            <option value="frmevent">From Event</option> 
                            <option value="frmnews">From News</option> 
                            <option value="frmphotos">From Photos</option> 
                            <option value="frmdownload">From Downloads</option> 
                            <option value="frmmusic">From Music</option> 
                            <option value="frmvideo">From Video</option> 
                            <option value="exturl">External Url</option>
                            <option value="frmgrp">From Group</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td valign="top">
                        
                        <div id='frmpage'>
                            <select style="width:272px;" name="frmpageNo" id="frmpageNo">
                                <?php foreach(JPages::getPages() as $page) {?>
                                <option value="<?php echo $page['pageid'];?>"><?php echo $page['pagetitle'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmevent' style="display:none;">
                            <select style="width:272px;" name="frmeventNo" id="frmeventNo">
                                <?php foreach(JPages::getEvents() as $event) {?>
                                <option value="<?php echo $event['pageid'];?>"><?php echo $event['pagetitle'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmnews' style="display:none;">
                            <select style="width:272px;" name="frmnewsNo" id="frmnewsNo">
                                <?php foreach(JPages::getNews() as $news) {?>
                                <option value="<?php echo $news['pageid'];?>"><?php echo $news['pagetitle'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmphotos' style="display:none;">
                            <select style="width:272px;" name="frmphotosNo" id="frmphotosNo">
                                <?php foreach(JPhotogallery::getPhotoGalleries() as $photo) {?>
                                <option value="<?php echo $photo['groupid'];?>"><?php echo $photo['groupname'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmdownload' style="display:none;">
                            <select style="width:265px;" name="frmdownloadNo" id="frmdownloadNo">
                                <?php foreach(JDownloads::getDownloadAlbum() as $download) {?>
                                <option value="<?php echo $download['dalbumid'];?>"><?php echo $download['albumtit'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmmusic' style="display:none;">
                            <select style="width:272px;" name="frmmusicNo" id="frmmusicNo">
                                <?php foreach(JMusics::getMusicAlbum() as $music) {?>
                                <option value="<?php echo $music['albumid'];?>"><?php echo $music['albumtit'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id='frmvideo' style="display:none;">
                            <select style="width:272px;" name="frmvideoNo" id="frmvideoNo">
                                <?php //foreach(JVideos::getVideos() as $video) {?>
                                <option value="<?php echo $video['videoid'];?>"><?php echo $video['videotitle'];?></option>
                                <?php //} ?>
                            </select>
                        </div>  
                        <div id='frmgrp' style="display:none;">       
                            <select style="width:272px;" name="customurlG" id="customurlG">
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/photo.php">Photos</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/videos.php">Videos</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/musics.php">Musics</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/downloads.php">Downloads</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/news.php">News</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/events.php">Events</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/successstory.php">Success Story</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/testimonials.php">Testimonials</option>
                                <option value="<?php echo JFrame::getAppSetting('siteurl');?>/faq.php">FAQ</option>
                            </select>
                        </div>   
                        <div id="exturl" style="display:none;">
                            http://<input type="text" name="customurl" style="width:220px;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="save" value="Save Menu" bgcolor="grey" class="submitbtnblue"></td>
                </tr>
            </table>
        </form>
        <script>$('#success').hide(3000);</script>
    </body>
</html>
<script>
    function getOpt() {
        
        var linkTo = $('#linkTo').val();
        
        switch(linkTo) {
            case 'frmpage'  :   $('#frmpage').show();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
                                
            case 'exturl'  :    $('#exturl').show();
                                $('#frmpage').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
                                
            case 'frmevent':    $('#frmevent').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
                             
            case 'frmnews' :    $('#frmnews').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
                                 
            case 'frmphotos' :  $('#frmphotos').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmdownload').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
            
            case 'frmdownload': $('#frmdownload').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmmusic').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide(); 
                                break;
                                
            case 'frmmusic'   : $('#frmmusic').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmgrp').hide();
                                $('#frmvideo').hide();
                                break;
                                 
            case 'frmvideo'   : $('#frmvideo').show();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmgrp').hide();
                                $('#frmmusic').hide();
                                break; 
                                   
            case 'frmgrp'     : $('#frmgrp').show();
                                $('#frmmusic').hide();
                                $('#frmpage').hide();
                                $('#exturl').hide();
                                $('#frmevent').hide();
                                $('#frmnews').hide();
                                $('#frmphotos').hide();
                                $('#frmdownload').hide();
                                $('#frmvideo').hide(); 
                                break;                     
                                                       
        }
    }
</script>