<?php 

?>
<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
    .rightwidget {padding:15px !important;max-width:770px !important;border-left:1px solid #e5e5e5;min-height:645px}
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
        <div class="col-12" >
            <div class="card">
                <div class="card-body" style="padding:0px">
                    <div class="form-group-row">
                        <div>
                            <div class="col-sm-2" style="min-width:200px;padding-left:0px;padding-right: 0px;;">
                            <?php 
                            $response_profilephoto = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
                            $ProfileInfo          = $response_profilephoto['data']['ProfileInfo'];
                            ?>
                                <div style="text-align: center;margin-top:20px"><img src="<?php echo $response_profilephoto['data']['ProfilePhotoFirst'];?>" style="height:120px;border: 1px solid black;">
                                    <div style="line-height: 25px;color: #867c7c;font-size:11px;">
                                        Member ID:&nbsp;<?php echo $ProfileInfo['MemberCode'];?><br>
                                        Profile ID:&nbsp;<?php echo $ProfileInfo['ProfileCode'];?><br>
                                    </div>
                                    <div style="margin-left: 10%;margin-right: 10%;border-radius: 3px !important;background: #f6f6f6;height: 15px;padding: 0px;">
                                        <div style="width:<?php echo $ProfileInfo['Progress']['ratio'];?>%;background: url('<?php echo ImageUrl;?>pbar-ani.gif');height: 15px;border-radius: 2px 0px 0px 2px;"></div>
                                    </div>
                                    <div style="line-height: 25px;color: #867c7c;font-size:11px;"><?php echo $ProfileInfo['Progress']['Completed']."/".$ProfileInfo['Progress']['Total'];?></div>    
                                </div>                                                  
                              <br>                                                                      
                                <div class="sidemenu">
                                    <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="GeneralInformation") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;border-top:1px solid #eee;">
                                           <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/GeneralInformation/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>General Information</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon1 <?php echo ($page=="EducationDetails") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">   
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/EducationDetails/". $_GET['Code'].".htm");?>" class="" style="text-decoration:none"><span>Education Details</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="OccupationDetails") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/OccupationDetails/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Occupation Detail</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="FamilyInformation") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/FamilyInformation/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Family Information</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="PhysicalInformation") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/PhysicalInformation/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Physical Information</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="DocumentAttachment") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/DocumentAttachment/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Document Attachment</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="CommunicationDetails") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/CommunicationDetails/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Communication Details</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ProfilePhoto") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/ProfilePhoto/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Profile Photo</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="PartnersExpectation") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                           <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/PartnersExpectation/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Partner's Expectation</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="HoroscopeDetails") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                           <img src="<?php echo SiteUrl?>assets/images/ticksquare.png">&nbsp;<a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/HoroscopeDetails/". $_GET['Code'].".htm");?>" class="Notification" style="text-decoration:none"><span>Horoscope Details</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
