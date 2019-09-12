<?php
    $page="MyMemberInfo";
    $response = $webservice->GetMemberInfo();
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
            <div class="col-sm-3" style="margin-right: -47px;"><small>Sex</small> </div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['Sex'];?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Mobile Number</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php if($Member['IsMobileVerified']==0){ ?>+<?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">Verfiy</a><?php } else {?>+<?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="15%" style="margin-top: -12px;margin-left: 9px;"><?php }?></small></div>
            <div class="col-sm-2" style="margin-right: -47px;"><small>Email ID</small></div>
            <div class="col-sm-5">:&nbsp;<small style="color:#737373;"><?php if($Member['IsEmailVerified']==0){ ?><?php echo  $Member['EmailID'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">Verfiy</a><?php } else{ ?><?php echo  $Member['EmailID'];?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="10%" style="margin-top: -11px;margin-left:10px;"><?php }?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3" style="margin-right: -47px;"><small>Created on</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
            <div class="col-sm-2" style="margin-right: -47px;"><small>Status</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo  ($Member['IsActive']==1) ? "Active" : "Deactive"; ?></small></div>                               
        </div>
        <div class="col-sm-12" style="text-align:left;color:blue;padding:20px;padding-left:0px;">
            <a href="<?php echo GetUrl("MySettings/EditMemberInfo");?>"><small style="font-weight:bold;text-decoration:underline">Edit Information</small></a>                                                                                                                                                  
        </div>
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   