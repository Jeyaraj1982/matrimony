 
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

}
.errorstring{
	color:red;
}
</style>
<?php
    $isShowSlider = false;
    $layout=0;
    include_once("includes/header.php");
?>  <br><br><br>
          
         
         <section class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <div class="page-main">
                            <div class="article-detail">
                            <?php 
include_once(application_config_path);
$Info = $webservice->getData("Member","GetAdvancedSearchElements"); 

  ?>
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
<form method="post" action="SearchResult" onsubmit="return submitSearch();">                                                                 
<div class="col-12 grid-margin">
    <div class="card" style="border:none">
        <div class="card-body">
        <h2>Advance Search</h2><br>
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group row">
                       <div class="col-sm-3">Looking For</div>
                                <div class="col-sm-8">
                                     <select class="form-control" id="LookingFor"  name="LookingFor">
                                            <option value="SX001">Groom</option>
                                            <option value="SX002">Bride</option>
                                        </select> 
                                </div>
                       </div>
                    <div class="form-group row">
                       <div class="col-sm-3">Age</div>
                                <div class="col-sm-3">
                                    <select name="age" id="age" class="form-control" >
                                             <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">To</div>
                                <div class="col-sm-3">
                                    <select name="toage" id="toage" class="form-control" >
                                             <?php for($i=19;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
									<span class="errorstring" id="Errtoage"><?php echo isset($Errtoage)? $Errtoage : "";?></span>   
                                </div>
                       </div>
					   <div class="form-group row">
                         <div class="col-sm-3">Marital Status</div>
						<div class="col-sm-8">
							<select class="form-control" id="MaritalStatus" name="MaritalStatus[]" size="5" multiple="multiple">
							<option value="All">All</option>
							<?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
								<option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
							<?php } ?>
							</select> 
                              <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>     							
						</div> 
					</div>
                    <div class="form-group row">
                         <div class="col-sm-3">Religion</div>
                                <div class="col-sm-8">
                                     <select class="form-control" id="Religion"  name="Religion[]" size="5" multiple="multiple">
                                            <option value="All">All</option>
                                            <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                                            <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                                            <?php } ?>
                                        </select>
                                    <span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>										
                                </div>
                    </div>
                    <div class="form-group row">
                         <div class="col-sm-3">Caste</div>
                                <div class="col-sm-8">
                                    <select class="form-control" id="Caste"  name="Caste[]" size="5" multiple="multiple">
                                        <option value="All">All</option>
                                            <?php foreach($Info['data']['Caste'] as $Caste) { ?>
                                        <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                                            <?php } ?>
                                        </select> 
										<span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>    
                         </div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Income Range</div>
						<div class="col-sm-8">
							<select class="form-control" id="IncomeRange"  name="IncomeRange[]" size="5" multiple="multiple">
								 <?php foreach($Info['data']['IncomeRange'] as $IncomeRange) { ?>
									<option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo ($_POST['IncomeRange']==$IncomeRange['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $IncomeRange['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrIncomeRange"><?php echo isset($ErrIncomeRange)? $ErrIncomeRange : "";?></span>
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Occupation</div>
						<div class="col-sm-8">
							<select class="form-control" id="Occupation"  name="Occupation[]" size="5" multiple="multiple">
								 <?php foreach($Info['data']['Occupation'] as $Occupation) { ?>
									<option value="<?php echo $Occupation['SoftCode'];?>" <?php echo ($_POST['Occupation']==$Occupation['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Occupation['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrOccupation"><?php echo isset($ErrOccupation)? $ErrOccupation : "";?></span>
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Family Type</div>
						<div class="col-sm-8">
							<select class="form-control" id="FamilyType"  name="FamilyType[]" size="2" multiple="multiple">
								 <?php foreach($Info['data']['FamilyType'] as $FamilyType) { ?>
									<option value="<?php echo $FamilyType['SoftCode'];?>" <?php echo ($_POST['FamilyType']==$FamilyType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $FamilyType['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrFamilyType"><?php echo isset($ErrFamilyType)? $ErrFamilyType : "";?></span>    
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Working In Country</div>
						<div class="col-sm-8">
							<select class="form-control" id="WorkingPlace"  name="WorkingPlace[]" size="5" multiple="multiple">
								 <?php foreach($Info['data']['Country'] as $WorkingPlace) { ?>
									<option value="<?php echo $WorkingPlace['SoftCode'];?>" <?php echo ($_POST['WorkingPlace']==$WorkingPlace['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $WorkingPlace['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrWorkingPlace"><?php echo isset($ErrWorkingPlace)? $ErrWorkingPlace : "";?></span>
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Diet</div>
						<div class="col-sm-8">
							<select class="form-control" id="Diet"  name="Diet[]" size="5" multiple="multiple">
								 <?php foreach($Info['data']['Diet'] as $Diet) { ?>
									<option value="<?php echo $Diet['SoftCode'];?>" <?php echo ($_POST['Diet']==$Diet['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Diet['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrDiet"><?php echo isset($ErrDiet)? $ErrDiet : "";?></span>
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Smoke</div>
						<div class="col-sm-8">
							<select class="form-control" id="Smoke"  name="Smoke[]" size="3" multiple="multiple">
								 <?php foreach($Info['data']['SmokingHabit'] as $Smoke) { ?>
									<option value="<?php echo $Smoke['SoftCode'];?>" <?php echo ($_POST['Smoke']==$Smoke['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Smoke['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrSmoke"><?php echo isset($ErrSmoke)? $ErrSmoke : "";?></span>    
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Drink</div>
						<div class="col-sm-8">
							<select class="form-control" id="Drink"  name="Drink[]" size="3" multiple="multiple">
								 <?php foreach($Info['data']['DrinkingHabit'] as $Drink) { ?>
									<option value="<?php echo $Drink['SoftCode'];?>" <?php echo ($_POST['Drink']==$Drink['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Drink['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrDrink"><?php echo isset($ErrDrink)? $ErrDrink : "";?></span>  
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Body Type</div>
						<div class="col-sm-8">
							<select class="form-control" id="BodyType"  name="BodyType[]" size="4" multiple="multiple">
								 <?php foreach($Info['data']['BodyType'] as $BodyType) { ?>
									<option value="<?php echo $BodyType['SoftCode'];?>" <?php echo ($_POST['BodyType']==$BodyType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $BodyType['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrBodyType"><?php echo isset($ErrBodyType)? $ErrBodyType : "";?></span>   
						</div> 
                    </div>
					<div class="form-group row">
                         <div class="col-sm-3">Skin Type</div>
						<div class="col-sm-8">
							<select class="form-control" id="Complexion"  name="Complexion[]" size="5" multiple="multiple">
								 <?php foreach($Info['data']['SkinType'] as $Complexion) { ?>
									<option value="<?php echo $Complexion['SoftCode'];?>" <?php echo ($_POST['Complexion']==$Complexion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Complexion['CodeValue'];?></option>
								<?php } ?>
							 </select> 
							 <span class="errorstring" id="ErrComplexion"><?php echo isset($ErrComplexion)? $ErrComplexion : "";?></span>
						</div> 
                    </div>
				
                        <button type="submit" class="btn btn-primary" name="AdvanceSearch">Search</button>
                    
                    
              </div>
              </div> 
         </div>
</div>
</div>
</form>
</div>
               
                            </div>
                        </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                        <aside id="sidebar">
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">General Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="search.php">Basic Search</a></li>
                                        <li><a href="advancesearch.php">Advance Search</a></li>
                                        <li><a href="searchbyid">Search By ID</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">Matrimony Service</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Wedding Directory</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
         
           <?php include_once("includes/header.php");;?>