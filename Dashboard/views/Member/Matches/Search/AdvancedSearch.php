<?php
$mainlink="Search";
$page="AdvancedSearch";
$Info = $webservice->getData("Member","GetAdvancedSearchElements"); 
?>
<?php                   
  if (isset($_POST['searchBtn'])) {  
  

  $_POST['MaritalStatus']=implode(",",$_POST['MaritalStatus']);
  $_POST['Religion']=implode(",",$_POST['Religion']);
  $_POST['Caste']=implode(",",$_POST['Caste']);
  $_POST['IncomeRange']=implode(",",$_POST['IncomeRange']);
  $_POST['Occupation']=implode(",",$_POST['Occupation']);
  $_POST['FamilyType']=implode(",",$_POST['FamilyType']);
  $_POST['WorkingPlace']=implode(",",$_POST['WorkingPlace']);
  $_POST['Diet']=implode(",",$_POST['Diet']);
  $_POST['Smoke']=implode(",",$_POST['Smoke']);
  $_POST['Drink']=implode(",",$_POST['Drink']);
  $_POST['BodyType']=implode(",",$_POST['BodyType']);
  $_POST['Complexion']=implode(",",$_POST['Complexion']);
  
  $response = $webservice->getData("Member","AddMemberAdvanceSearchDetails",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='AdvancedSearchResult/".$response['data']['ReqID'].".htm?Req=AdvancedSearchResult'</script>";
            // $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
  
  //api service
  //Searchid,memberid,profileid,sex,matrita,rel,community,searchname,searchrequested;
  //return id
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
 <script>
function submitSearch() {
                         $('#Errtoage').html("");
                         $('#Errage').html("");
                         $('#ErrMaritalStatus').html("");
                         $('#ErrReligion').html("");
                         $('#ErrCaste').html("");
                         $('#ErrIncomeRange').html("");
                         $('#ErrOccupation').html("");
                         $('#ErrFamilyType').html("");
                         $('#ErrWorkingPlace').html("");
                         $('#ErrDiet').html("");
                         $('#ErrSmoke').html("");
                         $('#ErrDrink').html("");
                         $('#ErrBodyType').html("");
                         $('#ErrComplexion').html("");

                         ErrorCount=0;
                         
                         if(($("#age").val() > $("#toage").val())){
                            document.getElementById("Errtoage").innerHTML="Please select greater than from age"; 
                            ErrorCount++;
                         }
                          if($('#MaritalStatus option:selected').length==0){
                            document.getElementById("ErrMaritalStatus").innerHTML="Please select MaritalStatus"; 
                             ErrorCount++;
                         }   
                         //var ReligionCount=0;
                         // $.each($("#Religion option:selected"), function(){            
                           // ReligionCount++;
                        //});

                         if ($('#Religion option:selected').length==0){
                                document.getElementById("ErrReligion").innerHTML="Please select Religion"; 
                                ErrorCount++;
                         }
                        if($('#Caste option:selected').length==0){
                            document.getElementById("ErrCaste").innerHTML="Please select Caste"; 
                             ErrorCount++;
                         }
                         if($('#IncomeRange option:selected').length==0){
                            document.getElementById("ErrIncomeRange").innerHTML="Please select IncomeRange"; 
                             ErrorCount++;
                         }
                         if($('#Occupation option:selected').length==0){
                            document.getElementById("ErrOccupation").innerHTML="Please select Occupation"; 
                             ErrorCount++;
                         }
                         if($('#FamilyType option:selected').length==0){
                            document.getElementById("ErrFamilyType").innerHTML="Please select Family Type"; 
                             ErrorCount++;
                         }
                         if($('#WorkingPlace option:selected').length==0){
                            document.getElementById("ErrWorkingPlace").innerHTML="Please select WorkingPlace"; 
                             ErrorCount++;
                         }
                         if($('#Diet option:selected').length==0){
                            document.getElementById("ErrDiet").innerHTML="Please select Diet"; 
                             ErrorCount++;
                         }
                         if($('#Smoke option:selected').length==0){
                            document.getElementById("ErrSmoke").innerHTML="Please select Smoke"; 
                             ErrorCount++;
                         }
                         if($('#Drink option:selected').length==0){
                            document.getElementById("ErrDrink").innerHTML="Please select Drink"; 
                             ErrorCount++;
                         }
                         if($('#BodyType option:selected').length==0){
                            document.getElementById("ErrBodyType").innerHTML="Please select BodyType"; 
                             ErrorCount++;
                         }
                         if($('#Complexion option:selected').length==0){
                            document.getElementById("ErrComplexion").innerHTML="Please select Complexion"; 
                             ErrorCount++;
                         }
                            
                        if (ErrorCount==0) {
                            return true;                        
                        } else{
                            return false;
                        }
                        
    
    
}
</script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
          <form method="post" action="" onsubmit="return submitSearch();">
        <div class="container"  id="sp"> 
             <div class="col-sm-6" style="margin-left: -43px;">
            <div class="form-group row">
             <label for="age" class="col-sm-3 col-form-label">Age</label>
             <div class="col-sm-3" align="left">
                <select class="form-control" data-live-search="true" id="age"  name="age">
                    <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
            <label for="toage" class="col-sm-1 col-form-label">To</label>      
            <div class="col-sm-4" align="left">
             <select class="form-control" data-live-search="true" id="toage"  name="toage" style="width:82px">
                   <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>    
                <span class="errorstring" id="Errtoage"><?php echo isset($Errtoage)? $Errtoage : "";?></span>          
             </div>
            </div>
            <div class="form-group row">
             <label for="MaritalStatus" class="col-sm-3 col-form-label">Marital Status</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="MaritalStatus" name="MaritalStatus[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>     
                <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>       
             </div>
            </div> 
            <div class="form-group row">
             <label for="Religion" class="col-sm-3 col-form-label">Religion</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="Religion" name="Religion[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>     
                 <span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>       
            </div>
            </div> 
            <div class="form-group row">
             <label for="Caste" class="col-sm-3 col-form-label">Caste</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="Caste" name="Caste[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['Caste'] as $Caste) { ?>
                    <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>    
            </div>
            </div>
            <div class="form-group row">
             <label for="IncomeRange" class="col-sm-3 col-form-label">Income Range</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="IncomeRange" name="IncomeRange[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo ($_POST['IncomeRange']==$IncomeRange['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $IncomeRange['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrIncomeRange"><?php echo isset($ErrIncomeRange)? $ErrIncomeRange : "";?></span>    
            </div>
            </div>
            <div class="form-group row">
             <label for="Occupation" class="col-sm-3 col-form-label">Occupation</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="Occupation" name="Occupation[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['Occupation'] as $Occupation) { ?>
                    <option value="<?php echo $Occupation['SoftCode'];?>" <?php echo ($_POST['Occupation']==$Occupation['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Occupation['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrOccupation"><?php echo isset($ErrOccupation)? $ErrOccupation : "";?></span>    
            </div>
            </div>
            <div class="form-group row">
             <label for="FamilyType" class="col-sm-3 col-form-label">Family Type</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="FamilyType" name="FamilyType[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['FamilyType'] as $FamilyType) { ?>
                    <option value="<?php echo $FamilyType['SoftCode'];?>" <?php echo ($_POST['FamilyType']==$FamilyType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $FamilyType['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrFamilyType"><?php echo isset($ErrFamilyType)? $ErrFamilyType : "";?></span>    
            </div>
            </div>
            <div class="form-group row">
             <label for="WorkingPlace" class="col-sm-3 col-form-label">Working In Country</label>
             <div class="col-sm-9" align="left">
                <select class="form-control" id="WorkingPlace" name="WorkingPlace[]" style="display: none;" multiple="multiple">
                    <?php foreach($Info['data']['Country'] as $WorkingPlace) { ?>
                    <option value="<?php echo $WorkingPlace['SoftCode'];?>" <?php echo ($_POST['WorkingPlace']==$WorkingPlace['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $WorkingPlace['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrWorkingPlace"><?php echo isset($ErrWorkingPlace)? $ErrWorkingPlace : "";?></span>    
            </div>
            </div> 
            <hr>
            <b style="font-size:15px">Life Style &amp; Appearances</b><br><br><br>
                <div class="form-group row">
                    <label for="Diet" class="col-sm-3 col-form-label">Diet</label>
                    <div class="col-sm-9" align="left">
                    <select class="form-control" id="Diet" name="Diet[]" style="display: none;" multiple="multiple">
                        <?php foreach($Info['data']['Diet'] as $d) {?>
                        <option value="<?php echo $d['SoftCode'];?>" <?php echo ($_POST['Diet']==$d['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $d['CodeValue'];?></option>
                        <?php } ?>
                    </select>
                    <span class="errorstring" id="ErrDiet"><?php echo isset($ErrDiet)? $ErrDiet : "";?></span>
                    </div>
                 </div>
                <div class="form-group row">
                    <label for="Smoke" class="col-sm-3 col-form-label">Smoke</label>
                    <div class="col-sm-9" align="left">
                    <select class="form-control" id="Smoke" name="Smoke[]" style="display: none;" multiple="multiple">
                        <?php foreach($Info['data']['SmokingHabit'] as $S) {?>
                        <option value="<?php echo $S['SoftCode'];?>" <?php echo ($_POST['Smoke']==$S['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $S['CodeValue'];?></option>
                        <?php }?>
                    </select> 
                    <span class="errorstring" id="ErrSmoke"><?php echo isset($ErrSmoke)? $ErrSmoke : "";?></span>      
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Drink" class="col-sm-3 col-form-label">Drink</label>
                    <div class="col-sm-9" align="left">
                    <select class="form-control" id="Drink" name="Drink[]" style="display: none;" multiple="multiple">
                        <?php foreach($Info['data']['DrinkingHabit'] as $Drink) {?>
                        <option value="<?php echo $Drink['SoftCode'];?>" <?php echo ($_POST['Drink']==$Drink['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Drink['CodeValue'];?></option>
                        <?php }?>
                    </select>   
                    <span class="errorstring" id="ErrDrink"><?php echo isset($ErrDrink)? $ErrDrink : "";?></span>            
                    </div>  
                </div>
                <div class="form-group row">                                                                                        
                    <label for="BodyType" class="col-sm-3 col-form-label">Body Type</label>
                    <div class="col-sm-9" align="left">
                    <select class="form-control" id="BodyType" name="BodyType[]" style="display: none;" multiple="multiple">
                        <?php foreach($Info['data']['BodyType'] as $BodyType) {?>
                        <option value="<?php echo $BodyType['SoftCode'];?>" <?php echo ($_POST['BodyType']==$BodyType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $BodyType['CodeValue'];?></option>
                        <?php }?>
                    </select>  
                    <span class="errorstring" id="ErrBodyType"><?php echo isset($ErrBodyType)? $ErrBodyType : "";?></span>   
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Complexion" class="col-sm-3 col-form-label">Skin Type</label>
                    <div class="col-sm-9" align="left">
                    <select class="form-control" id="Complexion" name="Complexion[]" style="display: none;" multiple="multiple">
                        <?php foreach($Info['data']['SkinType'] as $Complexion) {?>
                        <option value="<?php echo $Complexion['SoftCode'];?>" <?php echo ($_POST['Complexion']==$Complexion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Complexion['CodeValue'];?></option>
                        <?php }?>
                    </select>
                    <span class="errorstring" id="ErrComplexion"><?php echo isset($ErrComplexion)? $ErrComplexion : "";?></span>
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
      $("#Caste").dashboardCodeBsMultiSelect();
      $("#IncomeRange").dashboardCodeBsMultiSelect();
      $("#Occupation").dashboardCodeBsMultiSelect();
      $("#FamilyType").dashboardCodeBsMultiSelect();
      $("#WorkingPlace").dashboardCodeBsMultiSelect();
      $("#Diet").dashboardCodeBsMultiSelect();
      $("#Smoke").dashboardCodeBsMultiSelect();
      $("#Drink").dashboardCodeBsMultiSelect();
      $("#BodyType").dashboardCodeBsMultiSelect();
      $("#Complexion").dashboardCodeBsMultiSelect();
</script>
