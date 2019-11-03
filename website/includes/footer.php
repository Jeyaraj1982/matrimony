                                </td>
                                <?php
                                if (JFrame::getAppSetting('layout')==1) {
                                    include_once("includes/side.php");
                                }
                                ?>
                                </tr>
                        </table> 
                    </td>
                </tr>
                <tr>
                    <td bgcolor="<?php echo JFrame::getAppSetting('footerbanner');?>" colspan="2">
                        <table style="margin:10px;width:100%;"background: none repeat scroll 0 0 #ECD19A;border-top: 0px solid #fff; margin-top: 10; outline: 1px solid #e1e1e1;>
                            <tr>
                                <td width="33%">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                
                                                <a href='<?php echo JFrame::getAppSetting('facebookurl');?>'><img src="<?php echo web_path;?>assets/images/facebook.png"></a>
                                                <a href='<?php echo JFrame::getAppSetting('twitterurl');?>'><img src="<?php echo web_path;?>assets/images/twitter.png"></a>
                                                <a href='<?php echo JFrame::getAppSetting('youtubeurl');?>'><img src="<?php echo web_path;?>assets/images/youtube.png"></a>
                                                <a href='<?php echo JFrame::getAppSetting('googleplusurl');?>'><img src="<?php echo web_path;?>assets/images/googleplus.png"></a>
                                            </td>
                                        </tr>   
                                        <?php if (JFrame::getAppSetting('isenablesuccessstory')) { ?>
                                        <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="successstory.php">Success Story</a></td></tr>
                                        <?php } ?>
                                        <?php if (JFrame::getAppSetting('isenablefaq')) { ?>
                                        <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="faq.php">Faq</a></td></tr>
                                        <?php } ?>
                                        <?php if (JFrame::getAppSetting('isenabletestimonial')) { ?>
                                        <tr><td><img src="http://www.freundcontainer.com/images/art/grid-arrow-right.png"></td><td><a class="rmenu" href="testimonials.php">Testimonial</a></td></tr>
                                        <?php } ?>
                                    </table>
                                </td>
                                <td width="10%">
                                    <?php 
                                        if (JFrame::getAppSetting('isenablesubscriber')) {
                                            
                                            if (isset($_POST{"save"})) {
                                                if(JSubscriber::addSubscriber($_POST['subscribername'],$_POST['subscriberemail'],$_POST['subscribermobile'],$_POST['others'])>0){
                                                    echo CommonController::printSuccess("Subscriber Added successfully");       
                                                } else {
                                                    echo CommonController::printError("Error Adding Subscriber");
                                                }
                                            }
                                    ?>
                                    
                                    <div style=' padding:3px;font-weight:bold;color:#444;font-family:arial;font-size:12px;text-align:center;'>Subscriber</div>
                                    <form action="" method="post">
                                        <table  style="font-size:12px;font-family:arial;" cellpadding="3" cellspacing="0">
                                            <tr>
                                                <td>Name</td>
                                                <td><input type="text" name="subscribername" style="width:150px;"></td> 
                                            </tr>
                                            <tr>
                                                <td>Email Id</td>
                                                <td><input type="text" name="subscriberemail" style="width:150px;"></td>  
                                            </tr>
                                            <tr>
                                                <td>Mobile No.</td>
                                                <td><input type="text" name="subscribermobile" style="width:150px;"></td>  
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="left"><input type="submit" name="save" value="Subscribe Me" bgcolor="grey">  </td>
                                            </tr> 
                                        </table>
                                    </form>
                                        <script>$('#success').hide(3000);</script>
                                    <?php } ?>
                                </td>
                                <td width="20%" style="vertical-align:top;">
                                     <?php 
                                        if (JFrame::getAppSetting('displaycontactusonhome')==1) {
                                            
                                     ?>
                                     <div style=' padding:3px;font-weight:bold;color:#444;font-family:arial;font-size:14px;text-align:left;vertical-align:top;'>Contact Us</div>   
                                        <table style="font-size:12px;font-family:arial;" cellpadding="2" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align:top;text-align:left;">
                                                  <?php echo JFrame::getAppSetting('displaycontactus');?>
                                                </td>
                                             </tr>
                                        </table>
                                     <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>  
                <?php 
                $footer = MenuItems::getFooterMenuItems();
                if (sizeof($footer)>0) {
                    ?>
                <tr>
                    <td colspan="2" id="Jfooter" style="height:30px;clear:both;background:url('assets/cms/<?php echo JFrame::getAppSetting('footerbgimage');?>');background-color:<?php echo JFrame::getAppSetting('footerbgcolor');?>;padding: 5px 5px 5px 10px;">
                        <div class="JFooter">
                            <?php foreach($footer as $m) { ?>
                                <?php 
                                   // $pageurl = ($m['pageid']>0) ? "index.php?page=".$m['pageid'] : "http://".$m['customurl'] ;
                                    $target  = ($m['target']>0) ? " target='_blank' " : "";
                                    switch($m['linkedto']) {
                                        case 'frmphotos'  : $pageurl = JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$m['pageid'];
                                                            break;
                                        case 'exturl'     : $pageurl = "http://".$m['customurl'];
                                                            break;
                                        case 'frmpage'    : $pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                            break;
                                        case 'frmevent'   : $pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                            break;
                                        case 'frmnews'    : $pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                            break;
                                        case 'frmdownload': $pageurl = JFrame::getAppSetting('siteurl')."/downloads.php?dalbum=".$m['pageid'];
                                                            break;
                                        case 'frmmusic'   : $pageurl = JFrame::getAppSetting('siteurl')."/musics.php?album=".$m['pageid'];
                                                            break;
                                        case 'frmvideo'   : $pageurl = JFrame::getAppSetting('siteurl')."/videos.php?viewvid=".$m['pageid'];
                                                            break;
                                        case 'frmgrp'     : $pageurl = $m['customurl'];
                                                            break;
                                                                 
                        }
                                ?>
                                <a class="JFooter" color='blue' href='<?php echo $pageurl;?>' <?php echo $target; ?>><?php echo $m['menuname'];?></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="font-size:10px;font-family:'comic sans ms';text-decoration:none;color:#222;">All Copy Rights &copy; 2014-<?php echo date("Y");?> <?php echo JFrame::getAppSetting('sitename');?></td>
                </tr>
            </table>
        </td>
    </tr>
  </table>
</body>
</html>
 
<!-- 

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-1 sidenav">
    </div>
    <div class="col-sm-10 text-left"> 
      <h1>Welcome</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
    </div>
    <div class="col-sm-1 sidenav">
      
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-1 sidenav">
    </div>
    <div class="col-sm-10 text-left"> 
     
    </div>
    <div class="col-sm-1 sidenav">
      
    </div>
  </div>
</footer>

</body>
</html>
-->