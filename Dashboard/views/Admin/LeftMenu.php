 <nav class="sidebar sidebar-offcanvas" id="sidebar"  style="overflow: auto;height: 300px;" >
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo GetUrl(Dashboard);?>">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#managemembers" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Members</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="managemembers">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php  echo GetUrl("Members/ManageMember");?>">Manage Members</a></li>
                       <!-- <li class="nav-item"><a class="nav-link" href="<?php //echo GetUrl("Members/News/NewsandEvents");?>">News & Events</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Members/Plan/ManagePlan");?>">Manage Plans</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Members/KYC/KYCVerification");?>">KYC Verification</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#manageprofiles" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Profiles</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="manageprofiles">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/Requested");?>">Requested</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/Drafted");?>">Drafted</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/Published");?>">Published</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/Expired");?>">Expired</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/Rejected");?>">Rejected</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Profiles/DocumentVerification");?>">Document Verification</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("FeaturedGrooms");?>">Feature Grooms</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("FeaturedBrides");?>">Feature Brides</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SearchMemberProfile");?>">Add To Feature</a></li>
				   </ul>
                </div>                                                                
            </li>                                                      
           <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#managefranchisees" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Franchisees</span> 
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="managefranchisees">
                    <ul class="nav flex-column sub-menu"> 
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Franchisees/Create");?>">New Franchisee</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Franchisees/MangeFranchisees");?>">Manage Franchisees</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Franchisees/Plan/ManagePlan");?>">Manage Plans</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Franchisees/Wallet/RefillWallet");?>">Refill Wallet</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="<?php //echo GetUrl("Franchisees/News/NewsandEvents");?>">News & Events</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php //echo GetUrl("Franchisees/ResetPassword/SearchMember");?>">Reset Password</a></li> -->
                    </ul>
                </div>                             
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#manageaccount" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">My Accounts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="manageaccount">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/WalletTransaction");?>">Wallet Transactions</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/ManageOrder");?>">Manage Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/Invoice/Invoices");?>">Manage Invoices</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/Receipt/Receipts");?>">Manage Receipts</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/ManagePayouts");?>">Manage Payouts</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/ManageWalletReceipts");?>">Manage Wallet Receipts</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Accounts/ManagePGTransaction");?>">Manage PG Txns</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#requests" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">Requests</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="requests">
                    <ul class="nav flex-column sub-menu">                             
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Requests/Member/ListOfAllBankRequests");?>">Member Bank Requests</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Requests/Franchisee/ListOfFranchiseeAllBankRequests");?>">Franchisee Bank Requests</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Requests/Member/ListOfAllPaypalRequests");?>">Paypal Request</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Requests/Member/ViewDocumentsVerification");?>">Document Verifications</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#masters" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Masters</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="masters">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/ReligionNames/ManageReligion");?>">Religion Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/CasteNames/ManageCaste");?>">Caste Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/StarNames/ManageStar");?>">Star Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/NationalityNames/ManageNationalityName");?>">Nationality Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/IncomeRanges/ManageIncomeRanges");?>">Income Ranges</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/CountryNames/ManageCountry");?>">Country Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/DistrictNames/ManageDistrict");?>">District Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/StateNames/ManageState");?>">State Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/ProfileSigninFor/ManageProfileSigninFor");?>">Profile Signin For</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/LanguageNames/ManageLanguage");?>">Language Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/MartialStatus/ManageMartialStatus");?>">Martial Status</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/BloodGroups/ManageBloodGroups");?>">Blood Groups</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Complexions/ManageComplexions");?>">Complexions</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/BodyTypes/ManageBodyTypes");?>">BodyTypes</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Diets/ManageDiets");?>">Diets</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Heights/ManageHeights");?>">Heights</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Weights/ManageWeights");?>">Weights</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Occupations/ManageOccupations");?>">Occupations</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/OccupationTypes/ManageOccupationTypes");?>">Occupation Types</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/EducationTitles/ManageEducationTitles");?>">Education Titles</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/EducationDegrees/ManageEducationDegrees");?>">Education Degrees</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Monsigns/ManageMonsigns");?>">Monsign</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/Lakanam/ManageLakanam");?>">Lakanam</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/BankNames/ManageBank");?>">Bank Names</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/FamilyType/ManageFamilyType");?>">Family Type</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/FamilyValue/ManageFamilyValue");?>">Family Value</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Masters/FamilyAffluence/ManageAffluence");?>">Family Affluence</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SequenceMaster/ManageSequenceMaster");?>">Sequence Master</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="settings">
                    <ul class="nav flex-column sub-menu">              
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/MobileSMS/MobileSms");?>">Mobile SMS</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/Email/EmailApi");?>">Email API</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/General/ManageGeneral");?>">General</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/Application/ManageApplication");?>">Application</a></li>-->
                        <!-- <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/Invoice/Invoice");?>">Invoice</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/Bank/ListofBanks");?>">Add Bank</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Settings/PayPal/Paypal");?>">Paypal</a></li>
                    </ul>
                </div>
            </li> 
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#staffs" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Staffs</span>
                    <i class="menu-arrow"></i>
                </a>                                                                   
                <div class="collapse" id="staffs">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Staffs/ManageStaffs");?>">Manage Staffs</a></li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#website" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Website</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="website">
                    <ul class="nav flex-column sub-menu">
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageSliders");?>">Manage Sliders</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManagePages");?>">Manage Pages</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageMenus");?>">Manage Menus</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageFAQs");?>">Manage FAQs</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageSuccessStories");?>">Manage Success Stories</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageTestimonials");?>">Manage Testimonials</a></li> -->
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/ManageFeatures");?>">Manage Features</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Websites/Settings");?>">Settings</a></li> -->
                       <!--</ul>
                </div>
            </li>-->
           <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Tickets" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Support Tickets</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Tickets">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SupportTicket/ManageTickets");?>">Manage Tickets</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SupportTicket/SearchTicket");?>">Search Tickets</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SupportTicket/OpenTicket");?>">Open Tickets</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SupportTicket/ClosedTicket");?>">Closed Tickets</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("SupportTicket/InprocessTicket");?>">Inprocess Tickets</a></li>
                       </ul>
                </div>
            </li>  -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#Logs" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Logs</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="Logs">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Logs/SMSLog");?>">SMS Log</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Logs/EmailLog");?>">Email Log</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Logs/LoginLog");?>">Login Log</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("Logs/Activity");?>">Activity</a></li>
                    </ul>
                </div>
            </li>
           <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ApplicationSettings" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Application Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ApplicationSettings">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("ConfigurationSettings");?>">Configuration Setings</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo GetUrl("GeneralSettings");?>">General Setings</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo GetUrl("OnlineMembers");?>">
                    <i class="menu-icon mdi mdi-content-copy "></i>
                    <span class="menu-title">Online Members</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
         </ul>
    </nav> 