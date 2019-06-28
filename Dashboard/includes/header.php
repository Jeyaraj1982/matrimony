<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Matrimony Software</title>
         
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css?rnd=<?php echo rand(10,1000);?>">
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/css/vendor.bundle.base.css?rnd=<?php echo rand(10,1000);?>">
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/css/vendor.bundle.addons.css?rnd=<?php echo rand(10,1000);?>">
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/css/style.css?rnd=<?php echo rand(10,1000);?>">
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/css/selectboxstyle.css?rnd=<?php echo rand(10,1000);?>">
            <link rel="shortcut icon" href="<?php echo SiteUrl?>assets/images/favicon.png" /> 
            <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/iconfonts/puse-icons-feather/feather.css?rnd=<?php echo rand(10,1000);?>">
            <script src="http://nahami.online/sl/Dashboard/assets/vendors/jquery-3.1.1.min.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
            <link href='http://nahami.online/sl/Dashboard/assets/vendors/bootstrap/css/bootstrap.min.css?rnd=<?php echo rand(10,1000);?>' rel='stylesheet' type='text/css'>
            
         <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>   --> 
  
  
           <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js?rnd=<?php echo rand(10,1000);?>"></script>
            <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css?rnd=<?php echo rand(10,1000);?>">
         <script src="http://malsup.github.io/jquery.blockUI.js"></script> 
          <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>   
            <style> 
                .Activedot {height:10px;width:10px;background-color:#20e512;border-radius:50%;display:inline-block;}
                .Deactivedot {height:10px;width:10px;background-color:#888;border-radius:50%;display:inline-block;}
                #star{color:red;}
            </style>
           <script src="http://nahami.online/sl/Dashboard/assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
            
            <style>
                .errorstring {font-size:10px;color:red}
                
            </style>
            <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<style>
div.scrollmenu {
  background:#fff;
  border-bottom:2px solid #e5e5e5;
  
  white-space: nowrap;
  padding-left:25px;
  padding-top:5px;
}

div.scrollmenu a {
  display: inline-block;
  color: #333;
  text-align: center;
  padding: 10px 10px;
  font-family:'Roboto';
  text-decoration: none;
   border-bottom:3px solid #fff;
   margin-right:15px;
}

div.scrollmenu a:hover {
 /* background-color: #777;*/
 border-bottom:3px solid #fff;
 color:#ff007b;
}

 .linkactive{
     border-bottom:3px solid #ff007b !important;
      color:#ff007b  !important;
 }
 
 .shadow {
   -webkit-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
-moz-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
}
</style>
 
        </head>
    <body>
    
    

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="margin-bottom:0px !important;border-radius:0px !important">
    <?php if (UserRole=="Member") { ?> 
     <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center ">
        <!--<a class="navbar-brand brand-logo" href="../Dashboard">
          <img src="<?php //echo SiteUrl?>images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../Dashboard">
          <img src="<?php //echo SiteUrl?>images/logo-mini.svg" alt="logo" />
        </a> -->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center  bshadow">        
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block <?php echo ($mainlink=="Search") ? ' linkactive1 ':'';?>" >
                <span class="profile-text">         
                    <a href="<?php echo SiteUrl?>Search/BasicSearch" class="msearch" style="color: white;font-size:15px">Search</a>
                  </span>
                 </li>
          <li class="nav-item dropdown">
    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
        <i class="mdi mdi-file-document-box"></i>
        <span class="count">0</span>
    </a>
                    <?php 
                         $response = $webservice->GetMyEmails();
                    ?>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
        <?php if (sizeof($response['data'])>0) {  ?>
            <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?php// echo SiteUrl?>assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-medium text-dark"><?php echo $response['data']['EmailSubject'];?>
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                    <p class="font-weight-light small-text">
                        The meeting is cancelled
                    </p>
                </div>
            </a>
            <?php } else{?>
                <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php //echo SiteUrl?>assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium text-dark" style="margin-bottom: -7px;">You don't have mail at this time
                  </h6>
                    </div>
                </a>
                <?php }?>
        </div>
</li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <!--<a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a> -->
             <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark" style="margin-bottom: -7px;">You don't have notifications
                  </h6>
                 </div>
              </a> 
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <span class="profile-text">         
              <?php echo "<b>";echo $_Member['MemberName'] ; echo "</b>";?></span><br> 
             </li>
             <li class="nav-item dropdown d-none d-xl-inline-block">
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <!--<a href="#" class="dropdown-item">
               Tools
              </a>-->
              <a href="<?php echo GetUrl("MySettings/MyMemberInfo");?>" class="dropdown-item">
              My Settings
              </a>
              
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=../index" class="dropdown-item">
                Log Out
              </a>
            </div>
          </li>
    </ul>
        
      </div>
      <?php } ?>
   <?php if (UserRole=="Franchisee") { ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <!--<a class="navbar-brand brand-logo" href="../Dashboard">
          <img src="<?php //echo SiteUrl?>images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../Dashboard">
          <img src="<?php //echo SiteUrl?>images/logo-mini.svg" alt="logo" />
        </a> -->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">        
        <ul class="navbar-nav navbar-nav-right">
          <!--<li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php //echo SiteUrl?>images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>-->
          <li class="nav-item dropdown d-none d-xl-inline-block">
          <span class="profile-text" style="line-height:10px;" >         
              <?php echo "Franchisee Name";?></span><br>
          <span class="profile-text" style="line-height:10px; ">   
              <?php echo "<b>";echo $logininfo[0]['FranchiseName'] ; echo "</b>";?></span><br> 
              <span class="profile-text" style="line-height:10px;">
               <?php if($_Franchisee['IsAdmin']==1){
                    echo "<small>"; echo "Franchisee Admin"; echo "</small>"  ;
               } else {
                   echo "Admin"; 
               }
             ?></span>
             </li> 
             <li class="nav-item dropdown d-none d-xl-inline-block"> 
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a href="<?php echo GetUrl("MySettings/ChangePassword");?>" class="dropdown-item">
                Change Password
              </a>
              <a class="dropdown-item">
                Settings
              </a>
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=FranchiseeLogin" class="dropdown-item">
                Log Out
              </a>
            </div>
          </li>
    </ul>
    </div>
      
      <?php } ?>
      <?php if (UserRole=="Admin") { ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <!--<a class="navbar-brand brand-logo" href="../Dashboard">
          <img src="<?php // echo SiteUrl?>images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../Dashboard">
          <img src="<?php // echo SiteUrl?>images/logo-mini.svg" alt="logo" />
        </a> -->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">        
        <ul class="navbar-nav navbar-nav-right">
         <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?php // echo SiteUrl?>images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>-->
          
          <li class="nav-item dropdown d-none d-xl-inline-block">
          <span class="profile-text" >
              <?php echo "<b>";echo $_Admin['AdminName'] ; echo "</b>";?></span><br> 
              <span class="profile-text" style="line-height:20px;" >
               <?php if($_Admin['IsAdmin']==0){
                    echo "<small>"; echo "Administrator"; echo "</small>"  ;
               } else {
                   echo "Admin Staff";
               }
             ?></span>                                                                  
             </li>
              <li class="nav-item dropdown d-none d-xl-inline-block">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
             <img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image">
             </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a href="<?php echo GetUrl("ChangePassword");?>" class="dropdown-item" style="padding-top: 15px;">
                Change Password
              </a>
              <a href="<?php echo GetUrl("Settings/Setting");?>" class="dropdown-item">
                Settings
              </a>
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=AdminLogin" class="dropdown-item">
                Log Out
              </a>
            </div>
          </li>
    </ul>
        
      </div>
      <?php } ?>
  </nav>
    <div class="container-fluid page-body-wrapper">
    <?php include_once("views/".UserRole."/LeftMenu.php"); ?>
    <div class="main-panel">
        <div class="content-wrapper">
