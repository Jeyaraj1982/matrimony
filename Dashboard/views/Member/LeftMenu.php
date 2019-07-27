<style>div, label,a,ul,li,p,h1,h2,h3,h4,h5,h6,span,i,b,u {font-family:'Roboto' !important;}</style>
<script>
    function changeMemberStatus(txt) {
        $('#mem_current_status').html(txt);
    }
</script>

    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
    <?php if (isset($_POST['btnSaveFileName'])) {
            $response = $webservice->updateProfilePhoto($_POST);
            if ($response['status']=="success") {   
                $successmessage = $response['message'];          
            } else {
                $errormessage = $response['message']; 
            }
         }
    ?>
    <nav class="sidebar sidebar-offcanvas bshadow" id="sidebar">
        <ul class="nav">
            <li><span id="mem_current_status" style="padding-left:160px;font-size: 14px;"></span> <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false" style="float:right;padding:0px 10px;"></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="left: -19px;position: absolute;will-change: transform;top: 0px;transform: translate3d(5px, 23px, 0px);width: 50px;min-width: 101px;">
              <a href="javascript:changeMemberStatus('Available')" class="dropdown-item">
                Available
              </a>
              <a href="javascript:changeMemberStatus('Visible')" class="dropdown-item">
                Visible
              </a>
              <a href="javascript:changeMemberStatus('Invisible')" class="dropdown-item">
                Invisible
              </a></li>
        <li class="nav-item" style="text-align: center;padding-right:25px;padding-left:20px;padding-bottom:10px;padding-top: 0px;">
            <img class="rounded-circle" src="<?php echo ImageUrl?>userimage.jpg" alt="Profile image" style="height:100px">
            <img data-toggle="modal" data-target="#UploadImage" data-backdrop="false" src="<?php echo ImageUrl?>camera.png" style="height: 25px;margin-top: 58px;margin-left: -35px;border: 1px solid #fff;border-radius: 50%;cursor:pointer"><br>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo SiteUrl;?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title" style="font-size:14px">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manageprofiles" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy "></i>                
              <span class="menu-title" style="font-size:14px">My Profiles</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manageprofiles">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyProfiles/ManageProfile");?>">Manage Profiles</a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/RecentlyWhoViewed");?>" style="font-size:13px">Recently who viewed</a>
                </li>
              </ul>
            </div>
        </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mysearch" aria-expanded="false" aria-controls="mysearch">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">Matches</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mysearch">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Matches/Browse/BrowseMatches");?>" style="font-size:13px">Browse Matches</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Matches/Search/BasicSearch");?>" style="font-size:13px">Basic Search </a>
                </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Matches/Search/AdvancedSearch");?>" style="font-size:13px">Advanced Search</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Matches/Search/ByProfileID");?>" style="font-size:13px">Search By ID</a>
                </li>
                --> 
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mycontacts" aria-expanded="false" aria-controls="mycontacts">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">My Contacts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mycontacts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/MyRecentViewed");?>" style="font-size:13px">My Recently Viewed </a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/MyFavorited");?>" style="font-size:13px">My Favorited </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/MyDownloaded");?>" style="font-size:13px">My Downloaded</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/MyInvitations");?>" style="font-size:13px">My Invitations</a>
                </li>
                 
              </ul>
            </div>
        </li>
 
        
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#support" aria-expanded="false" aria-controls="Support">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">Support</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="support">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/ServiceRequests");?>">Service Requests</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/SupportTickets");?>">Support Ticket</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/Complaints");?>">Complaints</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/SupportDocs");?>">Support & Help Docs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/Feedback");?>">Feedback</a>
                </li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Accounts" aria-expanded="false" aria-controls="Support">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">My Accounts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Accounts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Accounts/MyOrders");?>">My Orders</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Accounts/MyInvoices");?>">My Invoices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Accounts/MyReceipts");?>">My Receipts</a>
                </li>
              </ul>
            </div>
        </li> 
           
        
       <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#others" aria-expanded="false" aria-controls="others">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">Others</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="others">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Others/SuccessStories");?>">Success Stories</a>
                </li>
              </ul>
            </div>
        </li>   -->                             
    </ul>
</nav>

<div class="modal fade" id="UploadImage" role="dialog" data-backdrop="static" style="margin-left: -85px;padding-top: 108px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width:500px">
        <div class="modal-content" style="width: 120%;">
            <div class="modal-body">
                  <div class="row">
              <div class="col-sm-12" style="float:right;"><button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;margin-bottom: 10px;float:right">&times;</button></div>
              <div class="col-sm-3" style="margin-right: -58px;"><strong>Select Image:</strong></div>
              <div class="col-sm-9"><input type="file" id="upload"></div>
              <div class="col-sm-6" style="text-align:center;margin-top: 10px;">
                <div id="upload-demo" style="width:350px"></div>
              </div>
              <div class="col-sm-6" style="text-align:center;margin-top: 10px;">
                <div id="upload-demo-i" style="background:#e1e1e1;width:275px;padding:30px;height:300px;"></div>
              </div>
              <?php echo $errormessage ;?><?php echo $successmessage?>
                <div class="col-sm-12" style="text-align:center;margin-top: 10px;"><button class="btn btn-primary upload-result"  name="btnSaveFileName"style="outline:0;font-family: roboto;">Upload Image</button> &nbsp;<a class="close" data-dismiss="modal" style="color:black;font-size: 14px;font-weight:100;opacity:1">Cancel</a>
              </div>
          </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
        
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {


        $.ajax({
            url: "ajaxpro.php",
            type: "POST",
            data: {"image":resp},
            success: function (data) {
                html = '<div style="text-align:center"><img src="' + resp + '" />';
                html += '<form action="" method="post">';
                    html += '<input type="hidden" value="'+data+'" name="filename"><br>';
                    html += '<input type="submit" class="btn btn-primary" style="outline:0;" value=" Save " name="btnSaveFileName">';
                html += '</form></div>';
                $("#upload-demo-i").html(html);
            }
        });
    });
});
 $("#btnClosePopup").click(function () {
            $("#upload-demo").modal("hide");
        });
</script>
 
  