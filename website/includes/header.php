<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="icon" href="<?php echo $_SITEPATH."assets/".$config['thumb'].JFrame::getAppSetting('favoriteicon');?>" type="image/gif" sizes="16x16"> 
        <meta http-equiv="Content-Type" charset="utf-8"/>
       
        <title><?php echo $title;?></title>
        <meta name="description" content="<?php echo $description;?>" />
        <meta name="Keywords" content="<?php echo $keywords;?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index,follow" />
        
        <meta itemprop="name" content="<?php echo $itemname;?>">
        <meta itemprop="description" content="<?php echo $description; ?>">
        <meta itemprop="image" content="<?php echo $ogImage; ?>">
        
        <meta property="og:title" content="<?php echo $itemname;?>"/>
        <meta property="og:url" content="<?php echo $ogUrl;?>" />
        <meta property="og:image" content="<?php echo $ogImage;?>" />
        <meta property="og:image:url" content="<?php echo $ogImage;?>" />
        <meta property="og:image:alt" content="<?php echo $ogImage;?>" />
        <?php if (isset($imgData)) {?>
            <meta property="og:image:type" content="<?php echo $imgData['mime'];?>" />
            <meta property="og:image:width" content="<?php echo $imgData[0];?>" />
            <meta property="og:image:height" content="<?php echo $imgData[1];?>" />
        <?php }?>
        <meta property="og:locale" content="en_US" />
        <meta property="og:description" content="<?php echo $description; ?>"/>
        <meta property="og:site_name" content="<?php echo $_SITEPATH;?>" />
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content="<?php echo date("Y-m-d H:i:s");?>" />
        <meta property="article:modified_time" content="<?php echo date("Y-m-d H:i:s");?>" />
        <meta property="article:expiration_time" content="<?php echo date("Y-m-d H:i:s");?>" />
        <meta property="og:type" content="article">
        <meta itemprop="og:headline" content="<?php echo $itemname;?>" />
        <meta itemprop="og:description" content="<?php echo $description;?>" />
        
         
  
  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
        <!--<script src="http://code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js" type="text/javascript"></script>      -->
        <script src="<?php echo BaseUrl;?>assets/lib/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
        <script src="<?php echo BaseUrl;?>assets/js/app.js" type="text/javascript"></script>   
        
        <link href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <link href="<?php echo BaseUrl;?>assets/source/jquery.fancybox.css?v=2.1.5" type="text/css"   media="screen" rel="stylesheet"/>
        <link href="<?php echo BaseUrl;?>assets/source/helpers/jquery.fancybox-buttons.css?v=1.0.5"   media="screen" rel="stylesheet"/>
        <link href="<?php echo BaseUrl;?>assets/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7"  media="screen" rel="stylesheet"/>
        <style>
	.errorstring {
		color:red;
		font-size:12px;
	}
    
</style>
<style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  </style>
		<script>
		function showHidePwd(pwd,btn) {
    
  var x = document.getElementById(pwd);
  if (x.type === "password") {
    x.type = "text";
    
    btn.html('<i class="glyphicon glyphicon-eye-close"></i>');
  } else {
    x.type = "password";
    btn.html('<i class="glyphicon glyphicon-eye-open"></i>');
  }
}
        /*Facebook Start*/
        //Whatsspp
    function postToWhatsApp(sharemessage) {

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var text =sharemessage;// $(".Article_Headline ").text();
            var url = location.href;
            var message = encodeURIComponent(text) + encodeURIComponent(url);           
            var whatsapp_url = "whatsapp://send?text=" + message;
            window.location.href = whatsapp_url;
        } else {
            alert("You are not in Mobile Device");
        }
    }
        /*Twitter*/
function postToTWTTR(placement, url, title, shareObject) {
    // social_button_clicked('twitter', placement);

    var width = 575,
                    height = 400,
                    left = (window.outerWidth - width) / 2,
                    top = (window.outerHeight - height) / 2,
                    url = url,
                    opts = 'resizable=1,scrollbars=1,status=1' +
                             ',width=' + width +
                             ',height=' + height +
                             ',top=' + top +
                             ',left=' + left, twitterVia = 'dt_next';

    var articleSharingUrl = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(' ' + url + '');
    var shareObjectSharingUrl = getSharingUrl(shareObject);
    var sharingUrl = shareObjectSharingUrl || articleSharingUrl;
    var newwindow = window.open(sharingUrl, "", opts);

    function getSharingUrl(shareObject) {
        var sharingUrl = null;
        if (shareObject) {
            var parsedShareObject = JSON.parse(shareObject);
            sharingUrl = 'https://twitter.com/share?' +
                                 (parsedShareObject.url ? 'url=' + encodeURIComponent(parsedShareObject.url) : '');
        }
        return sharingUrl;
    }
}
/*End*/

