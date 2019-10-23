<?php
$mainlink="Search";
$page="BasicSearch";
$Info = $webservice->GetBasicSearchElements();   
?>
<?php                   
  if (isset($_POST['searchBtn'])) {  
  print_r($_POST);
    }
?>   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<link href='<?php echo SiteUrl?>assets/css/BsMultiSelect.css' rel='stylesheet' type='text/css'>
<script src="<?php echo SiteUrl?>assets/js/BsMultiSelect.js" type='text/javascript'></script>
<style>
.c-menu {height:200px;overflow:auto;width:200px;}
.badge {padding: 0px 10px !important;background: #f1f1f1 !important;border: 1px solid #ccc !important;color: #888 !important;margin-right:5px;margin-top:2px;margin-bottom:2px;}
.badge:hover {padding: 0px 10px !important;background: #e5e5e5 !important;border: 1px solid #ccc !important;color: #888 !important;}
.badge .close {margin-left:8px;}
div, label,a {font-family:'Roboto' !important;}   
</style>
<?php include_once("topmenu.php");?>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body" style="padding-top: 1.25rem;padding-bottom: 1.25rem;padding-left:0px;padding-right:0px">
          <form method="post" action="">
        <div class="container"  id="sp">
        <div class="col-sm-7" style="padding-left:3px">
            <div class="form-group row">
             <div class="col-sm-3" align="left">Age</div>
             <div class="col-sm-2" align="left" style="width:100px">
                <select class="form-control" data-live-search="true" id="age" name="age">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
            <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>
            <div class="col-sm-2" align="left" style="width:100px">
             <select class="form-control" data-live-search="true" id="toage"  name="toage">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
             </div>
            </div>
            <div class="form-group row">
             <div class="col-sm-3" align="left">Marital Status</div>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="MaritalStatus" name="MaritalStatus[]" style="display: none;" multiple="multiple"> 
                    <option value="All">All</option>
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
             <div class="col-sm-3" align="left">Religion</div>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="Religion" name="Religion[]" style="display: none;" multiple="multiple"> 
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
             
            <div class="form-group row">
             <div class="col-sm-3" align="left">Community</div>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="Community" name="Community[]" style="display: none;" multiple="multiple"> 
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Community'] as $Community) { ?>
                    <option value="<?php echo $Community['SoftCode'];?>" <?php echo ($_POST['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Community['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
                <div class="col-sm-12">
                <?php $response = $webservice->getData("Member","GetMemberInfo"); 
               // print_r($response);
                ?>
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
<script>
      $("#MaritalStatus").dashboardCodeBsMultiSelect();
      $("#Religion").dashboardCodeBsMultiSelect();
      $("#Community").dashboardCodeBsMultiSelect();
</script>

            