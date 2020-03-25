<?php
$mainlink="Search";
$page="BasicSearch";
$Info = $webservice->getData("Franchisee","GetBasicSearchElements");  
?>
<?php                   
  if (isset($_POST['searchBtn'])) {  
      
  $_POST['MaritalStatus']=implode(",",$_POST['MaritalStatus']);
  $_POST['Religion']=implode(",",$_POST['Religion']);
  $_POST['Caste']=implode(",",$_POST['Caste']);
  
  $response = $webservice->getData("Franchisee","AddMemberBasicSearchDetails",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='BasicSearchResult/".$response['data']['ReqID'].".htm?Req=BasicSearchResult'</script>";
            // $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
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
<script>
function submitSearch() {
                         $('#Errtoage').html("");
                         $('#Errage').html("");
                         $('#ErrMaritalStatus').html("");
                         $('#ErrReligion').html("");
                         $('#ErrCaste').html("");

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
                            
                        if (ErrorCount==0) {
                            return true;                        
                        } else{
                            return false;
                        }
                        
    
    
}
</script>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body" style="padding-top: 1.25rem;padding-bottom: 1.25rem;padding-left:0px;padding-right:0px;width:770px" >
          <form method="post" action="" onsubmit="return submitSearch();">
        <div class="container"  id="sp">
        <div class="col-sm-7" style="padding-left:3px">
            <div class="form-group row">
              <label for="age" class="col-sm-2 col-form-label">Age</label>
             <div class="col-sm-2" align="left" style="width:100px">
                <select class="form-control" data-live-search="true" id="age" name="age">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
             <label for="toage" class="col-sm-1 col-form-label">To</label>
            <div class="col-sm-6" align="left" style="width:100px">
             <select class="form-control" data-live-search="true" id="toage"  name="toage" style="width: 82px;">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select> 
                 <span class="errorstring" id="Errtoage"><?php echo isset($Errtoage)? $Errtoage : "";?></span>          
             </div>
            </div>
            <div class="form-group row">
             <label for="Sex" class="col-sm-2 col-form-label">Gender</label>
             <div class="col-sm-10" align="left">
                <select class="form-control" id="Sex" name="Sex"> 
                    <?php foreach($Info['data']['Sex'] as $Sex) { ?>
                    <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>           
            </div>
            </div>
            <div class="form-group row">
             <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status</label>
             <div class="col-sm-10" align="left">
                <select class="form-control" id="MaritalStatus" name="MaritalStatus[]" style="display: none;" multiple="multiple"> 
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>           
            </div>
            </div> 
            <div class="form-group row">
             <label for="Religion" class="col-sm-2 col-form-label">Religion</label>
             <div class="col-sm-10" align="left">
                <select class="form-control" id="Religion" name="Religion[]" style="display: none;" multiple="multiple"> 
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>  
                <span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>         
            </div>
            </div> 
             
            <div class="form-group row">
             <label for="Caste" class="col-sm-2 col-form-label">Caste</label>
             <div class="col-sm-10" align="left">
                <select class="form-control" id="Caste" name="Caste[]" style="display: none;" multiple="multiple"> 
                    <?php foreach($Info['data']['Caste'] as $Caste) { ?>
                    <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                    <?php } ?>
                </select>   
                <span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>        
            </div>
            </div> 
            <div class="form-group row">
                <div class="col-sm-12">
                <?php $response = $webservice->getData("Franchisee","GetFranchiseeInfo"); 
               // print_r($response);
                ?>
                <?php  if ($response['data']['IsMobileVerified']==0) { ?>
                <a href="javascript:void(0)" onclick="MobileNumberVerification()" class="btn btn-primary">Search</a>
            <?php } else if ($response['data']['IsEmailVerified']==0) { ?>
                <a href="javascript:void(0)" onclick="EmailVerification()" class="btn btn-primary">Search</a>
            <?php } else{ ?>
                <button type="submit" name="searchBtn" class="btn btn-primary" style="font-family:roboto">Search Profile</button>
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
      $("#Caste").dashboardCodeBsMultiSelect();
</script>

            