function postToFB(placement, url, shareObject) {
    var caption = $("#item_title").text();
    var picture = $("#item_image").attr('src');
    var description = $("#item_shortdesc").text();
    var link = window.location.href;
    var width = 600,
                    height = 450,
                    left = (window.outerWidth - width) / 2,
                    top = (window.outerHeight - height) / 2,
                    url = url,
                    opts = 'resizable=1,scrollbars=1,status=1' +
                             ',width=' + width +
                             ',height=' + height +
                             ',top=' + top +
                             ',left=' + left;

    var sharingUrl = getSharingUrl(shareObject) || ("https://www.facebook.com/sharer/sharer.php?u=" + url);

    var newwindow = window.open(sharingUrl, "", opts);

    function getSharingUrl(shareObject) {
        var sharingUrl = null;
        if (shareObject) {
            shareObject = JSON.parse(shareObject);
            sharingUrl = 'https://www.facebook.com/dialog/feed?app_id=146202712090395' +
                                 (shareObject.link ? '&link=' + encodeURIComponent(link) : '') +
                                 (shareObject.picture ? '&picture=' + encodeURIComponent(picture) : '') +
                                 (shareObject.name ? '&name=' + encodeURIComponent(link) : '') +
                                 (shareObject.caption ? '&caption=' + encodeURIComponent(caption) : '') +
                                 (shareObject.description ? '&description=' + encodeURIComponent(description) : '') +
                                 (shareObject.redirect_uri ? '&redirect_uri=' + encodeURIComponent(link) : '');
        }
        return sharingUrl;
    };

}

/*Google Plus*/
function postToGPlus(placement, url, shareObject) {
    
    var width = 300,
                    height = 500,
                    left = (window.outerWidth - width) / 2,
                    top = (window.outerHeight - height) / 2,
                    url = url,
                    opts = 'resizable=1,scrollbars=1,status=1' +
                             ',width=' + width +
                             ',height=' + height +
                             ',top=' + top +
                             ',left=' + left;
    var headline = $("#item_title").text();
    var Abstract = $("#item_shortdesc ").text();
    var sharingUrl = getSharingUrl(shareObject) || ("https://plus.google.com/share?url=" + url);

    var newwindow = window.open(sharingUrl, "", opts);

    function getSharingUrl(shareObject) {
        var sharingUrl = null;
        if (shareObject) {
            shareObject = JSON.parse(shareObject);
            sharingUrl = (shareObject.link ? '&link=' + encodeURIComponent(shareObject.link) : '') +
                                 (shareObject.picture ? '&picture=' + encodeURIComponent(shareObject.picture) : '') +
                                 (shareObject.name ? '&name=' + encodeURIComponent(shareObject.name) : '') +
                                 (shareObject.caption ? '&caption=' + encodeURIComponent(shareObject.caption) : '') +
                                 (shareObject.description ? '&description=' + encodeURIComponent(shareObject.description) : '') +
                                 (shareObject.redirect_uri ? '&redirect_uri=' + encodeURIComponent(shareObject.redirect_uri) : '');
        }
        return sharingUrl;
    };
}
/*End*/

/*End*/


