              
        
     </div>
<footer class="footer" style="padding:15px 0px !important;padding-bottom:0px !important;background-color:#222222;color: #999999;">
    <div class="footer_top">
        <div class="container" style="padding-top: 40px;padding-bottom: 40px;">
            <div class="row">
                <div class="col-sm-3">
                    <div class="footer_widget">
                       <!-- <h3 class="footer_title">
                            Departments
                        </h3>-->
                        <ul style="list-style: none;">
                            <li><a style="color:#fff" href="<?php echo JFrame::getAppSetting('siteurl')."/terms-of-conditions";?>">Terms of Conditions</a></li>
                            <li><a style="color:#fff" href="<?php echo JFrame::getAppSetting('siteurl')."/privacy-policy";?>">Privacy Policy</a></li>
                            <li><a style="color:#fff" href="<?php echo JFrame::getAppSetting('siteurl')."/refund-policy";?>">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="footer_widget">
                        <!--<h3 class="footer_title">Useful Links</h3>-->
                        <ul style="list-style: none;">
                            <li><a style="color:#fff" href="<?php echo JFrame::getAppSetting('siteurl')."/faq";?>">FAQ</a></li>
                            <li><a style="color:#fff" href="<?php echo JFrame::getAppSetting('siteurl')."/success-stories";?>">Success Stories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            
                        </h3>
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-2" style="background:#111;padding: 15px 0 15px 0;">
        <div class="container" style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
            <div class="row" style="margin-right: -15px;margin-left: -15px;">
              <div class="col-sm-12">
                <div class="col-sm-6">
                    All Rights Reserved 
                    <a style="color:#fff" href=""></a>
                    Copyrights &copy; 2019.
                </div>
                <div class="col-sm-6">
                  <!--  Trusted By :  
                    <img src="http://wedlink.in/application/views/front_end/default/source/img/visa.png" alt="visa">
                    <img src="http://wedlink.in/application/views/front_end/default/source/img/mastercard.png" alt="Master Card">
                    <img src="http://wedlink.in/application/views/front_end/default/source/img/paypal.png" alt="PayPal">
                    <img src="http://wedlink.in/application/views/front_end/default/source/img/RuPay2.png" alt="Rupay">
                    ==>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!--<div class="copy-right_text" style="background:#111111;">
        <div class="container">
            <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            Copyright ©<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript">document.write(new Date().getFullYear());</script>2019 All rights reserved
                        </p>
                    </div>
                </div>
            </div>              
        </div>-->
</footer> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                 
                 <?php /*
                    </td>
                </tr>
                <tr>
                    <td bgcolor="<?php echo JFrame::getAppSetting('footerbanner');?>" colspan="2" style="padding:10px">
                        <table style="width:100%;background: none repeat scroll 0 0 #ECD19A;border-top: 0px solid #fff; margin-top: 10; outline: 1px solid #e1e1e1;">
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
  <?php */ ?>
  
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