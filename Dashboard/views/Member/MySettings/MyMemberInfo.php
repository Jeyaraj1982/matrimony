<?php
    $page="MyMemberInfo";
    $response =$webservice->getData("Member","GetMemberInfo");
    $Member=$response['data'];
    $CountryCodes=$Member['Country']; 
?>
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Member Info</h4>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Member ID</small> </div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Member Name</small> </div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Gender</small> </div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['Sex'];?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Mobile Number</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php if($Member['IsMobileVerified']==0){ ?>+<?php echo trim($Member['CountryCode']);?>-<?php echo $Member['MobileNumber'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">Verify</a><?php } else {?>+<?php echo trim($Member['CountryCode']);?>-<?php echo $Member['MobileNumber'];?>&nbsp;&nbsp;<img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php }?></small></div>
            <div class="col-sm-2" style="margin-right: -47px;"><small>Email ID</small></div>
            <div class="col-sm-5">:&nbsp;<small style="color:#737373;"><?php if($Member['IsEmailVerified']==0){ ?><?php echo  $Member['EmailID'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">Verify</a><?php } else{ ?><?php echo  $Member['EmailID'];?>&nbsp;&nbsp;<img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php }?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Created on</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                                    
        </div>
        <div class="col-sm-12" style="text-align:left;color:blue;padding:20px;padding-left:0px;">
            <a href="<?php echo GetUrl("MySettings/EditMemberInfo");?>"><small style="font-weight:bold;text-decoration:underline">Edit Information</small></a>                                                                                                                                                  
        </div>
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   