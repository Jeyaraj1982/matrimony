<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
    .rightwidget {padding:15px !important;max-width:770px !important;border-left:1px solid #e5e5e5;min-height:450px}
</style>

<div class="col-md-12 d-flex align-items-stretch grid-margin" style="padding:0px !important">
    <div class="row flex-grow">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="padding:0px">
                    <div class="form-group-row">
                        <div>
                            <div class="col-sm-2" style="padding-left:0px;padding-right: 0px;;">
                                <div class="sidemenu">
                                    <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="SMSLog") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Logs/SMSLog");?>" class="Notification" style="text-decoration:none"><span>SMS</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="EmailLog") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Logs/EmailLog");?>" class="Notification" style="text-decoration:none"><span>Email</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="LoginLog") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Logs/LoginLog");?>" class="Notification" style="text-decoration:none"><span>Login</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ActivityLog") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Logs/Activity");?>" class="Notification" style="text-decoration:none"><span>Activity</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="NotificationsandActionsLog") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Logs/Notification");?>" class="Notification" style="text-decoration:none"><span>Notifications &amp; Actions</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
