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
            <script src="<?php echo SiteUrl?>assets/vendors/jquery-3.1.1.min.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
            <link href='<?php echo SiteUrl?>assets/vendors/bootstrap/css/bootstrap.min.css?rnd=<?php echo rand(10,1000);?>' rel='stylesheet' type='text/css'>
            <!--
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>    
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>   
            --> 
            <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js?rnd=<?php echo rand(10,1000);?>"></script>
            <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css?rnd=<?php echo rand(10,1000);?>">
            <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>   
            <script src="<?php echo SiteUrl?>assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
            <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
            <style>
                .Activedot {height:10px;width:10px;background-color:#20e512;border-radius:50%;display:inline-block;}
                .Deactivedot {height:10px;width:10px;background-color:#888;border-radius:50%;display:inline-block;}
                #star{color:red;}
                .errorstring {font-size:10px;color:red}
                div.scrollmenu {background:#fff;border-bottom:2px solid #e5e5e5;white-space: nowrap;padding-left:25px;padding-top:5px;}
                div.scrollmenu a {display: inline-block;color: #333;text-align: center;padding: 10px 10px;font-family:'Roboto';text-decoration: none;border-bottom:3px solid #fff;margin-right:15px;}
                div.scrollmenu a:hover {border-bottom:3px solid #fff;color:#ff007b;}
                .linkactive{border-bottom:3px solid #ff007b !important;color:#ff007b  !important;}
                .shadow {-webkit-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);-moz-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
               .bshadow {
        -webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        -moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
    }
    .box-shaddow {
        box-shadow: 0 0 5px #e9e9e9 !important;
        -moz-box-shadow: 0 0 5px #e9e9e9 !important;                         
        -webkit-box-shadow: 0 0 24px #e9e9e9 !important;
    }
            </style>
        </head>
    <body>
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="margin-bottom:0px !important;border-radius:0px !important">
            <?php if (UserRole=="Member") { ?> 
                     <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center ">
                        <img src="<?php echo $config->logoPath?>" alt="logo" style="height:50px;height:60px;margin-top: 2px;"/>
                         <!--<a class="navbar-brand brand-logo" href="../Dashboard">
                         <img src="<?php //echo SiteUrl?>images/logo.svg" alt="logo" />
                         </a>
                         <a class="navbar-brand brand-logo-mini" href="../Dashboard">
                         <img src="<?php //echo SiteUrl?>images/logo-mini.svg" alt="logo" />
                         </a> -->
                     </div>
                     <div class="navbar-menu-wrapper d-flex align-items-center  bshadow">        
                        <ul class="navbar-nav navbar-nav-right">
                           <!-- <li class="nav-item dropdown">
                                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-file-document-box"></i>
                                    <span class="count">0</span>
                                </a>
                                <?php  $response = $webservice->GetMyEmails(); ?>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                    <?php if (sizeof($response['data'])>0) {  ?>
                                    <div class="dropdown-item">
                                        <p class="mb-0 font-weight-normal float-left">You have 7 unread mails</p>
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
              </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium text-dark" style="margin-bottom: -7px;">You don't have mail at this time
                  </h6>
                    </div>
                </a>
                <?php }?>
        </div>
</li> -->
      <!--    <li class="nav-item dropdown">
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
              </a> 
            < <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark" style="margin-bottom: -7px;">You don't have notifications
                  </h6>
                 </div>
              </a> 
            </div>
          </li>  -->
                <li class="nav-item dropdown d-none d-xl-inline-block">
                <span class="profile-text"><?php echo "<b>";echo $_Member['MemberName'] ; echo "</b>";?></span><br> 
              </li>
             <li class="nav-item dropdown d-none d-xl-inline-block">
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"><img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="<?php echo GetUrl("MyAccounts/MyWallet");?>" class="dropdown-item">My Accounts</a>
              <a href="<?php echo GetUrl("MySettings/MyMemberInfo");?>" class="dropdown-item">My Settings</a>
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=../index" class="dropdown-item">Log Out</a>
            </div>
          </li>
    </ul>
        
      </div>
      <?php } ?>
   <?php if (UserRole=="Franchisee") { ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
     <img src="<?php echo $config->logoPath?>" alt="logo" style="height:50px;height:60px;margin-top: 2px;"/>
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
                <?php echo ($_Franchisee['IsAdmin']==1) ? "<small>Franchisee Admin</small>"  : "Admin"; ?></span>
             </li> 
             <li class="nav-item dropdown d-none d-xl-inline-block">
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"><img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="<?php echo GetUrl("MyAccounts/MyWallet");?>" class="dropdown-item">My Accounts</a>
              <a href="<?php echo GetUrl("MySettings/FranchiseeInfo");?>" class="dropdown-item">My Settings</a>
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=../index" class="dropdown-item">Log Out</a>
            </div>
          </li>
          </ul>
    </div>
      
      <?php } ?>
      <?php if (UserRole=="Admin") { ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
     <img src="<?php echo $config->logoPath?>" alt="logo" style="height:50px;height:60px;margin-top: 2px;"/>
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
                    <?php echo ($_Admin['IsAdmin']==0) ? "<small>Administrator</small>"  : "Admin Staff"; ?>
                </span>                                                                  
             </li>
              <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"><img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image"></a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <a href="<?php echo GetUrl("ChangePassword");?>" class="dropdown-item" style="padding-top: 15px;">Change Password</a>
                        <a href="<?php echo GetUrl("Settings/Setting");?>" class="dropdown-item">Settings</a>
                        <a href="<?php echo SiteUrl;?>?action=logout&redirect=AdminLogin" class="dropdown-item">Log Out</a>
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
        
        <?php 
            function DisplayManageProfileShortInfo($ProfileInformation) {
              
                $Profile = $ProfileInformation['ProfileInfo'];
        ?>
            <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #555;background:#fff;padding:6px">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $ProfileInformation['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">                                                                                     
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:64px;"></div>
                                        <div style="float:right;font-size: 12px;">
                                        <?php  echo "Created On: ".PutDateTime($Profile['CreatedOn']); ?><br>
                                        <?php 
                                        if ($ProfileInformation['LastSeen']!="0") { 
                                            echo "Last seen: ".PutDateTime($ProfileInformation['LastSeen']); 
                                        }
                                        ?>
                                        
                                        </div> 
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="<?php echo GetUrl("MyProfiles/View/".$Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                                <?php if($Profile['IsApproved']==1 || $Profile['RequestToVerify']==1){ ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php }else{  ?>
                                        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$Profile['ProfileCode'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                        <?php  }    ?>
                            </div>
                        </div>
                  <?php
              }
            ?>
            
            <?php 
            function DisplayManageProfileShortInfoforDashboard($ProfileInformation) {
              
                $Profile = $ProfileInformation['ProfileInfo'];
        ?>
            <div class="form-group row">
                            <div class="col-sm-3" style="text-align:center">
                               <img src="<?php echo $Profile['ProfileThumb'];?>" style="height: 159px;margin-bottom: -18px;">
                            </div>
                            <div class="col-sm-9">
                                <div style="border-bottom:1px solid #d7d7d7;width:100%;padding-bottom: 10px;font-size: 21px;color: #514444cc;text-align:left"> 
                                    <?php echo $Profile['ProfileName'];?>
                                </div>
                                <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                    <div><?php echo $Profile['Height'];?></div>
                                    <div><?php echo $Profile['Religion'];?></div>
                                    <div><?php echo $Profile['Caste'];?></div>
                                </div>   
                                <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                    <div><?php echo $Profile['MaritalStatus'];?></div>
                                    <div><?php echo $Profile['City'];?></div>
                                    <div><?php echo $Profile['Occupation'];?></div>
                                </div>
                            </div>
                        </div>
                        <div style="float:right;line-height: 1px;">
                                <?php if($Profile['IsApproved']==1 || $Profile['RequestToVerify']==1){ ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php }else{  ?>
                                        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$Profile['ProfileCode'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                        <?php  }    ?>
                            </div>
                  <?php
              }
            ?>
            
            <?php function DisplayProfileShortInfo($Profile) {  ?>
                      <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center">
                                    <img src="<?php echo SiteUrl.$Profile['profileImage'];?>" style="height: 159px;margin-bottom: -18px;">
                                </div>
                                 <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:100%;height: 80px;font-size: 21px;color: #514444cc;">                                                                                     
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<div style="line-height: 25px;color: #867c7c;font-size:14px">Profile Code:&nbsp;&nbsp; <?php echo $Profile['ProfileCode'];?></div><div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:40px;"></div><div style="float:right;font-size: 12px;">Published:&nbsp;&nbsp;<?php echo putDateTime($Profile['IsApprovedOn']);?><br>Download:&nbsp;&nbsp;<?php echo putDateTime($Profile['DownloadOn']);?><br>Lastseen:</div> 
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="<?php echo GetUrl("MyProfiles/View/".$Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                             <a href="<?php echo GetUrl("MyContacts/ViewProfileDetails/".$Profile['ProfileCode'].".htm ");?>">view</a>
                            </div>
                        </div>
                  <?php
              }
            ?>
         
          <?php function DisplayProfileShortInfoBrowse($Profile) {  ?>
          
          
                      <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center">
                                    <img src="<?php echo SiteUrl.$Profile['profileImage'];?>" style="height: 159px;margin-bottom: -18px;">
                                </div>
                                <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:100%;height: 80px;font-size: 21px;color: #514444cc;">                                                                                     
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<div style="line-height: 25px;color: #867c7c;font-size:14px">Profile Code:&nbsp;&nbsp; <?php echo $Profile['ProfileCode'];?></div><div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:40px;"></div><div style="float:right;font-size: 12px;">Published:&nbsp;&nbsp;<?php echo putDateTime($Profile['IsApprovedOn']);?><br>Lastseen:</div> 
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="<?php echo GetUrl("MyProfiles/View/".$Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                    
                                    if ($Profile['IsDownloaded']==0) {
                                        ?>
                                        <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                        <?php
                                    } else {
                                        ?>
                                        Alredy Downloaded
                                        <?php
                                    }
                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewSearchProfile/".$Profile['ProfileCode'].".htm ");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?> 
            <?php function DisplayMyContactsProfileShortInfoBrowse($Profile) {  ?>
          
          
                      <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center">
                                    <img src="<?php echo SiteUrl.$Profile['profileImage'];?>" style="height: 159px;margin-bottom: -18px;">
                                </div>
                                <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:100%;height: 80px;font-size: 21px;color: #514444cc;">                                                                                     
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<div style="line-height: 25px;color: #867c7c;font-size:14px">Profile Code:&nbsp;&nbsp; <?php echo $Profile['ProfileCode'];?></div><div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:40px;"></div><div style="float:right;font-size: 12px;">Published:&nbsp;&nbsp;<?php echo putDateTime($Profile['IsApprovedOn']);?><br>Lastseen:</div> 
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="<?php echo GetUrl("MyProfiles/View/".$Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                               <a href="<?php echo GetUrl("MyContacts/MyDownloaded/ViewProfileDetails/".$Profile['ProfileCode'].".htm ");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?>