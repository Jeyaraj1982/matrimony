<html>
    <head>
        <title><?php echo JFrame::getAppSetting('sitetitle');?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
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
            
            ul.bjqs{position:relative; list-style:none;padding:0;margin:0;overflow:hidden; display:none;}
            li.bjqs-slide{position:absolute; display:none;}
            ul.bjqs-controls{list-style:none;margin:0;padding:0;z-index:9999;}
            ul.bjqs-controls.v-centered li a{position:absolute;}
            ul.bjqs-controls.v-centered li.bjqs-next a{right:0;}
            ul.bjqs-controls.v-centered li.bjqs-prev a{left:0;}
            ol.bjqs-markers{list-style: none; padding: 0; margin: 0; width:100%;display:none;}
            ol.bjqs-markers.h-centered{text-align: center;}
            ol.bjqs-markers li{display:inline;}
            ol.bjqs-markers li a{display:inline-block;}
            p.bjqs-caption{display:block;width:96%;margin:0;padding:2%;position:absolute;bottom:0;}
            #container{max-width:620px;margin:0 auto;padding-bottom:80px;}
            #banner-fade, #banner-slide{margin-bottom:0px;}
            ul.bjqs-controls.v-centered li a{display:<?php echo JFrame::getAppSetting('sliderhideicon');?>;padding:10px;background:#fff;font-family:Trebuchet MS;font-size:13px;color:#000;text-decoration: none;}
            ul.bjqs-controls.v-centered li a:hover{background:#000;color:#fff;}
            ol.bjqs-markers li a{padding:5px 10px;background:#000;color:#fff;margin:5px;text-decoration: none;}
            ol.bjqs-markers li.active-marker a, ol.bjqs-markers li a:hover{background: #999;}
            p.bjqs-caption{background: rgba(255,255,255,0.5);}
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
       
.topnav .icon {
  display: none;
}    

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
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
 
            $(function() {$( "#datepicker" ).datepicker({showOn: 'button',buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png',width:20,height:20,buttonImageOnly: true,changeMonth: true,changeYear: true,showAnim: 'slideDown',duration: 'fast',dateFormat: 'dd-mm-yy'}); });
        </script>
         <script src="<?php echo web_path;?>assets/js/bjqs-1.3.min.js"></script>
         
         
         
         
         
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
  
  
    </head>  
    <body style="background:url('assets/cms/<?php echo JFrame::getAppSetting('backgroundimage');?>')<?php echo JFrame::getAppSetting('sitebgposition');?>;background-color:<?php echo JFrame::getAppSetting('backgroundcolor');?>;margin:0px;">
    
        <div style="clear:both;background:url('assets/cms/<?php echo JFrame::getAppSetting('headerbgimg');?>');background-color:<?php echo JFrame::getAppSetting('headerbgcolor');?>;padding: 5px 5px 5px 10px;">
            <a href="<?php echo JFrame::getAppSetting('siteurl');?>"><img src='<?php echo web_path;?>data/<?php echo JFrame::getAppSetting('logo');?>' style="min-height:64px;max-height:64px;max-width:200px ;"></a>
        </div>
        <div id="subMenu" style="background:url('assets/cms/<?php echo JFrame::getAppSetting('menubackgroundimage');?>');background-color:<?php echo JFrame::getAppSetting('menubgcolor');?>;padding: 5px 5px 5px 10px;margin:0px auto;min-height: 30px;">
            <div style="max-width:1024px;margin:0px auto">
                <div class="topnav" id="myTopnav">
                <a class="sub_Menu" href='<?php echo JFrame::getAppSetting('siteurl');?>'>Home</a>
                <?php 
                    foreach(MenuItems::getHeaderMenuItems() as $m) {
                        
                        $target  = ($m['target']>0) ? " target='_blank' " : "";
                
                        switch($m['linkedto']) {
                            
                            case 'frmphotos'  : $pageurl = JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$m['pageid'];
                                                break;
                            case 'exturl'     : $pageurl = "http://".$m['customurl'];
                                                break;
                            case 'frmpage'    : //$pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                $pageurl = JFrame::getAppSetting('siteurl')."/".$m['pagefilename'];
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
                <a class="sub_Menu" href='<?php echo $pageurl;?>' <?php echo $target; ?> ><?php echo $m['menuname'];?></a>
                <?php } ?>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
            </div>
            </div>
        </div>
        <div style="width: 100%;">
         <div id="banner-fade">
                        <ul class="bjqs">
                            <?php foreach(JSlider::getActiveSliders() as $sliderimage) {?>
                            <li><img src='<?php echo $config['slider'].$sliderimage['filepath'];?>' style="width:100%"></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <script class="secret-source">jQuery(document).ready(function($) {$('#banner-fade').bjqs({heigh:350,width:'100%',responsive:true});});</script>
        </div>
        <!--<table align="center" cellpadding="0" cellspacing="0"style="width:1024px; border:0px solid #3A3A3A">-->
        <table align="center" cellpadding="0" cellspacing="0"style="width:100%; border:0px solid #3A3A3A">
         <!--   <tr>
                <td colspan="2" style="clear:both;background:url('assets/cms/<?php echo JFrame::getAppSetting('headerbgimg');?>');background-color:<?php echo JFrame::getAppSetting('headerbgcolor');?>;padding: 5px 5px 5px 10px;">
                   <a href="<?php echo JFrame::getAppSetting('siteurl');?>"><img src='<?php echo web_path;?>data/<?php echo JFrame::getAppSetting('logo');?>' style="min-height:64px;max-height:64px;max-width:200px ;"></a>
                </td>
            </tr>
            <tr>
                <td id="subMenu" style="height:30px;clear:both;background:url('assets/cms/<?php echo JFrame::getAppSetting('menubackgroundimage');?>');background-color:<?php echo JFrame::getAppSetting('menubgcolor');?>;padding: 5px 5px 5px 10px;margin:0px auto">
                    <div class="topnav" id="myTopnav">
                        <a class="sub_Menu" href='<?php echo JFrame::getAppSetting('siteurl');?>'>Home</a>
                        <?php 
                            foreach(MenuItems::getHeaderMenuItems() as $m) {
                                
                                $target  = ($m['target']>0) ? " target='_blank' " : "";
                        
                                switch($m['linkedto']) {
                                    
                                    case 'frmphotos'  : $pageurl = JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$m['pageid'];
                                                        break;
                                    case 'exturl'     : $pageurl = "http://".$m['customurl'];
                                                        break;
                                    case 'frmpage'    : //$pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                        $pageurl = JFrame::getAppSetting('siteurl')."/".$m['pagefilename'];
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
                        <a class="sub_Menu" href='<?php echo $pageurl;?>' <?php echo $target; ?> ><?php echo $m['menuname'];?></a>
                        <?php } ?>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                   
                    <div id="banner-fade">
                        <ul class="bjqs">
                            <?php foreach(JSlider::getActiveSliders() as $sliderimage) {?>
                            <li><img src='<?php echo $config['slider'].$sliderimage['filepath'];?>' style="width:100%"></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <script class="secret-source">jQuery(document).ready(function($) {$('#banner-fade').bjqs({heigh:350,width:'100%',responsive:true});});</script>
                </td>
            </tr> -->
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <?php
                                if (JFrame::getAppSetting('layout')==2) {
                                    include_once("includes/side.php");
                                }
                            ?>
                            <td valign="top" style="background:#fff;padding:10px;">