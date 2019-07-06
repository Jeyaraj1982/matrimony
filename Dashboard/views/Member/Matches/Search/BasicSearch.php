<?php
$mainlink="Search";
$page="BasicSearch";
$Info = $webservice->GetBasicSearchElements();
?>
<?php                   
  if (isset($_POST['searchBtn'])) {  
    $response = $webservice->SaveBasicSearch($_POST);
    print_r($response);
    if ($response['status']=="success") {
         $successmessage = $response['message']; 
    } else {
        $errormessage = $response['message']; 
    }
    }
?>  
<style>
div, label,a {font-family:'Roboto' !important;}
</style>
<?php include_once("topmenu.php");?>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body" style="padding-top: 1.25rem;padding-bottom: 1.25rem;padding-left:0px;padding-right:0px">
          <form method="post" action="BasicSearchResult">
        <div class="container"  id="sp">
        <div class="col-sm-7" style="padding-left:3px">
            <div class="form-group row">
             <div class="col-sm-4" align="left">Age</div>
             <div class="col-sm-2" align="left" style="width:100px">
                <select class="selectpicker form-control" data-live-search="true" id="age" name="age">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
            <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>
            <div class="col-sm-2" align="left" style="width:100px">
             <select class="selectpicker form-control" data-live-search="true" id="toage"  name="toage">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
             </div>
            </div>
            <div class="form-group row">
             <div class="col-sm-4" align="left">Marital Status</div>
             <div class="col-sm-5" align="left">
                <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus"  name="MaritalStatus">
                    <option value="All">All</option>
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
             <div class="col-sm-4" align="left">Religion</div>
             <div class="col-sm-5" align="left">
                <select class="selectpicker form-control" data-live-search="true" id="Religion"  name="Religion">
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
             
            <div class="form-group row">
             <div class="col-sm-4" align="left">Community</div>
             <div class="col-sm-5" align="left">
                <select class="selectpicker form-control" data-live-search="true" id="Community"  name="Community"> 
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Community'] as $Community) { ?>
                    <option value="<?php echo $Community['SoftCode'];?>" <?php echo ($_POST['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Community['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
                <div class="col-sm-12">
                <?php $response = $webservice->getData("Member","GetMemberInfo"); ?>
                <?php  if ($response['data']['IsMobileVerified']==0) { ?>
                <a href="javascript:void(0)" onclick="MobileNumberVerification()" class="btn btn-primary">Search</a>
            <?php } else if ($response['data']['IsEmailVerified']==0) { ?>
                <a href="javascript:void(0)" onclick="EmailVerification()" class="btn btn-primary">Search</a>
            <?php } else{ ?>
                <button type="submit" name="searchBtn" class="btn btn-primary" style="font-family:roboto">Search</button>
            <?php }?></div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
</div>

            