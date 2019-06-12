<style>
div, label,a,ul,li,p,h1,h2,h3,h4,h5,h6,span,i,b,u {font-family:'Roboto' !important;}
</style>

<nav class="sidebar sidebar-offcanvas bshadow" id="sidebar">
        <ul class="nav">
          <li class="nav-item" style="text-align: center;margin-top:25px;margin-bottom:10px;height:150px;">
            <img class="img-xs rounded-circle" src="<?php echo SiteUrl?>images/userimage.jpg" alt="Profile image" style="margin-bottom: 10px;width: 35%;height: 60%;"><br>
            <?php $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$_Member['MemberID']."'");
                if ($memberdata[0]['IsMobileVerified']==1) {
                    echo '<span style="font-size:14px">Mobile Number Verified</span>';} echo'<br>'; ?>
            <?php if ($memberdata[0]['IsEmailVerified']==1) {
                    echo '<span style="font-size:14px">Email Verified</span>';} echo'<br>'; ?>
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
              <span class="menu-title"  style="font-size:14px">Profiles</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manageprofiles">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link"  style="font-size:13px" href="<?php echo GetUrl("Profile/ManageProfile");?>">Manage Profiles</a>
                </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Profile/CreateProfile");?>">Create Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Profile/Draft");?>">Drafted</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Profile/Posted");?>">Posted</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Profile/Published");?>">Published</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("Profile/Expired");?>">Expired</a>
                </li> -->
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
                  <a class="nav-link" href="" style="font-size:13px">Recently Added</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="" style="font-size:13px">Viewed</a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="" style="font-size:13px">Requested</a>
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
                  <a class="nav-link" style="font-size:13px"  href="<?php echo GetUrl("Accounts/MyInvoices");?>">My Invoices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Accounts/MyTransactions");?>">My Transactions</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Accounts/MyWallet");?>">My Wallet</a>
                </li>
              </ul>
            </div>
          </li>
         </ul>
      </nav>
      
      
 