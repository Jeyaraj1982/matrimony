<nav class="sidebar sidebar-offcanvas bshadow" id="sidebar">
    <br><br>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="<?php echo SiteUrl;?>"><i class="menu-icon mdi mdi-television"></i><span class="menu-title" style="font-size:14px"><?php echo $lang['dashboard'];?></span></a></li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manageprofiles" aria-expanded="false" aria-controls="ui-basic"><i class="menu-icon mdi mdi-account "></i><span class="menu-title" style="font-size:14px"><?php echo $lang['my_profiles'];?></span><i class="menu-arrow"></i></a>
            <div class="collapse" id="manageprofiles">                                                                                
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyProfiles/ManageProfile");?>"><?php echo $lang['manage_profile'];?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/RecentlyWhoViewed");?>" style="font-size:13px"><?php echo $lang['recently_who_viewed'];?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/RecentlyWhofavourited");?>" style="font-size:13px"><?php echo $lang['recently_who_liked'];?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/MutualProfiles");?>" style="font-size:13px"><?php echo $lang['mutually_liked_profiles'];?></a></li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mysearch" aria-expanded="false" aria-controls="mysearch"><i class="menu-icon mdi mdi-account-multiple"></i><span class="menu-title"  style="font-size:14px"><?php echo $lang['matches'];?></span><i class="menu-arrow"></i></a>
            <div class="collapse" id="mysearch">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Matches/Browse/BrowseMatches");?>" style="font-size:13px"><?php echo $lang['browse_matches'];?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Matches/Search/BasicSearch");?>" style="font-size:13px"><?php echo $lang['basic_search'];?></a></li>
              </ul>
            </div>
        </li>                                                                                                                        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mycontacts" aria-expanded="false" aria-controls="mycontacts"><i class="menu-icon mdi mdi-message-text"></i><span class="menu-title"  style="font-size:14px"><?php echo $lang['my_contacts'];?></span><i class="menu-arrow"></i></a>
            <div class="collapse" id="mycontacts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/MyRecentViewed");?>" style="font-size:13px"><?php echo $lang['my_recently_viewed'];?></a></li> 
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/MyFavorited");?>" style="font-size:13px"><?php echo $lang['my_liked'];?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("MyContacts/MyDownloaded");?>" style="font-size:13px"><?php echo $lang['my_downloaded'];?></a></li>
              <!--  <li class="nav-item"><a class="nav-link" href="<?php// echo GetUrl("MyContacts/MyInvitations");?>" style="font-size:13px"><?php //echo $lang['my_invitations'];?></a></li>-->
              </ul>                                                                                                
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Accounts" aria-expanded="false" aria-controls="Support"><i class="menu-icon mdi mdi-account-star"></i><span class="menu-title"  style="font-size:14px"><?php echo $lang['my_accounts'];?></span><i class="menu-arrow"></i></a>
            <div class="collapse" id="Accounts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyWallet");?>"><?php echo $lang['my_wallet'];?></a></li>
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyOrders");?>"><?php echo $lang['my_orders'];?></a></li>
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyInvoices");?>"><?php echo $lang['my_invoices'];?></a></li>
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyReceipts");?>"><?php echo $lang['my_receipts'];?></a></li>
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("MyAccounts/MyTransactions");?>"><?php echo $lang['my_transactions'];?></a></li>
              </ul>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#support" aria-expanded="false" aria-controls="Support"><i class="menu-icon mdi mdi-account-switch"></i><span class="menu-title"  style="font-size:14px"><?php echo $lang['support'];?></span><i class="menu-arrow"></i></a>
            <div class="collapse" id="support">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/ServiceRequests");?>"><?php echo $lang['service_requests'];?></a></li>
                <li class="nav-item"><a class="nav-link" style="font-size:13px" href="<?php echo GetUrl("Support/ResolutionCenter");?>"><?php echo $lang['resolution_center'];?></a></li>
              </ul>
            </div>
        </li>
    </ul>
</nav>