    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SiteUrl;?>">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Member" aria-expanded="false" aria-controls="Member">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">Members</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Member">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Members/CreateMember");?>">Create Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Members/ManageMembers");?>">Manage My Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Members/SearchMember");?>">Search Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Members/Wallet/SearchMemberDetails");?>">Refill Wallet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Members/ResetPassword/SearchMember");?>">Reset Password</a>
                        </li>
                    </ul>
                </div> 
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#manageprofiles" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Manage Profiles</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="manageprofiles">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("NewProfile");?>">Create Profile</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="">Manage Profile</a>
                        </li>
                        <li class="nav-item">                                 
                            <a class="nav-link" href="<?php echo GetUrl("Profiles/SearchProfile");?>">Search Profile</a>
                        </li>
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="">Drafted</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Posted</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Expired</a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#myaccounts" aria-expanded="false" aria-controls="myaccounts">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">My Accounts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="myaccounts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("MyAccounts/MyInvoices");?>">My Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("MyAccounts/MyTransactions");?>">My Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("MyAccounts/RefillWallet");?>">Refill Wallet</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#requests" aria-expanded="false" aria-controls="requests">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">Resolution</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="requests">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="">New Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">View Requests</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#FranchiseeInfo" aria-expanded="false" aria-controls="FranchiseeInfo">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">My bussiness</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="FranchiseeInfo">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Franchisee Info </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("MyBussiness/LicenseInfo");?>">License Info </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo GetUrl("Staffs/ManageStaffs");?>">Manage Staffs</a>
                        </li>
                    </ul>
                </div> 
            </li>                                             
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#GeneralInfo" aria-expanded="false" aria-controls="search">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">General Info</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="GeneralInfo">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Renew Subscription </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cancel Subscription</a> 
                        </li>
                    </ul>
                </div>
            </li> 
           <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#search" aria-expanded="false" aria-controls="search">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">Search</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="search">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">by Profile ID</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">by Mobile Number</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Advance Search</a>
                        </li>
                    </ul>
                </div>
            </li> 
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#history" aria-expanded="false" aria-controls="history">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">History</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="history">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Recent Profiles View</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Recent Activities</a>
                        </li>
                    </ul>
                </div>
            </li> -->  
        </ul>
    </nav>