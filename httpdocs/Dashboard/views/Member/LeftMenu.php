<style>
div, label,a,ul,li,p,h1,h2,h3,h4,h5,h6,span,i,b,u {font-family:'Roboto' !important;}
</style>
<script>
function changeMemberStatus(txt) {
    $('#mem_current_status').html(txt);
}
</script>
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
        <li class="nav-item" style="text-align: center;padding-right:25px;padding-left:25px;padding-bottom:10px;padding-top: 0px;">
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
                  <a class="nav-link" href="" style="font-size:13px">Invited Profiles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="" style="font-size:13px">Received Invitations</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="" style="font-size:13px">Active</a>
                </li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#myaccounts" aria-expanded="false" aria-controls="myaccounts">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"  style="font-size:14px">My Accounts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="myaccounts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyInvoices");?>">My Invoices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyTransactions");?>">My Transactions</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyWallet");?>">My Wallet</a>
                </li>
              </ul>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade" id="UploadImage" role="dialog" data-backdrop="static" style="margin-left: -85px;padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width:500px">
        <div class="modal-content" style="width: 120%;">
            <div class="modal-body">
                  <div class="row">
              <div class="col-sm-12" style="float:right;"><button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;margin-bottom: 10px;">&times;</button></div>
              <div class="col-sm-3" style="margin-right: -58px;"><strong>Select Image:</strong></div>
              <div class="col-sm-9"><input type="file" id="upload"></div>
              <div class="col-sm-12" style="text-align:center;margin-left: 146px;margin-top: 10px;">
                <div id="upload-demo-i" style="background:#e1e1e1;width:275px;padding:30px;height:300px;"></div>
                </div>
                <div class="col-sm-12" style="text-align:center;margin-top: 10px;"><button class="btn btn-success upload-result" style="outline:0">Upload Image</button>
              </div>
          </div>
            </div>
        </div>
    </div>
</div>

 
  