function gobrowsepage() {
    var page="<?php echo isset($_REQUEST['p']) ? '&page='.$_REQUEST['p'] : '&p=1'?> ";
    location.href='browse.php?l='+$("#browse_allitems_categorywise").val()+'&o='+$("#browse_allitems_orderby").val()+'&s='+$('#searchkeyword').val()+page;
}
$(document).ready(function(){
    $('#searchkeyword').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        gobrowsepage();
    }
});
});
        </script>
    
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
              .rmenu {font-size:13px;font-family:'comic sans ms';text-decoration:none;color:#333;}
            .rmenu:hover {font-size:13px;font-family:'comic sans ms';text-decoration:underline;color:#222;}
            .Jfooter {text-transform: uppercase;color:#<?php echo JFrame::getAppSetting('footerfontcolor');?>;cursor: pointer; float: left; font-family:'<?php echo JFrame::getAppSetting('footerfont');?>';font-size:<?php echo JFrame::getAppSetting('footerfontsize');?>px;padding: 5px 15px;text-align: left;text-decoration:none;}
            .Jfooter:hover{color:#<?php echo JFrame::getAppSetting('footerhover');?>;font-family:'<?php echo JFrame::getAppSetting('footerfont');?>';font-size:<?php echo JFrame::getAppSetting('footerfontsize');?>px;text-decoration: underline;}
           
        .listitems{width:237px;padding:5px;margin-top:5px;margin-top:10px;border:1px solid #eee;float:left;margin-left:5px;margin-bottom:5px;}
        .listitems table {font-family:arial;font-size:12px;width:100%;}
        .itemimage {height:177px;width:237px;}
        .itemprice {background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;font-weight: bold;text-align: center;padding:5px;}
        .listitems:hover{background:#f1f1f1;border:1px solid #ccc}
        
        .iistitemTitleLink{font-family:arial;font-size:13px;color:blue;text-decoration: none;color:#555;font-weight:bold;}
        .iistitemTitleLink:hover{text-decoration:underline;}
        .listitemSubTitle{color:#666;font-family:arial;font-size:12px;padding-bottom:12px;}
     
    
            .subMenu {
               /* height:<?php echo JFrame::getAppSetting('menu_height');?>px;*/
                clear:both;
               
                 <?php if (JFrame::getAppSetting('menu_background_image_color_noneed')==0) { ?> 
                    <?php if (strlen(trim(JFrame::getAppSetting('menubackgroundimage')))>0) {?>                 
                        background:url('<?php echo $_SITEPATH;?>/<?php echo $config['thumb'].JFrame::getAppSetting('menubackgroundimage');?>');
                    <?php } ?>
                background-color:#<?php echo JFrame::getAppSetting('menubgcolor');?>;
                <?php } ?>
                
                background-color:#<?php echo JFrame::getAppSetting('menubgcolor');?>;
                border-left: <?php echo JFrame::getAppSetting('menu_border_left_size');?>px <?php echo JFrame::getAppSetting('menu_border_left_style');?> #<?php echo JFrame::getAppSetting('menu_border_left_color');?>;
                border-right: <?php echo JFrame::getAppSetting('menu_border_right_size');?>px <?php echo JFrame::getAppSetting('menu_border_right_style');?> #<?php echo JFrame::getAppSetting('menu_border_right_color');?>;
                border-top: <?php echo JFrame::getAppSetting('menu_border_top_size');?>px <?php echo JFrame::getAppSetting('menu_border_top_style');?> #<?php echo JFrame::getAppSetting('menu_border_top_color');?>;
                border-bottom: <?php echo JFrame::getAppSetting('menu_border_bottom_size');?>px <?php echo JFrame::getAppSetting('menu_border_bottom_style');?> #<?php echo JFrame::getAppSetting('menu_border_bottom_color');?>;
                border-radius: <?php echo JFrame::getAppSetting('menu_radius_left_top');?><?php echo JFrame::getAppSetting('menu_radius_left_top_scale');?> <?php echo JFrame::getAppSetting('menu_radius_right_top');?><?php echo JFrame::getAppSetting('menu_radius_right_top_scale');?> <?php echo JFrame::getAppSetting('menu_radius_right_bottom');?><?php echo JFrame::getAppSetting('menu_radius_right_bottom_scale');?> <?php echo JFrame::getAppSetting('menu_radius_left_bottom');?><?php echo JFrame::getAppSetting('menu_radius_left_bottom_scale');?>;
            }
            
              .sub_Menu {
                text-transform: <?php echo JFrame::getAppSetting('menu_text_transform');?>;
                cursor: pointer;
                float: left;
                text-align: left;
                
                color:#<?php echo JFrame::getAppSetting('menufontcolor');?>;
                font-family: '<?php echo JFrame::getAppSetting('menufont');?>';
                font-size:<?php echo JFrame::getAppSetting('menufontsize');?>px;
                
                font-weight:<?php echo JFrame::getAppSetting('menu_font_bold')==1 ? 'bold' : 'none';?>;
                font-style: <?php echo JFrame::getAppSetting('menu_font_italic')==1 ? 'italic' : 'none';?>;
                text-decoration: <?php echo JFrame::getAppSetting('menu_font_underline')==1 ? 'underline' : 'none';?>;
                
                padding-left:<?php echo JFrame::getAppSetting('menu_text_padding_left');?>px;
                padding-right:<?php echo JFrame::getAppSetting('menu_text_padding_right');?>px;
                padding-top:<?php echo JFrame::getAppSetting('menu_text_padding_top');?>px;
                padding-bottom:<?php echo JFrame::getAppSetting('menu_text_padding_bottom');?>px;
                
                <?php if (JFrame::getAppSetting('menu_seperator_need')==1) {?>
                border-right:<?php echo JFrame::getAppSetting('menu_seperator_size'); ?>px solid #<?php echo JFrame::getAppSetting('menu_seperator_color'); ?>;
                <?php } ?>       
            }
            
            .sub_Menu:hover {
                
                text-transform: <?php echo JFrame::getAppSetting('menu_text_hover_transform');?>;
               
                color:#<?php echo JFrame::getAppSetting('menu_hover_font_color');?>;
                font-family:'<?php echo JFrame::getAppSetting('menufont');?>';
                font-size:'<?php echo JFrame::getAppSetting('menufontsize');?>px';
                
                font-weight:<?php echo JFrame::getAppSetting('menu_hover_font_bold')==1 ? 'bold' : 'none';?>;
                font-style: <?php echo JFrame::getAppSetting('menu_hover_font_italic')==1 ? 'italic' : 'none';?>;
                text-decoration: <?php echo JFrame::getAppSetting('menu_hover_font_underline')==1 ? 'underline' : 'none';?>;
                
                <?php if (JFrame::getAppSetting('need_menu_hover_backgroundcolor')==1) {?>
                background: #<?php echo JFrame::getAppSetting('menu_hover_backgroundcolor'); ?>;
                <?php } ?>
            }  
            
            .sub_Menu_active {
                
                text-transform: <?php echo JFrame::getAppSetting('menu_text_hover_transform');?>;
               
                color:#<?php echo JFrame::getAppSetting('menu_hover_font_color');?>;
                font-family:'<?php echo JFrame::getAppSetting('menufont');?>';
                font-size:'<?php echo JFrame::getAppSetting('menufontsize');?>px';
                
                font-weight:<?php echo JFrame::getAppSetting('menu_hover_font_bold')==1 ? 'bold' : 'none';?>;
                font-style: <?php echo JFrame::getAppSetting('menu_hover_font_italic')==1 ? 'italic' : 'none';?>;
                text-decoration: <?php echo JFrame::getAppSetting('menu_hover_font_underline')==1 ? 'underline' : 'none';?>;
                
                <?php if (JFrame::getAppSetting('need_menu_hover_backgroundcolor')==1) {?>
                background: #<?php echo JFrame::getAppSetting('menu_hover_backgroundcolor'); ?>;
                <?php } ?>
            }   
                                                     
       
         
        </style>
        <script>
           // $(function() {$( "#datepicker" ).datepicker({showOn: 'button',buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png',width:20,height:20,buttonImageOnly: true,changeMonth: true,changeYear: true,showAnim: 'slideDown',duration: 'fast',dateFormat: 'dd-mm-yy'}); });
        </script>
        
       
  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  </style>
   
   
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>


  <style>
  .product-slider { padding: 45px; }

.product-slider #carousel { border: 0px solid #1089c0; margin: 0; }

.product-slider #thumbcarousel { margin: 12px 0 0; padding: 0 45px; }

.product-slider #thumbcarousel .item { text-align: center; }

.product-slider #thumbcarousel .item .thumb { border: 4px solid #cecece; width: 20%; margin: 0 2%; display: inline-block; vertical-align: middle; cursor: pointer; max-width: 98px; }

.product-slider #thumbcarousel .item .thumb:hover { border-color: #1089c0; }

.product-slider .item img { width: 100%; height: auto; }

.carousel-control { color: #0284b8; text-align: center; text-shadow: none; font-size: 30px; width: 30px; height: 30px; line-height: 20px; top: 23%; }

.carousel-control:hover, .carousel-control:focus, .carousel-control:active { color: #333; }

.carousel-caption, .carousel-control .fa { font: normal normal normal 30px/26px FontAwesome; }
.carousel-control { background-color: rgba(0, 0, 0, 0); bottom: auto; font-size: 20px; left: 0; position: absolute; top: 30%; width: auto; }

.carousel-control.right, .carousel-control.left { background-color: rgba(0, 0, 0, 0); background-image: none; }

/* Red */
.btn-danger-outline {
  border-color: #d43f3a;;
  color: red ;
  background:#fff;
}

.btn-danger-outline:hover {
  background: #d43f3a;;
  color: white;
}

.mobilemenu {
    display: block;
}

@media all and (max-width: 768px){
.mobilemenu {
    display: none;
}
}
</style>

    </head> 
    <?php if (strlen(trim(JFrame::getAppSetting('backgroundimage')))==0) {?>
        <body style="background-color:#<?php echo JFrame::getAppSetting('backgroundcolor');?>;margin:0px;">
    <?php } else { ?> 
        <body style="background:url('<?php echo BaseUrl;?><?php echo $config['thumb'].JFrame::getAppSetting('backgroundimage');?>') <?php echo JFrame::getAppSetting('sitebgposition');?> ;background-color:#<?php echo JFrame::getAppSetting('backgroundcolor');?>;margin:0px;">
    <?php } ?>   
                         
          
<div class="container" style="max-width:1080px" >
    <?php if (JFrame::getAppSetting("showheader")==1) { ?> 
    <div class="row">
        <div class="col-sm-6">
            <a href="<?php echo JFrame::getAppSetting('siteurl');?>/index.php">
                <img src='<?php echo BaseUrl;?>/<?php echo $config['thumb'].JFrame::getAppSetting('logo');?>' style="height:70px;" alt="" >
            </a>
        </div>
        <div class="col-sm-6 mobilemenu" style="text-align:right;">
            <a href="<?php echo JFrame::getAppSetting('siteurl');?>/login" class="btn btn-danger" style="margin-top: 12px;padding-bottom: 7px;">Login</a>&nbsp;
            <a href="<?php echo JFrame::getAppSetting('siteurl');?>/register" class="btn btn-success" style="margin-top: 12px;padding-bottom: 7px;">Register Now</a> 
        </div>
    </div>
    <?php } ?>           
    <div class="row">
       
       <nav class="navbar navbar-expand-lg navbar-light bg-light subMenu" style="width:100%;padding:0px;background-color:#<?php echo JFrame::getAppSetting('menubgcolor');?> !important;">
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
    <div style="font-size:12px" class="navbar-toggler subMenu"   style="float: right;">
        <span style="cursor: pointer" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon" style="color:#fff !important"></span></span>
        <a href="login" class="btn btn-danger" style="margin-left:10px;padding:2px 10px;font-size:12px;">Login</a>
        <a href="register" class="btn btn-success"  style="margin-left:10px;padding:2px 10px;font-size:12px;" >Register</a>    
    </div>
    
    
  <div class="collapse navbar-collapse subMenu" id="navbarNav">
    <ul class="navbar-nav subMenu">
      <li class="nav-item">
        <a class="sub_Menu <?php echo $_SERVER['REQUEST_URI']=='/' ? 'sub_Menu_active' : '';?>" style="width: 100%" href='<?php echo JFrame::getAppSetting('siteurl');?>'>Home</a>
      </li>
      <?php foreach(MenuItems::getHeaderMenuItems() as $m) { ?>
                    <?php 
                        $target  = ($m['target']>0) ? " target='_blank' " : "";
                        
                        switch($m['linkedto']) {
                            
                            case 'frmphotos'  :  $pageurl = JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$m['pageid'];
                                                 break;
                            case 'exturl'     :  $pageurl = "http://".$m['customurl'];
                                                 break;
                            case 'frmpage'    :  
                                                //$pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                $pageurl = $_SITEPATH."/".$m['pagefilename'].".html";
                                                $pageurl = $_SITEPATH.$m['pagefilename'];
                                                break;
                                                
                            case 'frmevent'   :  $pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                 break;
                            case 'frmnews'    :  $pageurl = JFrame::getAppSetting('siteurl')."/index.php?page=".$m['pageid'];
                                                 break;
                            case 'frmdownload':  $pageurl = JFrame::getAppSetting('siteurl')."/downloads.php?dalbum=".$m['pageid'];
                                                 break;
                            case 'frmmusic'   :  $pageurl = JFrame::getAppSetting('siteurl')."/musics.php?album=".$m['pageid'];
                                                 break; 
                            case 'frmvideo'   :  $pageurl="videos.php";
                                                //$pageurl = JFrame::getAppSetting('siteurl')."/videos.php?viewvid=".$m['pageid'];
                                                 break;  
                            case 'frmgrp'     :  $pageurl = $m['customurl'];
                                                 break;
                        }
                        ?>
                         <li class="nav-item">
        <a class="sub_Menu  <?php echo $_SERVER['REQUEST_URI']=="/".$m['pagefilename'] ? 'sub_Menu_active' : '';?>" style="width: 100%"  href='<?php echo $pageurl;?>' <?php echo $target; ?> ><?php echo $m['menuname'];?></a>
      </li>
                        
                    <?php } ?>
       
    </ul>
  </div>
</nav>
             
       
    </div>
</div>
<div class="container" style="background:#fff;max-width:1080px">

                                                            
 

        
  