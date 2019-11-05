<html>
    <head>
        <title><?php echo JFrame::getAppSetting('sitetitle');?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
        <!--<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>-->
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo web_path;?>assets/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <link rel="stylesheet" href="<?php echo web_path;?>assets/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo web_path;?>assets/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <link rel="stylesheet" href="<?php echo web_path;?>assets/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo web_path;?>assets/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="<?php echo web_path;?>assets/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <link rel="stylesheet" href="<?php echo web_path;?>assets/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo web_path;?>assets/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <style >
            .jTitle {font-family:Oswald;font-size:18px;border-bottom:3px solid #222;color:#222;margin-bottom:5px;}
            .jContent {font-family:'Droid Sans';font-size:13px;color:#444444}
            .jContent_title {line-height:30px;margin-bottom:5px;font-size:15px;color:#047D9B;font-family:'Droid Sans';font-weight:Bold;border-bottom:2px solid #FCFCFC;width:auto}
            .jContent_title:hover {cursor:pointer;border-bottom:2px solid #047D9B;font-size:15px;color:#047D9B;font-family:'Droid Sans';font-weight:Bold;}
            .jMore {text-align:right;margin:5px;margin-right:10px;font-family:'Droid Sans';font-size:12px;color:#C42121}
            .ui-datepicker {font-size:9pt;font-family:Verdana; background-color:yellow;}
            .datepicker{color:blue;text-decoration: none;font-size:inherit;font-size:12px;position: relative; top: 1px;}
            .margtop20 {margin-top: 20px !important;}
            .menu {color:white;font-family:arial;font-size:12px;text-decoration: none;font-weight:bold}
            .body {margin:4px;margin-bottom:0px;margin-left:0px;margin-right:0px}
            .title{color:#6F7F05;margin-top:20px;padding-bottom:15px;margin-bottom:30px;border-bottom:1px solid #AFC719;font-size:24px;font-family:arial;font-weight:bold}
            .content{color:#222;font-family:arial;font-size:13px;line-height:20px;text-align: justify;padding:10px;}
            .table{font-size:12px;font-family:arial;text-align: justify;}
            .textBox {background-color:#FFFFFF;border: 2px solid #ebebeb;border-radius: 4px;color: #999;display: block;font-size: 14px;height: 34px;line-height: 1.42857;padding: 6px 0 6px 12px;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;vertical-align: middle;width: 45%;}
            .sub_Menu {text-transform: uppercase;color:<?php echo JFrame::getAppSetting('menufontcolor');?>;cursor: pointer; float: left; font-family: '<?php echo JFrame::getAppSetting('menufont');?>';font-size:<?php echo JFrame::getAppSetting('menufontsize');?>;padding: 5px 15px;text-align: left;text-decoration:none;}
            .sub_Menu:hover{color:<?php echo JFrame::getAppSetting('headerhover');?>;font-family:'<?php echo JFrame::getAppSetting('menufont');?>';font-size:'<?php echo JFrame::getAppSetting('menufontsize');?>';text-decoration: underline;}                                              
            .rmenu {font-size:13px;font-family:'comic sans ms';text-decoration:none;color:#333;}
            .rmenu:hover {font-size:13px;font-family:'comic sans ms';text-decoration:underline;color:#222;}
            .Jfooter {text-transform: uppercase;color:<?php echo JFrame::getAppSetting('footerfontcolor');?>;cursor: pointer; float: left; font-family:'<?php echo JFrame::getAppSetting('footerfont');?>';font-size:<?php echo JFrame::getAppSetting('footerfontsize');?>;padding: 5px 15px;text-align: left;text-decoration:none;}
            .Jfooter:hover{color:<?php echo JFrame::getAppSetting('footerhover');?>;font-family:'<?php echo JFrame::getAppSetting('footerfont');?>';font-size:'<?php echo JFrame::getAppSetting('footerfontsize');?>';text-decoration: underline;}
            .headerlink{background: #00953d;}   /*#e60058 */
            .headerlink:hover{background: #00953d;}
            .nav-link:hover{background: #00953d;}
             .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: 1.5rem;
                padding-left: 1.5rem;
                padding-top: 1rem;
                padding-bottom: 1rem;
                } 
            #container{max-width:620px;margin:0 auto;padding-bottom:80px;}
            #banner-fade, #banner-slide{margin-bottom:0px;}
            
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .topnav .icon {display: none;}    
            @media screen and (max-width: 600px) {
                .topnav a:not(:first-child) {display: none;}
                .topnav a.icon {float: right;display: block;}
            }
            @media screen and (max-width: 600px) {
                .topnav.responsive {position: relative;}
                .topnav.responsive .icon {position: absolute;right: 0;top: 0;}
                .topnav.responsive a {float: none;display: block;text-align: left;}
            }
        </style>
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
 
            //$(function() {$( "#datepicker" ).datepicker({showOn: 'button',buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png',width:20,height:20,buttonImageOnly: true,changeMonth: true,changeYear: true,showAnim: 'slideDown',duration: 'fast',dateFormat: 'dd-mm-yy'}); });
        </script>
         <script src="<?php echo web_path;?>assets/js/bjqs-1.3.min.js"></script>
         <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
         <style>
         .navbar {margin-bottom: 0;border-radius: 0;}
         .row.content {height: 450px}
         .sidenav {padding-top: 20px;background-color: #f1f1f1;height: 100%;}
         footer {background-color: #555;color: white;padding: 15px;}
         @media screen and (max-width: 767px) {
             .sidenav {height: auto;padding: 15px;}
             .row.content {height:auto;} 
         }
         
  .carousel-inner img {
      width: 100%;
     
  }
  #registerbtn:hover{
      background:#d3175f;
      color:white;
  }
  
         </style>
    </head>  
    <body style="background:url('assets/cms/<?php echo JFrame::getAppSetting('backgroundimage');?>')<?php echo JFrame::getAppSetting('sitebgposition');?>;background-color:<?php echo JFrame::getAppSetting('backgroundcolor');?>;margin:0px;">
    
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div style="clear:both;background:url('assets/cms/<?php echo JFrame::getAppSetting('headerbgimg');?>');background-color:<?php echo JFrame::getAppSetting('headerbgcolor');?>;padding: 5px 5px 5px 10px;">
                    <a href="<?php echo JFrame::getAppSetting('siteurl');?>"><img src='<?php echo web_path;?>data/<?php echo JFrame::getAppSetting('logo');?>' style="min-height:64px;max-height:64px;max-width:200px;"></a>
                </div>
            </div>
            <div class="col-sm-6" style="text-align:right;padding: 5px 5px 5px 10px;">
                <a href="<?php echo JFrame::getAppSetting('siteurl')."/login";?>" class="btn btn-primary" style="margin-top: 12px;padding-top: 2px;padding-bottom: 7px;">Login</a>&nbsp;
                <a href="<?php echo JFrame::getAppSetting('siteurl')."/register";?>" class="btn btn-default" id="registerbtn" style="background: none;border-color:#d3175f;color:#d3175f;margin-top: 12px;padding-top: 2px;padding-bottom: 7px;">Register Now</a> 
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg  navbar-dark primary-color" style="background:url('assets/cms/<?php echo JFrame::getAppSetting('menubackgroundimage');?>');background-color:<?php echo JFrame::getAppSetting('menubgcolor');?>;padding-top:0px;padding-bottom:0px">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $_GET['x']=="" ? " active headerlink" : "";?>" href='<?php echo JFrame::getAppSetting('siteurl');?>' <?php echo $target; ?> >Home</a>
                    </li>
                    <?php 
                        foreach(MenuItems::getHeaderMenuItems() as $m) {
                            
                            $target  = ($m['target']>0) ? " target='_blank' " : "";
                            
                            switch($m['linkedto']) {
                                
                                case 'frmphotos'  : $pageurl = JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$m['pageid'];
                                                    break;
                                case 'exturl'     : $pageurl = "http://".$m['customurl'];
                                                    break;
                                case 'frmpage'    : $pageurl = JFrame::getAppSetting('siteurl')."/".$m['pagefilename'];
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
                                case 'predefined' : $pageurl = JFrame::getAppSetting('siteurl')."/".$m['customurl'];
                                                    break;
                            }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $d[0]==$m['pagefilename'] ? " active headerlink" : "";?>" href='<?php echo $pageurl;?>' <?php echo $target; ?> ><?php echo $m['menuname'];?></a>
                    </li>
                <?php 
                        } ?>
                </ul>
            </div>  
        </div>
    </nav>
    
    <?php if (!(isset($isShowSlider) && $isShowSlider==false)) {?>
    <div id="slider" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <?php $c=0; $si = JSlider::getActiveSliders(); ?>
            <?php for($i=0;$i<sizeof($si);$i++) {?>
                <li data-target="#slider" data-slide-to="<?php echo $i;?>>" <?php echo $i==0 ? ' class="active headerlink" ' : '';?> ></li>
            <?php } ?>
            </ul>
            <div class="carousel-inner">
            <?php  foreach($si as $sliderimage) {?>
                <div class="carousel-item <?php echo $c==0 ?  "active headerlink"  : '';?>">
                    <img src="<?php echo $config['slider'].$sliderimage['filepath'];?>" alt="">
                </div>
                <?php $c++; } ?>
            </div>
            <a class="carousel-control-prev" href="#slider" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slider" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <?php } ?>
        
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <?php
                    if (JFrame::getAppSetting('layout')==2) {
                        echo '<div class="col-sm-3">';
                        include_once("includes/side.php");
                        echo '</div>';
                    }
                ?>
                <div class="col-sm-9" style="line-height:26px;text-align:justify">