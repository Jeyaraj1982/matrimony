<?php
    $page="FrStaffInfo";
    $response = $webservice->getData("Franchisee","GetFranchiseeInfo");
    $Franchisee=$response['data'];
    $CountryCodes=$Member['Country']; 
?>
<?php include_once("settings_header.php");?>

<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Information</h4>
        <div class="form-group row">
            <div class="col-sm-3"><small>Staff Code</small> </div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['StaffCode'];?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><small>Staff Name</small> </div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['PersonName'];?></small></div>
        </div>
		<div class="form-group row">
            <div class="col-sm-3"><small>Father's Name</small> </div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['FatherName'];?></small></div>
        </div>
		<div class="form-group row">
            <div class="col-sm-3"><small>Date of birth</small> </div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo PutDate($Franchisee['DateofBirth']);?></small></div>
        </div>                                                                                                                                
        <div class="form-group row">
            <div class="col-sm-3"><small>Gender</small> </div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['Sex'];?></small></div>
        </div>
		<div class="form-group row">
		   <div class="col-sm-3"><small>Email ID</small></div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php if($Franchisee['IsEmailVerified']==0){ ?><?php echo  $Franchisee['EmailID'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="EmailVerificationForm()"><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: -6px;margin-left: 9px;width:16px;height:16px;-webkit-filter: grayscale(100%);filter: grayscale(100%);">&nbsp;Verfiy</a><?php } else{ ?><?php echo  $Franchisee['EmailID'];?><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: -4px;margin-left:10px;width:16px;height:16px"><?php }?></small></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><small>Mobile Number</small></div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;">+<?php if($Franchisee['IsMobileVerified']==0) { ?><?php echo $Franchisee['CountryCode'];?>-<?php echo $Franchisee['MobileNumber'];?>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerificationForm()"><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: -6px;margin-left: 9px;width:16px;height:16px;-webkit-filter: grayscale(100%);filter: grayscale(100%);">&nbsp;Verfiy</a><?php } else {?><?php echo $Franchisee['CountryCode'];?>-<?php echo $Franchisee['MobileNumber'];?><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: -4px;margin-left: 9px;width:16px;height:16px"><?php }?></small></div>
        </div>
		<?php if(strlen($Franchisee['WhatsappNumber'])>0 ){ ?>
		<div class="form-group row">
            <div class="col-sm-3"><small>Whats Number</small></div>
            <div class="col-sm-9">:&nbsp;<small style="color:#737373;">+<?php echo $Franchisee['WhatsappNumberCountryCode'];?>-<?php echo $Franchisee['WhatsappNumber'];?></small></div>
        </div>
		<?php } ?>
		<div class="form-group row">
			<div class="col-sm-3"><small>Address</small></div>
			<div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['AddressLine1'];?> <?php if(strlen($Franchisee['AddressLine2'])>0){ ?>,<?php echo $Franchisee['AddressLine2'];?> <?php } if(strlen($Franchisee['AddressLine3'])>0){ ?>,<?php echo $Franchisee['AddressLine3']; }?> </small></div> 
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><small>ID Proof</small></div>
			<div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['IDProof'];?>&nbsp;( <?php echo $Franchisee['IDProofNumber'];?> )</small></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><small>Staff Role</small></div>
			<div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['UserRole'];?></small></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><small>Login Name</small></div>
			<div class="col-sm-9">:&nbsp;<small style="color:#737373;"><?php echo $Franchisee['LoginName'];?></small></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-3"><small>Created on</small></div>
            <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo  putDateTime($Franchisee['CreatedOn']);?></small></div>
        </div>
        <!--<div class="col-sm-12" style="text-align:left;color:blue;padding:20px;padding-left:0px;">
            <a href="<?php echo GetUrl("MySettings/EditFranchiseeInfo");?>"><small style="font-weight:bold;text-decoration:underline">Edit Information</small></a>
        </div>-->
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   