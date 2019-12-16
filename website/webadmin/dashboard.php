<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
<?php 
      //include_once("../config.php");
       
      file_get_contents("http://".$_SERVER['HTTP_HOST']."/jcron.php");
      
      if (isset($_REQUEST['logout'])) {
        unset($_SESSION); 
        session_destroy();
        $_SESSION=array();
        sleep(2);
        echo "<script>location.href='./';</script>";
    }
      if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }
    

?>
<head>
    <script src="<?php echo BaseUrl;?>assets/js/jquery-1.7.2.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/json2.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/jquery.collapse.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/jquery.collapse_storage.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/jquery.collapse_cookie_storage.js"></script>
    <link rel="stylesheet" href="<?php echo BaseUrl;?>assets/css/demo.css">
    <style>
        .leftMenu {color:#555;text-decoration: none;font-size:11px;font-family:arial}
        .leftMenu:hover {color:#222;text-decoration: underline;font-size:11px;font-family:arial;font-weight:bold;}
    </style>
   <!-- <base href="<?php echo BaseUrl; ?>/">-->
</head>

<body style="margin:0px;">

    <table cellpadding="5" cellspacing="0" style="font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%">
        <tr>
            <td colspan="2" style="border-bottom:1px solid #b3d7e2;background-image:-webkit-linear-gradient(bottom, #e1eefe 14%, #cfe1f7 57%);">
                <table cellpadding="0" cellspacing="0" style="width:100%">
                    <tr>
                        <td>
                          <!--  <div style="text-align:left"> 
                                <img src='<?php echo BaseUrl;?>assets/<?php echo $config['thumb'].JFrame::getAppSetting('logo');?>' style="height:50px">
                            </div>-->
                        </td>
                        <td style="width:300px;vertical-align:top;">
                            <div style="font-weight:bold;text-align:right;font-size:15px;font-family:arial;color:#888;">WebAdmin</div>
                            <div style="text-transform: uppercase;margin-top:2px;font-weight:normal;font-size:11px;text-align:right;color:#888">
                            Version: 1.0.17.06
                            </div>
                            <div style="margin-top:5px;font-weight:normal;font-size:13px;text-align:right;">
                            
                              <!--  [ <?php echo $_SESSION['USER']['personname'];?> ] [ --><a style="text-decoration:none;color:#555;" href="?logout=true">Logout</a> 
                            </div>
                            
                        </td>
                    </tr>
                </table>            
            </td> 
        </tr>
        
        <tr>
            <td style="vertical-align:top;width:200px;background:#f2f7ff;border-right:1px solid #ccc;padding:0px !important">
            <div class="content" style="padding-left:30px;line-height:20px;margin-top:5px;margin-bottom:5px;">
                <a class="leftMenu" href="graph.php" target="rpanel">Home</a> <br>
                
          </div>
         <div id="css3-animated-example">
          
        <h3>Pages</h3>
               
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;">
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="pages/addnewpage.php" target="rpanel">Add New Page</a> <br>
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="pages/viewpages.php" target="rpanel">Manage Pages</a> 
          </div>
        </div>
        
        <h3>Menu</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="menu/addmenuitem.php" target="rpanel">Add Menu</a> <br>
              
              <b style="font-size:11px;color:#222">Header</b><br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="menu/editmenuitem.php" target="rpanel">Manage Menus</a><br> 
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="menu/headermenusettings.php" target="rpanel">Header Menu Settings</a><br> 
              
              <b style="font-size:11px;color:#222">Footer</b><br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="menu/editmenuitem.php" target="rpanel">Manage Menus</a><br> 
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="menu/footermenusettings.php" target="rpanel">Footer Menu Settings</a> 
          </div>
        </div>
        
       <h3>News</h3>
        <div>           <div style="text-transform:;"
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="news/addnewnews.php" target="rpanel">Add New News</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="news/viewnews_s.php" target="rpanel">Manage News</a> 
          </div>
        </div>
        
        <h3>Events</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="events/addnewevents.php" target="rpanel">Add New Events</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="events/viewevents.php" target="rpanel">Manage Events</a> 
          </div>
        </div>
        
        <h3>Slider</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="slider/addslider.php" target="rpanel">Add Slider</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="slider/viewslider.php" target="rpanel">Manage Slider</a><br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="slider/settings.php" target="rpanel">Slider Settings</a>  
          </div>
        </div>
        
       <h3>Photo Gallery</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="photogallery/addphotos.php" target="rpanel">Add Photos</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="photogallery/managephotos.php" target="rpanel">Manage Photos</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="photogallery/addgroups.php" target="rpanel">Add Groups</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="photogallery/viewgroups.php" target="rpanel">Manage Groups</a> 
          </div>
        </div>
        
       <h3>Success Stories</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="successstories/addstories.php" target="rpanel">Add Success Stories</a><br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="successstories/viewstories.php" target="rpanel">Manage Success Stories</a> 
          </div>
        </div>
        
       <h3>Testimonials</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="testimonials/addtestimonials.php" target="rpanel">Add Testimonials</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="testimonials/viewtestimonials.php" target="rpanel">Manage Testimonials</a>
          </div>
        </div>
        
      <h3>Site Settings</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="sitesettings/headersettings.php" target="rpanel">Header</a><br> 
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="sitesettings/editsitesettings.php" target="rpanel">Edit SiteSettings</a> 
          </div>
        </div>
        
        <h3>Search Engine Option(SEO)</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="seo/seosettings.php" target="rpanel">SEO</a><br> 
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="seo/sitemap.php" target="rpanel">Site Map</a> 
          </div>
        </div>
      <!--  
        <h3>Musics</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="musics/addmusics.php" target="rpanel">Add Musics</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="musics/managemusics.php" target="rpanel">Manage Musics</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="musics/addalbum.php" target="rpanel">Add Albums</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="musics/viewalbum.php" target="rpanel">Manage Albums</a>  
          </div>
        </div>
        
        <h3>Downloads</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="downloads/adddownloads.php" target="rpanel">Add Downloads</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="downloads/managedownloads.php" target="rpanel">Manage Downloads</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="downloads/daddalbum.php" target="rpanel">Add Albums</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="downloads/viewdalbum.php" target="rpanel">Manage Albums</a>  
          </div>
        </div>
        -->
     <h3>Videos</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="videos/addvideos.php" target="rpanel">Add Videos</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="videos/viewvideos.php" target="rpanel">Manage Videos</a><Br> 
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="videos/settings.php" target="rpanel">Settings</a> 
          </div>
        </div>
        
     <h3>FAQ</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="faq/addfaq.php" target="rpanel">Add Faq</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="faq/viewfaq.php" target="rpanel">Manage Faq</a> 
          </div>
        </div>
     <!--   
     <h3>Subscribers</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="subscribers/addsubscribers.php" target="rpanel">Add Subscribers</a> <br>
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="subscribers/managesubscribers.php" target="rpanel">Manage Subscribers</a>  
          </div>
        </div>
         -->
                
     <!--<h3>Listing</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/addcategory.php" target="rpanel">Add Category</a> <br>
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/managecategory.php" target="rpanel">Manage Categories</a><Br>  
            <br /> 
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/addfeature.php" target="rpanel">Add Feature</a> <br>
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/managefeatures.php" target="rpanel">Manage Features</a><Br>  
            <br /> 
            
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/additem.php" target="rpanel">Add Item</a> <br>
            <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="listing/manageitems.php" target="rpanel">Manage Items</a><br>
        </div>
        </div>
        
     <h3>Product</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/addproducts.php" target="rpanel">Add Product</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/manageproducts.php" target="rpanel">Manage Product</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/addsubproducts.php" target="rpanel">Add ProductSubCategory</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/managesubproducts.php" target="rpanel">Manage ProductSubCategory</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/addmainproducts.php" target="rpanel">Add ProductMainCategory</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="product/managemainproducts.php" target="rpanel">Manage ProductMainCategory</a>  
          </div>
        </div>
        -->
     <h3>Contact Us</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
               <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="contactus/addcontact.php" target="rpanel">Add Contact</a> <br>
               <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="contactus/viewcontact.php" target="rpanel">Manage Contact</a>
          </div>
        </div>
   
      <h3>Enquiry</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="enquiry/enquires.php" target="rpanel">Enquiies</a> <br>
                
          </div>
        </div> 
             
    <h3>Customize</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="customize/addcustomize.php" target="rpanel">Add Customize</a> <br>
                <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="customize/managecustomize.php" target="rpanel">Manage Customize</a> 
          </div>
        </div> 
        
   <!-- <h3>User Manage</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="usermanage/adduser.php" target="rpanel">Add Users</a> <br>
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="usermanage/viewuser.php" target="rpanel">Manage Users</a>
          </div>
        </div>
    <h3>Readings</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="readings/addreadings.php" target="rpanel">Add Readings</a></br>
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="readings/viewreadings.php" target="rpanel">Manage Readings</a> 
          </div>
        </div> 
        -->  <h3>Profile</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:15px;margin-top:5px">
              <img src="<?php echo BaseUrl;?>assets/images/arrow_rightq.gif" align="absmiddle">&nbsp;<a class="leftMenu" href="changepwd.php" target="rpanel">Change Password</a></br>
          </div>
        </div>
                               
</div>
    <script>
        new jQueryCollapse($("#css3-animated-example"), {
          show: function() {
            this.slideDown(150);
          },
          hide: function() {
            this.slideUp(150);
          },
        });
  </script>
   
        </td>
        <td style="vertical-align:top;padding:0px">
             <iframe src="graph.php" name="rpanel" style="height:1000px;width:100%;border:none;"></iframe>
        </td>
    </tr>
</table>

</body>
