<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Matrimony Software</title>
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/css/selectboxstyle.css">
        <link rel="shortcut icon" href="<?php echo SiteUrl?>assets/images/favicon.png" /> 
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/iconfonts/puse-icons-feather/feather.css">
        <script src="<?php echo SiteUrl?>assets/vendors/jquery-3.1.1.min.js" type='text/javascript'></script>
        <link href='<?php echo SiteUrl?>assets/vendors/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="<?php echo SiteUrl?>assets/js/app.js" type='text/javascript'></script>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'> 
        <link href='<?php echo SiteUrl?>assets/simpletoast/simply-toast.css' rel='stylesheet' type='text/css'>
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
           .bshadow {-webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);-moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);}
           .box-shaddow {box-shadow: 0 0 5px #e9e9e9 !important;-moz-box-shadow: 0 0 5px #e9e9e9 !important;-webkit-box-shadow: 0 0 24px #e9e9e9 !important;}
           .profile_horizontal_row {box-shadow: 0 0 5px #e9e9e9 !important;-moz-box-shadow: 0 0 5px #e9e9e9 !important;-webkit-box-shadow: 0 0 24px #e9e9e9 !important;min-height: 200px;max-width:770px !important;background:white;padding:20px;border:1px solid transparent;cursor:poiner;}
           .profile_horizontal_row:hover {background:#f4fbfc;border:1px solid #e5e5e5}
           #slideshow .leftLst, #slideshow .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
           #slideshow .leftLst { left:0; }
           #slideshow .rightLst { right:0; }
           .successmessage {border:1px solid Green;color:green;padding:5px 10px;border-radius:5px;}
           #slideshow .leftLst.over, #slideshow .rightLst.over { pointer-events: none; background:#ccc; }
           .viewbutton:hover{background:#00c1ff;color: #83c25d;}
           .member_dashboard_widget_title {width:200px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:14px;padding-top:7px;font-weight:bold;color:#777}
           .member_dashboard_widget_container {overflow:hidden;height:325px;padding:10px !important;padding-left:5px !important;padding-right:9px !important;}
           .tblrow {background:#fff}
           .tblrow:hover {background:#f1f1f1}
           /*dashboard*/
           div, label,a,h1,h2,h3,h4,h5,h6 {font-family:'Roboto' !important;}
           #resCon_a001 {background:white;padding:10px;border-bottom: 1px solid #d5d5d5;cursor:pointer;}
           .resCon_a002 {float:left;width:143px;height: 235px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
           #resCon_a0021 {float:left;width:143px;height: 235px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
           #resCon_a001:hover {background:#f1f1f1;}
           .resCon_a002:hover {background:#f1f1f1;}
           #resCon_a0021:hover {background:#f1f1f1;}
           #verifybtn{background: #0eb1db;border:1px#32cbf3;box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
           #verifybtn:hover{background:#149dc9;}
           input:focus{border:1px solid #ccc;}
           #errormsg{text-align:center;color:red;padding-bottom:5px;padding-top:5px;}
           .resCon_a002 a:hover{color: #337ab7;}
           #resCon_a0021 a:hover{color: #337ab7;}
           #UpdatesDiv_:hover {background: #c3d1d2;}
           /*thumb image preview*/
           div.enlarge{width:100px;height:100px;margin:0px auto;}
           div.enlarge div {width:100px;height:100px;}
           div.enlarge img{background-color:#eae9d4;padding: 6px;-webkit-box-shadow: 0 0 6px rgba(132, 132, 132, .75);-moz-box-shadow: 0 0 6px rgba(132, 132, 132, .75);box-shadow: 0 0 6px rgba(132, 132, 132, .75);-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
           div.enlarge span{position:absolute;left: -9999px;background-color:#eae9d4;padding: 10px;font-family: 'Droid Sans', sans-serif;font-size:.9em;text-align: center;color: #495a62;z-index:100000;-webkit-box-shadow: 0 0 20px rgba(0,0,0, .75));-moz-box-shadow: 0 0 20px rgba(0,0,0, .75);box-shadow: 0 0 20px rgba(0,0,0, .75);-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;}
           div.enlarge div:hover{z-index: 50;cursor:pointer;}
           div.enlarge span img{padding:2px;background:#ccc;height:300px;}
           div.enlarge div:hover span{top: 0px; /*the distance from the bottom of the thumbnail to the top of the popup image*/left: 100px; /*distance from the left of the thumbnail to the left of the popup image*/}
           div.enlarge div:hover:nth-child(2) span{left: 0px;}
           div.enlarge div:hover:nth-child(3) span{left: 0px;}
           /**IE Hacks - see http://css3pie.com/ for more info on how to use CS3Pie and to download the latest version**/
           div.enlarge img, div.enlarge span{behavior: url(pie/PIE.htc);}  
           /* end of Thumb image */
           div, label,a,ul,li,p,h1,h2,h3,h4,h5,h6,span,i,b,u {font-family:'Roboto' !important;}
           .widget_title {font-family:'Roboto' !important;font-size: 22px;margin-top:0px;margin-bottom:10px;text-transform:none;}
           .widget_subtitle {font-family:'Roboto' !important;color:#888;font-weight: normal;margin-top: -5px;font-size: 13px;margin-bottom: 0px;}
           .widget_message {text-align:center;font-family:'Roboto';color:#666}
           .widget_message img {height:128px !important}
           .padding15 {padding:15px !important}
           .padding0 {padding:0px !important}
           .padding90 {padding:90px !important}
           .bgwhite {background:#fff !important}
           #server_message_error {color:red}
           #server_message_success {color:green}
        </style>
        <script>
            var AppUrl = "<?php echo AppUrl;?>";
          var MyFavoritedPage=0;
              function changeMemberStatus(txt) {
        $('#mem_current_status').html(txt);
    }
            
            
            function doPost(url,param) {
                $.post(url,param).done(function(data){ 
                      return data;
                }).fail(function(xhr, status, error) {
                    return xhr.responseText;
                });
            }
            
            var error_htmlText = '<div style="background:white;width:100%;padding:20px;height:100%;">'
                                        + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                        + '<h4 class="modal-title"></h4>  <br><br>'
                                        + '<p style="text-align:center"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">An error occured in the application and your request could not be processed.</h5>'
                                       '</div>';
        </script>
        </head>
    <body>
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="margin-bottom:0px !important;border-radius:0px !important">
            <?php if (UserRole=="Member") { ?> 
                     <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center " style="overflow:hidden">
                        <a class="navbar-brand brand-logo" href="<?php echo SiteUrl;?>" style="width:100%;height:100%;"><img src="<?php echo $config->logoPath?>" alt="logo" style="width:100%;height:100%;margin-top: 2px;"/></a>
                     </div>
                     <div class="navbar-menu-wrapper d-flex align-items-center  bshadow">        
                        <ul class="navbar-nav navbar-nav-right">
          <?php
                     $response = $webservice->getData("Member","GetLoginHistory");
               ?>
                <li class="nav-item dropdown d-none d-xl-inline-block" style="text-align: right;margin-right: 0px;">
                    <img src="<?php echo ImagePath;?>wallet.svg" style="width:40px;color:white"/><br /><span class="profile-text" style="line-height:18px;">Rs.<?php echo $response['data']['WalletBalance'];?></span> 
                </li>
                <li class="nav-item dropdown d-none d-xl-inline-block">
                     <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>" class="dropdown-item">Wallet Update</a>
              <a href="<?php echo GetUrl("MyAccounts/MyTransactions");?>" class="dropdown-item">Wallet Transaction</a>
            </div>
              </li>
              <li class="nav-item dropdown d-none d-xl-inline-block" style="text-align: right;">
                <span class="profile-text" style="line-height:18px;"><?php echo "<b>".$_Member['MemberName']."</b>";?><br><span style="color:#f9f9f9f"><?php echo $_Member['MemberCode'] ; ?></span><br>
                    <?Php if($response['data']['IsDisplayLastLogin']['ParamA']=="1"){ ?>
                    <span style="color:#f9f9f9f">Last Logged &nbsp;<?php echo putDateTime($response['data']['LoginHistory']['LoginOn']) ; ?></span>
                    <?php } ?>
                    </span><br> 
              </li>
             <li class="nav-item dropdown d-none d-xl-inline-block">
             <?php $filename = strlen(trim($_Member['FileName'])) >0 ? $_Member['FileName'] : SiteUrl."assets/images/userimage.jpg"; ?>
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"><img class="img-xs rounded-circle" style="border:2px solid #fff;height:50px !important;width:50px !important;" src="<?php echo $filename;?>" alt="Profile image"></a>
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
      <a class="navbar-brand brand-logo" href="<?php echo SiteUrl;?>" style="width:100%;height:100%;"><img src="<?php echo $config->logoPath?>" alt="logo" style="width:100%;height:100%;margin-top: 2px;"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">        
        <ul class="navbar-nav navbar-nav-right">
        <?php
                     $FranchiseeWallet = $webservice->getData("Franchisee","GetFranchiseeWalletBalance");
               ?>
            <li class="nav-item dropdown d-none d-xl-inline-block" style="text-align: right;margin-right: 0px;">
                    <img src="<?php echo ImagePath;?>wallet.svg" style="width:40px;color:white"/><br /><span class="profile-text" style="line-height:18px;">Rs.<?php echo $FranchiseeWallet['data']['WalletBalance'];?></span> 
                </li>
            <li class="nav-item dropdown d-none d-xl-inline-block">
                     <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>" class="dropdown-item">Wallet Update</a>
              <a href="<?php echo GetUrl("MyAccounts/MyTransactions");?>" class="dropdown-item">Wallet Transaction</a>
            </div>
              </li>
             <li class="nav-item dropdown d-none d-xl-inline-block">
                <span class="profile-text" style="line-height:10px; ">   
                <?php echo "<b>";echo $_Franchisee['PersonName'] ; echo "</b>";?></span><br> 
                <span class="profile-text" style="line-height:10px;">
                <?php echo ($_Franchisee['IsAdmin']==1) ? "<small>Franchisee Admin</small>"  : "Admin"; ?></span>
             </li> 
             <li class="nav-item dropdown d-none d-xl-inline-block">
             <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"><img class="img-xs rounded-circle" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="Profile image"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>" class="dropdown-item">My Accounts</a>
              <a href="<?php echo GetUrl("MySettings/FranchiseeInfo");?>" class="dropdown-item">My Settings</a>
              <a href="<?php echo SiteUrl;?>?action=logout&redirect=../index" class="dropdown-item">Log Out</a>
            </div>
          </li>
          </ul>
    </div>
      
      <?php } ?>
      <?php if (UserRole=="Admin") { ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="<?php echo SiteUrl;?>" style="width:100%;height:100%;"><img src="<?php echo $config->logoPath?>" alt="logo" style="width:100%;height:100%;margin-top: 2px;"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">        
        <ul class="navbar-nav navbar-nav-right">
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
    <div class="main-panel" style="overflow: -moz-hidden-unscrollable;">
        <div class="content-wrapper">
        <?php 
            function DisplayManageProfileShortInfo($ProfileInformation) {
                $Profile = $ProfileInformation['ProfileInfo'];
        ?>
            <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $ProfileInformation['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-6">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-5" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br>
                                                <?php if($Profile['IsApproved']==1 && $Profile['RequestToVerify']==1){  ?> 
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br> <?php } ?>
                                                <?php if($Profile['IsApproved']==0 && $Profile['RequestToVerify']==1){     echo "Submitted On: ".time_elapsed_string($Profile['RequestVerifyOn']); }?>
                                                 <?php if($Profile['IsApproved']==0 && $Profile['RequestToVerify']==0){    echo "Last Saved: ".time_elapsed_string($Profile['LastUpdatedOn']);  }?>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
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
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==0){ ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Posted/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } elseif($Profile['IsApproved']==1){  ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Published/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } else {?>
                                        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$Profile['ProfileCode'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                        <?php  }    ?>     
                            </div>
                        </div> 
                  <?php
              }
            ?>
            
            <?php 
            function DisplayPuplishProfileShortInfo($ProfileInformation) {
                $Profile = $ProfileInformation['ProfileInfo'];
        ?>
            <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $ProfileInformation['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color:#514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
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
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==0){ ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Posted/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } elseif($Profile['IsApproved']==1){  ?>
                                    <a href="<?php echo GetUrl("MyProfiles/Published/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } else {?>
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
                            <div class="col-sm-12" style="text-align:center">
                               <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;background:#fff;padding:6px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12" style="text-align:center;font-size: 21px;color: #514444cc;">
                               <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs)<br>
                            </div>
                             <div class="col-sm-12" style="text-align:center;color: #514444cc;">
                               <?php if($ProfileInformation['mode']=="Published"){?>
                                    <?php echo $ProfileInformation['mode'];?>&nbsp;(<?php echo putDate($Profile['IsApprovedOn']);?>)
                               <?php }else { echo $ProfileInformation['mode']; }?>
                            </div>                                                                                              
                        </div>
                        <div style="float:right;line-height: 1px;">
                                <?php if($ProfileInformation['mode']=="Draft") { ?>
                                   <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$Profile['ProfileCode'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MyProfiles/Draft/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                <?php } ?>
                                
                                <?php if($ProfileInformation['mode']=="Posted") { ?>
                                     <a href="<?php echo GetUrl("MyProfiles/Posted/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                <?php } ?>                        
                                
                                <?php if($ProfileInformation['mode']=="Published") { ?>
                                      <a href="<?php echo GetUrl("MyProfiles/Published/View/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                <?php } ?>
                    </div>                                          
                                                     
                  <?php                                            
              }
            ?>                                                  
           <?php                                                                               
            function DisplayManageRecentlyViewdProfileShortInfo($ProfileInformation) {
              
                $Profile = $ProfileInformation['ProfileInfo'];
        ?>
            <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #555;background:#fff;padding:6px">&nbsp;&nbsp;
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $ProfileInformation['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">                                                                                     
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:64px;"></div>
                                        <div style="float:right;font-size: 12px;">
                                        <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br>
                                        <?php 
                                        if ($ProfileInformation['LastSeen']!="0") { 
                                            echo "Last seen: ".time_elapsed_string($ProfileInformation['LastSeen']); 
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
                             <a href="<?php echo GetUrl("MyContacts/ViewProfileDetails/".$Profile['ProfileCode'].".htm ");?>">view</a>
                            </div>
                        </div>
                  <?php
              }
            ?>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <?php 
            /*fixed  1*/
            function DisplayProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=RecentlyWhoViewed");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?> 
            
            <?php /* 2*/
            function DisplayWhoFavoritedProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4" style="float:right;font-size: 12px;text-align:right">
                                          <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;float:right">
                                       </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="#">More</a>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=RecentlyWhoFavorited");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?>  
            <?php /* 3*/
            function DisplayMutualProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4" style="float:right;font-size: 12px;text-align:right">
                                          <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;float:right">
                                       </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?><a href="#">More</a>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=Mutual");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?> 
            <?php   /* 4*/
            function DisplayMyRecentViewedProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyRecentViewed");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?>  
            <?php 
            /*5*/
            function DisplayMyFavoritedProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyFavorited");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?>   
           <?php /*dashboard view1*/
                function dashboard_view_1($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
                    ?>                                                                                                                                                                                   
                       <div id="div_<?php echo $rnd; ?>" class="resCon_a002" style="height:280px;overflow:hidden;width:181px;padding:10px;margin-top:0px !important">
                        <div style="text-align:right;">
                        <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo$Profile['ProfileCode'];?></span>
                            <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>  
                        <div class="enlarge">
                        <div>
                            <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                            <span><img src="<?php echo $ProfileInformation['ProfileThumb'];?>" alt="" /><br /><?php echo $Profile['ProfileName'];?></span>
                        </div>
                        </div>
                        <div style="height:20px;"><h5 style="margin-bottom:-10px"><?php echo $Profile['ProfileName'];?></h5></div><br>
                        <span style="color:#bfacac;"><?php echo $Profile['City'];?></span><br>
                        <span style="color:#bfacac;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                        <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=RecentlyWhoViewed");?>" class="viewbutton" style="padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</a> <br><br>
                        <div style="text-align:center;"><span style="color:#999 !important;font-size: 12px">Visited&nbsp;<?php echo time_elapsed_string($Profile['LastSeen']);?></span></div>   
                    </div>
                    <?php
                }
            ?> 
            <?php  /*dashboardView 2 */
                function dashboard_view_2($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
                      
                    ?>
                    <div class="col-sm-12" id="resCon_a001">
                    
                    <div style="text-align:right;">
                        <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo$Profile['ProfileCode'];?></span>
                            <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                    <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                    <?php } else{?>
                                    <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                            <?php }?>
                        </div> 
                      <div class="col-sm-2" style="margin-left:-15px">
                        <div class="enlarge">
                        <div>
                            <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                            <span><img src="<?php echo $ProfileInformation['ProfileThumb'];?>" alt="" /><br /><?php echo $Profile['ProfileName'];?></span>
                        </div>
                        </div>
                      </div>
                        <div class="col-sm-10">
                          <div style="margin-top:-17px;margin-left: 73px;"><?php echo $Profile['ProfileName'];?></div>
                          <div style="height: 20px"><span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                                                            <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['City'];?></span>
                          </div> <br>
                          <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyRecentViewed");?>" class="viewbutton" id="dashviewbutton" style="padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;margin-left:73px">View</a> <br><br />
                          <div style="height: 20px;float:right;margin-right: -33px;line-height:12px;font-size: 11px;text-align: right"><span style="color:#999 !important;">
                            <?php if ($Profile['LastSeen']!=0) { ?> 
                            My last visited&nbsp;<?php echo time_elapsed_string($Profile['LastSeen']);?>
                            <?php } else { ?>
                            You favourited, but not view this profile.
                            <?php } ?>
                             <br />
                             <?php if($Profile['isMutured']==1) {?>
                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<?php echo $Profile['Sex']=="Male" ? "He " : "She "; ?>liked on <?php echo time_elapsed_string($Profile['MuturedOn']);?>
                             <?php }?>
                            </span></div> <br>
                        </div>
                    </div>
                    <?php
                }
            ?>                                                                     
<?php    /* dashboard view 3 */
                function dashboard_view_1_Recent_Favouriters($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
                    ?>                                                                                                                                                                                   
                       <div id="resCon_a002" class="resCon_a002" style="height:280px;overflow:hidden;width:181px;padding:10px;margin-top:0px !important">
                         <div style="text-align:right;">
                        <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo$Profile['ProfileCode'];?></span>
                            <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div> 
                         <div class="enlarge">
                        <div>
                            <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                            <span><img src="<?php echo $ProfileInformation['ProfileThumb'];?>" alt="" /><br /><?php echo $Profile['ProfileName'];?></span>
                        </div>
                        </div>
                        <div style="height:20px;"><h5 style="margin-bottom:-10px"><?php echo $Profile['ProfileName'];?></h5></div><br>
                        <span style="color:#bfacac;"><?php echo $Profile['City'];?></span><br>
                        <span style="color:#bfacac;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                        <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=RecentlyWhoFavorited");?>" class="viewbutton" style="padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</a> <br><br>
                        <div style="text-align:center;"><span style="color:#999 !important;font-size: 12px">Visited &nbsp;<?php echo time_elapsed_string($Profile['LastSeen']);?></span></div>   
                    </div>
                    <?php
                }
            ?>             
            <?php   /*dashboard view 4 */
                function dashboard_myfavorited_view_2($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
                    ?>
                    <div class="col-sm-12" id="resCon_a001">
                     
                    <div style="text-align:right;">
                        <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo$Profile['ProfileCode'];?></span>
                            <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                           <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div> 
                      <div class="col-sm-2" style="margin-left:-15px">
                        <div class="enlarge">
                        <div>
                            <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                            <span><img src="<?php echo $ProfileInformation['ProfileThumb'];?>" alt="" /><br /><?php echo $Profile['ProfileName'];?></span>
                        </div>
                        </div>
                      </div>
                        <div class="col-sm-10">
                          <div style="margin-top:-17px;margin-left: 73px;"><?php echo $Profile['ProfileName'];?></div>
                          <div style="height: 20px"><span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                                                            <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['City'];?></span>
                          </div> <br>
                          <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyFavorited");?>" class="viewbutton" id="dashviewbutton" style="padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;margin-left:73px">View</a> <br><br />
                          <div style="height: 20px;float:right;margin-right: -33px;line-height:12px;font-size: 11px;text-align: right"><span style="color:#999 !important;">
                            <?php if ($Profile['LastSeen']!=0) { ?> 
                            My last visited&nbsp;<?php echo time_elapsed_string($Profile['LastSeen']);?>
                            <?php } else { ?>
                            You favourited, but not view this profile.
                            <?php } ?>
                             <br />
                             <?php if ($Profile['isMutured']==1) {?>
                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<?php echo $Profile['Sex']=="Male" ? "He " : "She "; ?>liked on <?php echo time_elapsed_string($Profile['MuturedOn']);?>
                             <?php }?>
                            </span></div> <br>
                        </div>
                    </div>
                    <?php
                }
            ?> 
             <?php  /* dashboard view 5 */
                function dashboard_mutual_profiles($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
                    ?>         
                      <div id="mutprofile_div_<?php echo $rnd; ?>" class="resCon_a002" style="height:280px;overflow:hidden;width:181px;padding:10px;margin-top:0px !important">
                        <div style="text-align:right;">
                            <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float:left"><?php echo$Profile['ProfileCode'];?></span>&nbsp;&nbsp;
                            <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>');HideDiv('<?php echo $rnd;?>');" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                        </div>   
                         <div class="enlarge">
                        <div>
                            <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                            <span><img src="<?php echo $ProfileInformation['ProfileThumb'];?>" alt="" /><br /><?php echo $Profile['ProfileName'];?></span>
                        </div>
                        </div>
                        <div style="height:20px;"><h5 style="margin-bottom:-10px"><?php echo $Profile['ProfileName'];?></h5></div><br>
                        <span style="color:#bfacac;"><?php echo $Profile['City'];?></span><br>
                        <span style="color:#bfacac;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                        <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=Mutual");?>" class="viewbutton" style="padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</a> <br><br>
                        <div style="text-align:center;"><span style="color:#999 !important;font-size: 12px">Visited &nbsp;<?php echo time_elapsed_string($Profile['LastSeen']);?></span></div>   
                    </div>                                                                                                                                                                                
                    <?php
                }
            ?>
             <?php 
            /*Browse Matches 1*/
            function DisplayBrowseMatchesProfileShortInformation($ProfileInformation) {
                      $Profile = $ProfileInformation['ProfileInfo'];
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $ProfileInformation['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-6">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:23px;"></span></div> 
                                       <div class="col-sm-5" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".putDate($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <!--<a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php //echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="<?php //echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;--><a href="<?php  echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=BrowseMatches");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                        </div>
                  <?php
              }
            ?>                                                                                                                                     
            <?php 
            /*DisplayMyDownloadedProfiles 1*/
            function DisplayMyDownloadedProfiles($Profile) {
                      $rnd = rand(3000,3000000);
            ?>
            <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $Profile['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                              <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyDownloaded");?>">view</a>
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
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:40px;"></div><div style="float:right;font-size: 12px;">Published:&nbsp;&nbsp;<?php echo time_elapsed_string($Profile['IsApprovedOn']);?><br>Lastseen:</div> 
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
        <?php function Admin_Landing_page_Profiles($Profile,$p) {  ?>  
   <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $p['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row" style="margin-bottom:0px">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4" style="text-align:right">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px">
                                                From&nbsp;:&nbsp;<?php echo putDate($p['DateFrom']);?> <br>
                                                To&nbsp;:&nbsp;<?php echo putDate($p['DateTo']);?>  
                                           </div>  
                                       </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div>
                                       </div>
                                            <div class="col-sm-5" style="text-align:right">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px">
                                            <?php $end_date =strtotime($p['DateTo']); 
                                                 $start_date   = strtotime(date("Y-m-d")); 
                                                $remainingdate =($end_date - $start_date);////(60*60*24);
                                                if ($remainingdate>0) {
                                                 echo '<span style="color:green">'.$remainingdate/(60*60*24). ' days remaining </span>';
                                                }
                                                else{
                                                    echo '<span style="color:red">'.($remainingdate*-1)/(60*60*24). ' days ago </span>';
                                                }
                                           ?> 
                                           </div>
                                            </div> 
                                       </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?> <a href="#">More</a>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                               <a href="<?php echo GetUrl("ViewMemberProfile/".$Profile['ProfileCode'].".htm ");?>">view</a>
                            </div>
                        </div> 
                    <?php }?>