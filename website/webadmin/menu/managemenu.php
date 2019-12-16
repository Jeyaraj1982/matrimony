<?php include_once(__DIR__."/../header.php"); ?>
<body style="margin:0px;">
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                               $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
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
                                $('#frmitems').hide();
                                break;
                                
            case 'frmitems'   : $('#frmitems').show();
                                $('#frmgrp').show();
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
    setTimeout("getOpt()",1500);
</script>
    <?php 
    
            $obj = new CommonController();  
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
  
     if(isset($_POST{"updatebtn"})){
         
         $param=array("menuid"=>$_POST['rowid'],"menuname"=>$_POST['menuname'],"pagenameid"=>$_POST['pagenameid'],"isHeader"=>$_POST['isHeader'],"linkedto"=>$_POST['linkTo'],"target"=>$_POST['target'],"customurl"=>$_POST['customurl'],"orderf"=>$_POST['orderf']);            
 
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
                  /*  case 'frmvideo'     :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmvideoNo'];
                                           break;*/
                    case 'frmitems'     :  $param["customurl"] = "";
                                           $param['pagenameid'] = $_POST['frmitems'];
                                           break;
                }
              
           
         if ($obj->err==0) {
             $result = MenuItems::updateMenu($param);
          if ($result==1) {
            echo $obj->printSuccess("Menu Updated  Successfully") ; 
          } elseif ($result==0)
            echo $obj->printError("No changes made");
         } else {
             echo $obj->printError("Error upload");
         }
        
         $_POST{"editbtn"}="editbtn";       
      } 

      if (isset($_POST{"editbtn"})){
          
       $pageContent = MenuItems::getMenu($_POST['rowid']);
                             
       ?>
    <form action="" method="post">
    <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['menuid'];?>">
        <table style="margin:10px;width:450px;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
            <tr>
                <td style="padding-left:10px;">Menu Name</td>
                <td><input type="text" name="menuname" style="width:272px;" value="<?php echo $pageContent[0]['menuname'];?>"></td> 
            </tr>
            <tr>
                <td style="padding-left:10px;">Target</td>
                <td>
                    <select style="width:100px;" name="target" id="target">
                        <option value="0" <?php echo ($pageContent[0]['target']==0) ? "selected='selected'" : "";?>>Self Window</option>
                        <option value="1" <?php echo ($pageContent[0]['target']==1) ? "selected='selected'" : "";?>>New Window</option>
                    </select>
                    &nbsp;&nbsp;Menu Position&nbsp;
                    <select name="isHeader">
                        <option value="1" <?php echo ($pageContent[0]['isheader']==1) ? "selected='selected'" : "";?>>Header</option>
                        <option value="0" <?php echo ($pageContent[0]['isheader']==0) ? "selected='selected'" : "";?>>Footer</option>
                    </select>
                </td>
            </tr>
            <tr>
               <td>Menu Order</td>
               <td>
                    <select name="orderf">
                     <?php 
                        $m = ($pageContent[0]['isheader']==1) ? $mysql->select("select * from _jmenu where isheader=1") : $mysql->select("select * from _jmenu where isheader=0");   
                        for($i=1;$i<=sizeof($m);$i++) {?>
                        <option value="<?php echo $i;?>" <?php echo ($i==$pageContent[0]['orderf'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                    <?php } ?>
                    </select>
               </td>
            </tr>
            <tr>
                <td style="vertical-align: text-bottom;padding-left:10px;">Linked To</td>
                <td>
                    <select name="linkTo" id="linkTo" style="width:272px;" onchange="getOpt()">
                        <option value="frmpage" <?php echo ($pageContent[0]['linkedto']=='frmpage') ? "selected='selected'" : "";?>>From Page</option>
                        <option value="frmevent" <?php echo ($pageContent[0]['linkedto']=='frmevent') ? "selected='selected'" : "";?>>From Event</option> 
                        <option value="frmnews" <?php echo ($pageContent[0]['linkedto']=='frmnews') ? "selected='selected'" : "";?>>From News</option> 
                        <option value="frmphotos" <?php echo ($pageContent[0]['linkedto']=='frmphotos') ? "selected='selected'" : "";?>>From Photos</option> 
                        <option value="frmdownload" <?php echo ($pageContent[0]['linkedto']=='frmdownload') ? "selected='selected'" : "";?>>From Downloads</option> 
                        <option value="frmmusic" <?php echo ($pageContent[0]['linkedto']=='frmmusic') ? "selected='selected'" : "";?>>From Music</option>
                        <option value="frmvideo" <?php echo ($pageContent[0]['linkedto']=='frmvideo') ? "selected='selected'" : "";?>>From Video</option>  
                        <option value="exturl" <?php echo ($pageContent[0]['linkedto']=='exturl') ? "selected='selected'" : "";?>>External Url</option>
                        <option value="frmgrp" <?php echo ($pageContent[0]['linkedto']=='frmgrp') ? "selected='selected'" : "";?>>From Group</option>
                        <option value="frmgrp" <?php echo ($pageContent[0]['linkedto']=='frmitems') ? "selected='selected'" : "";?>>From Listing</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td valign="top">
                
                    <div id='frmpage'>
                        <select style="width:272px;" name="frmpageNo" id="frmpageNo">
                            <?php foreach(JPages::getPages() as $page) {?> 
                            <option value="<?php echo $page['pageid'];?>" <?php echo ($page['pageid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $page['pagetitle'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                     
                    <div id='frmevent' style="display:none;">
                        <select style="width:272px;" name="frmeventNo" id="frmeventNo">
                            <?php foreach(JPages::getEvents() as $event) {?>
                            <option value="<?php echo $event['pageid'];?>" <?php echo ($event['pageid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $event['pagetitle'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id='frmnews' style="display:none;">
                        <select style="width:272px;" name="frmnewsNo" id="frmnewsNo">
                            <?php foreach(JPages::getNews() as $news) {?>
                            <option value="<?php echo $news['pageid'];?>" <?php echo ($news['pageid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $news['pagetitle'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id='frmphotos' style="display:none;">
                        <select style="width:272px;" name="frmphotosNo" id="frmphotosNo">
                            <?php foreach(JPhotogallery::getPhotoGalleries() as $photo) {?>
                            <option value="<?php echo $photo['groupid'];?>"<?php echo ($photo['groupid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $photo['groupname'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id='frmdownload' style="display:none;">
                        <select style="width:265px;" name="frmdownloadNo" id="frmdownloadNo">
                            <?php foreach(JDownloads::getDownloadAlbum() as $download) {?>
                            <option value="<?php echo $download['dalbumid'];?>" <?php echo ($download['dalbumid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $download['albumtit'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id='frmmusic' style="display:none;">
                        <select style="width:272px;" name="frmmusicNo" id="frmmusicNo">
                            <?php foreach(JMusics::getMusicAlbum() as $music) {?>
                            <option value="<?php echo $music['albumid'];?>" <?php echo ($music['albumid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $music['albumtit'];?></option>
                            <?php } ?>
                        </select>
                    </div> 
                    <div id='frmvideo' style="display:none;">
                        <select style="width:272px;" name="frmvideoNo" id="frmvideoNo">
                            <option value="videos">All Videos</option>
                        </select>
                    </div>
                    <div id='frmvideo2' style="display:none;">
                            <select style="width:272px;" name="frmvideoNo" id="frmvideoNo">
                                <?php //foreach(JVideos::getVideos() as $video) {?>
                                <option value="<?php echo $video['videoid'];?>" <?php echo ($video['videoid']==$pageContent[0]['pageid'])? 'selected="selected"' : '';?>><?php echo $video['videotitle'];?></option>
                                <?php //} ?>
                            </select>
                        </div>   
                    <div id='frmgrp' style="display:none;">       
                        <select style="width:272px;" name="customurlG" id="customurlG">
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/photo.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/photo.php') ? "selected='selected'" : "";?>>Photos</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/videos.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/videos.php') ? "selected='selected'" : "";?>>Videos</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/musics.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/musics.php') ? "selected='selected'" : "";?>>Musics</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/downloads.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/downloads.php') ? "selected='selected'" : "";?>>Downloads</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/news.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/news.php') ? "selected='selected'" : "";?>>News</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/events.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/events.php') ? "selected='selected'" : "";?>>Events</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/successstory.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/successstory.php') ? "selected='selected'" : "";?>>Success Story</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/testimonials.php"<?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/testimonials.php') ? "selected='selected'" : "";?>>Testimonials</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/faq.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/faq.php') ? "selected='selected'" : "";?>>FAQ</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/browse.php" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/browse.php') ? "selected='selected'" : "";?>>Listing Category</option>
                            <option value="<?php echo JFrame::getAppSetting('siteurl');?>/browse.php?list=i" <?php echo ($pageContent[0]['customurl']==JFrame::getAppSetting('siteurl').'/browse.php?list=i') ? "selected='selected'" : "";?>>Listing Items</option>
                        </select>
                    </div>   
                    <div id="exturl" style="display:none;">
                        http://<input type="text" name="customurl" value="<?php echo $pageContent[0]['customurl'];?>" style="width:220px;">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="updatebtn" value="Update" bgcolor="grey">
                    <input type="submit" name="deletebtn" value="Delete" bgcolor="grey">
                </td>
            </tr>
        </table>
    </form>
     echo "<script>$('#success').hide(3000);</script>";
       <?php
       exit;
      }
      
        if(isset($_POST{"cdeletebtn"})) {
            MenuItems::deleteMenu($_POST['rowid']);
            echo CommonController::printSuccess("deleted Successfully");
            echo "<script>$('#success').hide(3000);</script>"; 
        }
        
        if (isset($_POST{"deletebtn"})){
            $pageContent = MenuItems::getMenu($_POST['rowid']); 
       ?>
       <form action='' method="post">
       <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
       <tr> 
            <td style="width:150px">Menu Name</td>
            <td><?php echo $pageContent[0]['menuname'];?></td>
        </tr>
        <tr>
            <td>Linked Page To</td>
            <td><?php echo $pageContent[0]['pageid'];?></td> 
        </tr>
        <tr> 
            <td>Menu Position</td>
            <td> <?php if ($pageContent[0]["isheader"]==1) {?>
                <span style='color:#08912A;font-weight:bold;'>Header</span> 
                 <?php } else { ?>
                <span style='color:#FF090D;font-weight:bold;'>Footer</span> 
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Target</td> 
            <td> <?php if ($pageContent[0]["target"]==1) {?>
                <span style='color:#08912A;font-weight:bold;'>New Window</span> 
                 <?php } else { ?>
                <span style='color:#08912A;font-weight:bold;'>Self Window</span> 
                <?php } ?>
            </td>
        </tr>
        <tr> 
            <td>Custom Page Link</td>
            <td><?php echo $pageContent[0]['customurl'];?></td>
        </tr>
       </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['menuid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn"> 
      </form>
       <?php }  ?>
</body>
 