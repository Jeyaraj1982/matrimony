<ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
        <li class="ft-left-nav-list fusmyacc_leftnavicon1 <?php echo ($page=="ChangePassword") ? ' linkactive1 ':'';?>" style="padding: 8px;border-bottom:1px solid #eee;">   
            <a id="myaccount_leftnav_a" href="<?php echo GetUrl("MySettings/ChangePassword");?>" class="" style="text-decoration:none"><span>Change Password</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Notification") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/Notification");?>" class="Notification" style="text-decoration:none"><span>Notification</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyMemberInfo") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/MyMemberInfo");?>" class="Notification" style="text-decoration:none"><span>My Member Info</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyPrivacyInfo") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/MyPrivacyInfo");?>" class="Notification" style="text-decoration:none"><span>My Privacy Info</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="KYC") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/KYC");?>" class="Notification" style="text-decoration:none"><span>KYC</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="LoginHistory") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/LoginHistory");?>" class="Notification" style="text-decoration:none"><span>Login History</span>
            </a>
        </li>
        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Activities") ? ' linkactive1 ':'';?>"style="padding: 8px;border-bottom:1px solid #eee;">
            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MySettings/Activities");?>" class="Notification" style="text-decoration:none"><span>Activities</span>
            </a>
        </li>
</ul>
<style>
    ft-left-nav-list li:hover{
        background: #f8f8f8;
    }
    .linkactive1{
     color:white;
    cursor:pointer;
    border-bottom:transparent;
    background:#fafbfc;
    /*background: linear-gradient(to bottom, rgba(179,220,237,1) 0%, rgba(129,190,211,1) 22%, rgba(65,152,179,1) 50%, rgba(188,224,238,1) 100%); */
} 
</style>