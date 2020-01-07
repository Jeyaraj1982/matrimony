<?php
    $page="FranchiseeInfo";
    $response = $webservice->getData("Franchisee","GetFranchiseeInformation");
    $Franchisee=$response['data']['Franchisee'];
    $FranchiseeStaff=$response['data']['FranchiseeStaff'];
	$FranchiseeBanks      = $response['data']['PrimaryBankAccount'];
?>
<?php include_once("settings_header.php");?>
	<div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Franchisee Info</h4>
		<?php if($FranchiseeStaff['IsAdmin']==1) { ?>
        <div class="form-group row">
            <div class="col-sm-3"><small>Franchisee Code</small></div>
            <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee['FranchiseeCode'];?></small></div>
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>Franchisee Name</small></div>
		  <div class="col-sm-9"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee['FranchiseName'];?></small></div>
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>Franchisee Email Id</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['ContactEmail'];?></small></div>
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>Mobile Number</small></div>
		  <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Franchisee['ContactNumberCountryCode'];?>-<?php echo $Franchisee['ContactNumber'];?></small></div>
		</div>
		<?php if(strlen($Franchisee['ContactWhatsapp'])>0){ ?>
		<div class="form-group row">
		 <div class="col-sm-3"><small>Whatsapp Number </small></div>
		  <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Franchisee['ContactWhatsappCountryCode'];?>-<?php echo $Franchisee['ContactWhatsapp'];?></small></div>
		</div>
		<?php } if(strlen($Franchisee['ContactLandline'])>0){ ?>
		<div class="form-group row">
		  <div class="col-sm-3"><small>Landline Number</small></div>
		  <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Franchisee['LandlineCountryCode'];?>-<?php echo $Franchisee['LandlineStdCode'];?>-<?php echo $Franchisee['ContactLandline'];?></small></div>
		</div>
		<?php } ?>
		<div class="form-group row">
			<div class="col-sm-3"><small>Address</small></div>
			<div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine1'];?> <?php if(strlen($Franchisee['BusinessAddressLine2'])>0){ ?>,<?php echo $Franchisee['BusinessAddressLine2'];?> <?php } if(strlen($Franchisee['BusinessAddressLine3'])>0){ ?>,<?php echo $Franchisee['BusinessAddressLine3']; }?> </small></div> 
		</div> 
		<div class="form-group row"> 
		   <div class="col-sm-3"><small>Land Mark</small></div> 
		   <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['Landmark'];?></small></div>
		</div>						
		<div class="form-group row">
		   <div class="col-sm-3"><small>City Name</small></div> 
		   <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['CityName'];?></small></div>
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>District Name</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['DistrictName'];?></small></div> 
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>State Name</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['StateName'];?></small></div>
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>Country Name</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['CountryName'];?></small></div> 
		</div>
		<div class="form-group row">
		  <div class="col-sm-3"><small>PinCode</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['PinCode'];?></small></div>
		</div>
		<div class="form-group row"> 
		  <div class="col-sm-3"><small>Plan</small></div>
		  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['Plan'];?></small></div> 
		</div>
		<br>
		<h4 class="card-title">Bank Account Details</h4>
	   <table class="table table-bordered">
			<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
				<tr>
					<th>Bank Name</th>
					<th>A/C Name</th>
					<th>A/C Number</th>
					<th>IFS Code</th>
					<th>Type</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($FranchiseeBanks as $FranchiseeBank) { ?>
				<tr>    
					<td><?php echo $FranchiseeBank['BankName'];?></td>
					<td><?php echo $FranchiseeBank['AccountName'];?></td>
					<td><?php echo $FranchiseeBank['AccountNumber'];?></td>
					<td><?php echo $FranchiseeBank['IFSCode'];?></td>
					<td><?php echo $FranchiseeBank['AccountType'];?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php } else { ?>
			<div class="form-group row">
				<div class="col-sm-3"><small>Franchisee Name</small></div>
				<div class="col-sm-9"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee['FranchiseName'];?></small></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><small>Address</small></div>
				<div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine1'];?> <?php if(strlen($Franchisee['BusinessAddressLine2'])>0){ ?>,<?php echo $Franchisee['BusinessAddressLine2'];?> <?php } if(strlen($Franchisee['BusinessAddressLine3'])>0){ ?>,<?php echo $Franchisee['BusinessAddressLine3']; }?> </small></div> 
			</div> 
			<div class="form-group row"> 
			   <div class="col-sm-3"><small>Land Mark</small></div> 
			   <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['Landmark'];?></small></div>
			</div>						
			<div class="form-group row">
			   <div class="col-sm-3"><small>City Name</small></div> 
			   <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['CityName'];?></small></div>
			</div>
			<div class="form-group row">
			  <div class="col-sm-3"><small>District Name</small></div>
			  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['DistrictName'];?></small></div> 
			</div>
			<div class="form-group row">
			  <div class="col-sm-3"><small>State Name</small></div>
			  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['StateName'];?></small></div>
			</div>
			<div class="form-group row">
			  <div class="col-sm-3"><small>Country Name</small></div>
			  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['CountryName'];?></small></div> 
			</div>
			<div class="form-group row">
			  <div class="col-sm-3"><small>PinCode</small></div>
			  <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee['PinCode'];?></small></div>
			</div>
		<?php } ?>
	</div>
              
<?php include_once("settings_footer.php");?>                   