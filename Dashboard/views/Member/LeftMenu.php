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
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo GetUrl("MyContacts/RecentlyWhofavourited");?>" style="font-size:13px">Recently who Favorited</a>
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

 
  