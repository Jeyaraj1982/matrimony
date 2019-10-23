<?php
$mainlink="Search";
$page="AdvancedSearch";
$Info = $webservice->GetAdvancedSearchElements(); 
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
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
          <form method="post" action="" >
        <div class="container"  id="sp"> 
             <div class="col-sm-6" style="margin-left: -43px;">
            <div class="form-group row">
             <div class="col-sm-4" align="left">Age</div>
             <div class="col-sm-3" align="left">
                <select class="selectpicker form-control" data-live-search="true" id="age"  name="age">
                    <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
            <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>      
            <div class="col-sm-3" align="left">
             <select class="selectpicker form-control" data-live-search="true" id="toage"  name="toage">
                   <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
             </div>
            </div>
            <div class="form-group row">
             <div class="col-sm-4" align="left">Height</div>
             <div class="col-sm-3" align="left" >
             <select class="form-control" id="Height" name="Height[]" style="display: none;" multiple="multiple"> 
                    <?php foreach($Info['data']['Height'] as $Height) { ?>
                        <option value="<?php echo $Height['SoftCode'];?>" <?php echo ($_POST['Height']==$Height['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Height['CodeValue'];?></option>
                    <?php } ?>
                </select>          
            </div>
            <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>
            <div class="col-sm-3" align="left">
                <select class="form-control" id="ToHeight" name="ToHeight[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['Height'] as $Height) { ?>
                        <option value="<?php echo $Height['SoftCode'];?>" <?php echo ($_POST['ToHeight']==$Height['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Height['CodeValue'];?></option>
                    <?php } ?>
                </select>            
             </div>
            </div>
            
            <div class="form-group row">
             <div class="col-sm-4" align="left">Marital Status</div>
             <div class="col-sm-7" align="left">
                <select class="form-control" id="MaritalStatus" name="MaritalStatus[]" style="display: none;" multiple="multiple">
                    <option value="All">All</option>
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>           
             </div>
            </div> 
            <div class="form-group row">
             <div class="col-sm-4" align="left">Religion</div>
             <div class="col-sm-7" align="left">
                <select class="form-control" id="Religion" name="Religion[]" style="display: none;" multiple="multiple">
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
             <div class="col-sm-4" align="left">Community</div>
             <div class="col-sm-7" align="left">
                <select class="form-control" id="Community" name="Community[]" style="display: none;" multiple="multiple">
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Community'] as $Community) { ?>
                    <option value="<?php echo $Community['SoftCode'];?>" <?php echo ($_POST['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Community['CodeValue'];?></option>
                    <?php } ?>
                </select>       
            </div>
            </div> 
            <hr>
            <b style="font-size:15px">Life Style &amp; Appearances</b><br><br><br>
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Diet</div>
                    <div class="col-sm-7" align="left">
                    <select class="form-control" id="Diet" name="Diet[]" style="display: none;" multiple="multiple">
                        <option value="All">All</option>
                        <?php foreach($Info['data']['Diet'] as $d) {?>
                        <option value="<?php echo $d['SoftCode'];?>" <?php echo ($_POST['Diet']==$d['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $d['CodeValue'];?></option>
                        <?php } ?>
                    </select>
                    </div>
                 </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Smoke</div>
                    <div class="col-sm-7" align="left">
                    <select class="form-control" id="Smoke" name="Smoke[]" style="display: none;" multiple="multiple">
                        <option value="All">All</option>
                        <?php foreach($Info['data']['SmokingHabit'] as $S) {?>
                        <option value="<?php echo $S['SoftCode'];?>" <?php echo ($_POST['Smoke']==$S['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $S['CodeValue'];?></option>
                        <?php }?>
                    </select>       
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Drink</div>
                    <div class="col-sm-7" align="left">
                    <select class="form-control" id="Drink" name="Drink[]" style="display: none;" multiple="multiple">
                        <option value="All">All</option>
                        <?php foreach($Info['data']['DrinkingHabit'] as $Drink) {?>
                        <option value="<?php echo $Drink['SoftCode'];?>" <?php echo ($_POST['Drink']==$Drink['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Drink['CodeValue'];?></option>
                        <?php }?>
                    </select>               
                    </div>  
                </div>
                <div class="form-group row">                                                                                        
                    <div class="col-sm-4" align="left">Body Type</div>
                    <div class="col-sm-7" align="left">
                    <select class="form-control" id="BodyType" name="BodyType[]" style="display: none;" multiple="multiple">
                       <option value="All">All</option>
                        <?php foreach($Info['data']['BodyType'] as $BodyType) {?>
                        <option value="<?php echo $BodyType['SoftCode'];?>" <?php echo ($_POST['BodyType']==$BodyType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $BodyType['CodeValue'];?></option>
                        <?php }?>
                    </select>     
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Skin Type</div>
                    <div class="col-sm-7" align="left">
                    <select class="form-control" id="Complexion" name="Complexion[]" style="display: none;" multiple="multiple">
                        <option value="All">All</option>
                        <?php foreach($Info['data']['SkinType'] as $Complexion) {?>
                        <option value="<?php echo $Complexion['SoftCode'];?>" <?php echo ($_POST['Complexion']==$Complexion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Complexion['CodeValue'];?></option>
                        <?php }?>
                    </select>
                    </div>
                </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-12"><button type="submit" name="searchBtn" class="btn btn-primary" style="font-family:roboto">Search</button></div>
            </div>
              </div>
            </form> 
        </div>
    </div>
</div>
<script>
      $("#Height").dashboardCodeBsMultiSelect();
      $("#ToHeight").dashboardCodeBsMultiSelect();
      $("#MaritalStatus").dashboardCodeBsMultiSelect();
      $("#Religion").dashboardCodeBsMultiSelect();
      $("#Community").dashboardCodeBsMultiSelect();
      $("#Diet").dashboardCodeBsMultiSelect();
      $("#Smoke").dashboardCodeBsMultiSelect();
      $("#Drink").dashboardCodeBsMultiSelect();
      $("#BodyType").dashboardCodeBsMultiSelect();
      $("#Complexion").dashboardCodeBsMultiSelect();
</script>
