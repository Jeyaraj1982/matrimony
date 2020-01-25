<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
    .rightwidget {padding:15px !important;border-left:1px solid #e5e5e5;min-height:450px}
</style>
<div class="col-md-12 d-flex align-items-stretch grid-margin" style="padding:0px !important">
    <div class="row flex-grow">  
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="padding:0px">
                    <div class="form-group">
                        <div>
                            <div class="col-sm-2" style="padding-left:0px;padding-right: 0px;;">
                                <div class="sidemenu">
                                    <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Religion") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/ReligionNames/ManageReligion");?>" class="Notification" style="text-decoration:none"><span>Religion Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Caste") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/CasteNames/ManageCaste");?>" class="Notification" style="text-decoration:none"><span>Caste Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Star") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/StarNames/ManageStar");?>" class="Notification" style="text-decoration:none"><span>Star Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Nationality") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/NationalityNames/ManageNationalityName");?>" class="Notification" style="text-decoration:none"><span>Nationality Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="IncomeRange") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/IncomeRanges/ManageIncomeRanges");?>" class="Notification" style="text-decoration:none"><span>Income Ranges</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="CountryNames") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageCountry");?>" class="Notification" style="text-decoration:none"><span>Country Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageDistrict") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/DistrictNames/ManageDistrict");?>" class="Notification" style="text-decoration:none"><span>District Names</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageState") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/StateNames/ManageState");?>" class="Notification" style="text-decoration:none"><span>State Names</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageProfileSigninFor") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/ProfileSigninFor/ManageProfileSigninFor");?>" class="Notification" style="text-decoration:none"><span>Profile Signin For</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageLanguage") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/LanguageNames/ManageLanguage");?>" class="Notification" style="text-decoration:none"><span>Language Names</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageMartialStatus") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/MartialStatus/ManageMartialStatus");?>" class="Notification" style="text-decoration:none"><span>Martial Status</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageBloodGroups") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/BloodGroups/ManageBloodGroups");?>" class="Notification" style="text-decoration:none"><span>Blood Groups</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageComplexions") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Complexions/ManageComplexions");?>" class="Notification" style="text-decoration:none"><span>Complexions</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageBodyTypes") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/BodyTypes/ManageBodyTypes");?>" class="Notification" style="text-decoration:none"><span>Body Types</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageDiets") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Diets/ManageDiets");?>" class="Notification" style="text-decoration:none"><span>Diets</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageHeights") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Heights/ManageHeights");?>" class="Notification" style="text-decoration:none"><span>Heights</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageWeights") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Weights/ManageWeights");?>" class="Notification" style="text-decoration:none"><span>Weights</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageOccupations") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Occupations/ManageOccupations");?>" class="Notification" style="text-decoration:none"><span>Occupations</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageOccupationTypes") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/OccupationTypes/ManageOccupationTypes");?>" class="Notification" style="text-decoration:none"><span>Occupation Types</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageEducationTitles") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/EducationTitles/ManageEducationTitles");?>" class="Notification" style="text-decoration:none"><span>Education Titles</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageEducationDegrees") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/EducationDegrees/ManageEducationDegrees");?>" class="Notification" style="text-decoration:none"><span>Education Degrees</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageMonsigns") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Monsigns/ManageMonsigns");?>" class="Notification" style="text-decoration:none"><span>Monsign</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageLakanam") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/Lakanam/ManageLakanam");?>" class="Notification" style="text-decoration:none"><span>Lakanam</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageBank") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/BankNames/ManageBank");?>" class="Notification" style="text-decoration:none"><span>Manage Bank Names</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageFamilyType") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/FamilyType/ManageFamilyType");?>" class="Notification" style="text-decoration:none"><span>Family Type</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageFamilyValue") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/FamilyValue/ManageFamilyValue");?>" class="Notification" style="text-decoration:none"><span>Family Value</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageAffluence") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/FamilyAffluence/ManageAffluence");?>" class="Notification" style="text-decoration:none"><span>Family Affluence</span></a>
                                        </li> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="ManageSequenceMaster") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("Settings/Masters/SequenceMaster/ManageSequenceMaster");?>" class="Notification" style="text-decoration:none"><span>Sequence Master</span></a>
                                        </li> 
                                    </ul>
                                </div>
                            </div>