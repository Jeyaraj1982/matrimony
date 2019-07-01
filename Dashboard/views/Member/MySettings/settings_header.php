<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
</style>

<div class="col-12 grid-margin" style="padding:0px !important">
    <div class="card">
        <div class="card-body" style="padding:15px !important">
            <h4 class="card-title" style="font-size: 22px;margin-top:0px;margin-bottom:15px">My Settings</h4>
            <h5 style="color:#666">Control, protect and secure your account all in one place.</h5>
            <h6 style="color:#999;margin-bottom:0px">This page gives you quick access to settings and tools that let you safeguard your data, protect your privacy and decide how your information can make us.</h6>
        </div>
    </div>
</div>

<div class="col-md-12 d-flex align-items-stretch grid-margin" style="padding:0px !important">
    <div class="row flex-grow">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group-row">
                        <div class="col-sm-12">
                            <div class="col-sm-3" style="width: 15%;">
                                <div class="sidemenu" style="width: 170px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                                    <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyMemberInfo") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/MyMemberInfo");?>" class="Notification" style="text-decoration:none"><span>My Member Info</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon1 <?php echo ($page=="ChangePassword") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">   
                                            <a id="myaccount_leftnav_a" href="<?php echo GetUrl("MySettings/ChangePassword");?>" class="" style="text-decoration:none"><span>Change Password</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Notification") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/Notification");?>" class="Notification" style="text-decoration:none"><span>Notifications & actions</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyPrivacy") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/MyPrivacy");?>" class="Notification" style="text-decoration:none"><span>My Privacy</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="KYC") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/KYC");?>" class="Notification" style="text-decoration:none"><span>KYC Process</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="LoginHistory") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/LoginHistory");?>" class="Notification" style="text-decoration:none"><span>Login History</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyActivities") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/MyActivities");?>" class="Notification" style="text-decoration:none"><span>My Activities</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="DeleteMember") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/DeleteMember");?>" class="Notification" style="text-decoration:none"><span>Delete Member</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>