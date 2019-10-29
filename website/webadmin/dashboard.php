


<?php 
      include_once("../config.php");
      
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
<script src="../assets/js/jquery-1.7.2.js"></script>
<script src="../assets/js/json2.js"></script>
<script src="../assets/js/jquery.collapse.js"></script>
<script src="../assets/js/jquery.collapse_storage.js"></script>
<script src="../assets/js/jquery.collapse_cookie_storage.js"></script>
<link rel="stylesheet" href="../assets/css/demo.css">
<style>
.leftMenu {color:#444444;text-decoration: none;}
.leftMenu:hover {color:#000000;text-decoration: underline;}
</style>

<body style="margin:0px;">

<table cellpadding="5" cellspacing="0" style="font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%">
    <tr>
        <td colspan="2" style="text-align:right;background:#f1f1f1;font-weight:bold;padding:0px;border-bottom:1px solid #ccc;">Administration Area V.14.0001
           <table>
            <tr>
               <td style="width:1130px;">
                    <div style="text-align:left"> 
                     <img src='../assets/cms/<?php echo JFrame::getAppSetting('logo');?>' style="height:80px;">
                    </div>
               </td>
               <td>
                    <div style="text-transform: uppercase;margin-top:5px;font-weight:normal;font-size:12px;">
                    [ <?php echo $_SESSION['USER']['personname'];?> ] [ <a style="text-decoration:none;color:#222;" href="?logout=true">Logout</a> ]
                    </div>
                    <div>
                        <a href="changepwd.php" target="rpanel">Change Password</a>
                    </div>
               </td>
            </tr>
           </table>            
        </td> 
    </tr>
    <tr>
        <td style="vertical-align:top;width:200px;background:#f9f9f9;border-right:1px solid #ccc;padding:0px !important">
             <div class="content" style="padding-left:30px;line-height:20px;margin-top:5px;margin-bottom:5px;">
                <a class="leftMenu" href="../graph.php" target="rpanel">Home</a> <br>
                
          </div>
         <div id="css3-animated-example">
          
        <h3>Pages</h3>
        
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;">
            <a class="leftMenu" href="pages/addnewpage.php" target="rpanel">Add New Page</a> <br>
            <a class="leftMenu" href="pages/viewpages.php" target="rpanel">Manage Pages</a> 
          </div>
        </div>
        
        <h3>Menu</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="menu/addmenuitem.php" target="rpanel">Add Menu Page</a> <br>
                <a class="leftMenu" href="menu/editmenuitem.php" target="rpanel">Manage Menu Pages</a> 
          </div>
        </div>
        
       <h3>News</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="news/addnewnews.php" target="rpanel">Add New News</a> <br>
                <a class="leftMenu" href="news/viewnews_s.php" target="rpanel">Manage News</a> 
          </div>
        </div>
        
        <h3>Events</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="events/addnewevents.php" target="rpanel">Add New Events</a> <br>
                <a class="leftMenu" href="events/viewevents.php" target="rpanel">Manage Events</a> 
          </div>
        </div>
        
        <h3>Slider</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="slider/addslider.php" target="rpanel">Add Slider</a> <br>
                <a class="leftMenu" href="slider/viewslider.php" target="rpanel">Manage Slider</a> 
          </div>
        </div>
        
       <h3>Photo Gallery</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="photogallery/addphotos.php" target="rpanel">Add Photos</a> <br>
                <a class="leftMenu" href="photogallery/managephotos.php" target="rpanel">Manage Photos</a> <br>
                <a class="leftMenu" href="photogallery/addgroups.php" target="rpanel">Add Groups</a> <br>
                <a class="leftMenu" href="photogallery/viewgroups.php" target="rpanel">Manage Groups</a> 
          </div>
        </div>
        
       <h3>Success Stories</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="successstories/addstories.php" target="rpanel">Add Success Stories</a><br>
                <a class="leftMenu" href="successstories/viewstories.php" target="rpanel">Manage Success Stories</a> 
          </div>
        </div>
        
       <h3>Testimonials</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="testimonials/addtestimonials.php" target="rpanel">Add Testimonials</a> <br>
                <a class="leftMenu" href="testimonials/viewtestimonials.php" target="rpanel">Manage Testimonials</a>
          </div>
        </div>
        
      <h3>Site Settings</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="sitesettings/editsitesettings.php" target="rpanel">Edit SiteSettings</a> 
          </div>
        </div>
        
        <h3>Search Engine Option(SEO)</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="seo/seosettings.php" target="rpanel">SEO</a><br> 
                <a class="leftMenu" href="seo/sitemap.php" target="rpanel">Site Map</a> 
          </div>
        </div>
        
        <h3>Musics</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="musics/addmusics.php" target="rpanel">Add Musics</a> <br>
                <a class="leftMenu" href="musics/managemusics.php" target="rpanel">Manage Musics</a> <br>
                <a class="leftMenu" href="musics/addalbum.php" target="rpanel">Add Albums</a> <br>
                <a class="leftMenu" href="musics/viewalbum.php" target="rpanel">Manage Albums</a>  
          </div>
        </div>
        
        <h3>Downloads</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="downloads/adddownloads.php" target="rpanel">Add Downloads</a> <br>
                <a class="leftMenu" href="downloads/managedownloads.php" target="rpanel">Manage Downloads</a> <br>
                <a class="leftMenu" href="downloads/daddalbum.php" target="rpanel">Add Albums</a> <br>
                <a class="leftMenu" href="downloads/viewdalbum.php" target="rpanel">Manage Albums</a>  
          </div>
        </div>
     <h3>Videos</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="videos/addvideos.php" target="rpanel">Add Videos</a> <br>
                <a class="leftMenu" href="videos/viewvideos.php" target="rpanel">Manage Videos</a> 
          </div>
        </div>
        
     <h3>FAQ</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="faq/addfaq.php" target="rpanel">Add Faq</a> <br>
                <a class="leftMenu" href="faq/viewfaq.php" target="rpanel">Manage Faq</a> 
          </div>
        </div>
        
     <h3>Subscribers</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
              <a class="leftMenu" href="subscribers/addsubscribers.php" target="rpanel">Add Subscribers</a> <br>
              <a class="leftMenu" href="subscribers/managesubscribers.php" target="rpanel">Manage Subscribers</a>  
          </div>
        </div>
        
     <h3>Product</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="product/addproducts.php" target="rpanel">Add Product</a> <br>
                <a class="leftMenu" href="product/manageproducts.php" target="rpanel">Manage Product</a> <br>
                <a class="leftMenu" href="product/addsubproducts.php" target="rpanel">Add ProductSubCategory</a> <br>
                <a class="leftMenu" href="product/managesubproducts.php" target="rpanel">Manage ProductSubCategory</a> <br>
                <a class="leftMenu" href="product/addmainproducts.php" target="rpanel">Add ProductMainCategory</a> <br>
                <a class="leftMenu" href="product/managemainproducts.php" target="rpanel">Manage ProductMainCategory</a>  
          </div>
        </div>
        
     <h3>Contact Us</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
               <a class="leftMenu" href="contactus/addcontact.php" target="rpanel">Add Contact</a> <br>
               <a class="leftMenu" href="contactus/viewcontact.php" target="rpanel">Manage Contact</a>
          </div>
        </div>
        
    <h3>Customize</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
                <a class="leftMenu" href="customize/addcustomize.php" target="rpanel">Add Customize</a> <br>
                <a class="leftMenu" href="customize/managecustomize.php" target="rpanel">Manage Customize</a> 
          </div>
        </div> 
        
    <h3>User Manage</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
              <a class="leftMenu" href="usermanage/adduser.php" target="rpanel">Add Users</a> <br>
              <a class="leftMenu" href="usermanage/viewuser.php" target="rpanel">Manage Users</a>
          </div>
        </div>
    <h3>Readings</h3>
        <div>
          <div class="content" style="padding-left:20px;line-height:20px;margin-top:5px">
              <a class="leftMenu" href="readings/addreadings.php" target="rpanel">Add Readings</a></br>
              <a class="leftMenu" href="readings/viewreadings.php" target="rpanel">Manage Readings</a> 
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
             <iframe src="../graph.php" name="rpanel" style="height:800px;width:100%;border:none;"></iframe>
        </td>
    </tr>
</table>

</body>
