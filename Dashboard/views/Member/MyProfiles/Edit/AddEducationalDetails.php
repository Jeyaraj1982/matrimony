<?php
    $page="EducationDetails";
    if (isset($_POST['BtnSave'])) {
        
        $response = $webservice->getData("Member","AddEducationalDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="">
                               <div style="height: 315px;">
                     <h4 class="card-title">Educational Details</h4>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education</label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="Educationdetails">
                                <option value="" label="Select">Select</option>
                                <option value="Doctorate" label="Doctorate">Doctorate</option>
                                <option value="Masters" label="Masters" selected="selected">Masters</option>
                                <option value="Honours degree" label="Honours degree">Honours degree</option>
                                <option value="Bachelors" label="Bachelors">Bachelors</option>
                                <option value="Undergraduate" label="Undergraduate">Undergraduate</option>
                                <option value="Associates degree" label="Associates degree">Associates degree</option>
                                <option value="Diploma" label="Diploma">Diploma</option>
                                <option value="High school" label="High school">High school</option>
                                <option value="Less than high school" label="Less than high school">Less than high school</option>
                                <option value="Trade school" label="Trade school">Trade school</option>
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education Degree</label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="EducationDegree">
                                <option value="" label="Select">Select</option>
                                <option value="Advertising/ Marketing" label="Advertising/ Marketing">Advertising/ Marketing</option>
                                <option value="Administrative services" label="Administrative services">Administrative services</option>
                                <option value="Architecture" label="Architecture">Architecture</option>
                                <option value="Armed Forces" label="Armed Forces">Armed Forces</option>
                                <option value="Arts" label="Arts" selected="selected">Arts</option>
                                <option value="Commerce" label="Commerce">Commerce</option>
                                <option value="Computers/ IT" label="Computers/ IT">Computers/ IT</option>
                                <option value="Education" label="Education">Education</option>
                                <option value="Engineering/ Technology" label="Engineering/ Technology">Engineering/ Technology</option>
                                <option value="Fashion" label="Fashion">Fashion</option>
                                <option value="Finance" label="Finance">Finance</option>
                                <option value="Fine Arts" label="Fine Arts">Fine Arts</option>
                                <option value="Home Science" label="Home Science">Home Science</option>
                                <option value="Law" label="Law">Law</option>
                                <option value="Management" label="Management">Management</option>
                                <option value="Medicine" label="Medicine">Medicine</option>
                                <option value="Nursing/ Health Sciences" label="Nursing/ Health Sciences">Nursing/ Health Sciences</option>
                                <option value="Office administration" label="Office administration">Office administration</option>
                                <option value="Science" label="Science">Science</option>
                                <option value="Shipping" label="Shipping">Shipping</option>
                                <option value="Travel &amp; Tourism" label="Travel &amp; Tourism">Travel &amp; Tourism</option>
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-8"><input type="text" class="form-control" name="education" id="education"></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:right">
                                <?php echo $errormessage;?><?php echo $successmessage;?> 
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:right">
                                <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">add</button>
                            </div>
                        </div>
                </div>
                </form>
                

</div>
<?php include_once("settings_footer.php");?>      
             