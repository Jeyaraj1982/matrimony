<?php
    $Franchisee =$mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_REQUEST['Code']."'");
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Business Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Code</small></div>
                          <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee[0]['FranchiseeCode'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee[0]['FranchiseName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Email Id</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactEmail'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Mobile Number</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactNumber'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Whatsapp Number </small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactWhatsapp'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Landline Number</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactLandline'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Address</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['BusinessAddressLine1'];?></small></div> 
                        </div>                                                                               
                        <div class="form-group row">
                           <div class="col-sm-3"><small>City Name</small></div> 
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['CityName'];?></small></div>
                        </div>
                        <div class="form-group row"> 
                           <div class="col-sm-3"><small>Land Mark</small></div> 
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['Landmark'];?></small></div>
                        </div> 
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Country Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['CountryName'];?></small></div> 
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>State Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['StateName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>District Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['DistrictName'];?></small></div> 
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>PinCode</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['PinCode'];?></small></div>
                        </div>
                        <div class="form-group row"> 
                          <div class="col-sm-3"><small>Plan</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['Plan'];?></small></div> 
                        </div>
                        <div class="form-group row"> 
                          <div class="col-sm-3"><small>Status</small></div>
                          <div class="col-sm-8"><span class="<?php echo ($Franchisee[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span><small style="color:#737373;">
                          <?php 
                          if($Franchisee[0]['IsActive']==1)  {
                              echo "Active";
                          }
                          else{
                              echo "Deactive";
                          }
                          ;?></small></div> 
                        </div>
                        <a href="../MangeFranchisees" class="btn btn-success">Back</a>
                    </div>
                  </div>
                </div>
                
            <div class="col-sm-12 grid-margin" style="text-align: center;color:skyblue;">
                        <a href="../MangeFranchisees"><small style="font-weight:bold;text-decoration:underline">List of Franchisee</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Franchisees/Edit/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Franchisee</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Franchisees/BlockFranchisee/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Franchisee</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Franchisees/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div>  
</form>

<!--<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profile Information</h4>
                   <form class="form-sample">
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Person Name *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="PersonName" name="PersonName" Placeholder="Enter Person Name" value="<?php // echo (isset($_POST['PersonName']) ? $_POST['PersonName'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of birth *</label>
                          <div class="col-sm-3">
                            <input type="Date" class="form-control" id="DateofBirth" name="DateofBirth">
                          </div>
                          <label class="col-sm-3 col-form-label">Sex</label>
                          <div class="col-sm-3">
                          <select class="form-control" id="Sex"  name="Sex" value="<?php //echo (isset($_POST['Sex']) ? $_POST['Sex'] : "");?>" >
                          <option value="">Male</option>
                          <option value="">FeMale</option>
                          </select>
                          </div>
                        </div>
                      </div>
                      </div> 
                      <!--<div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Religion *</label>
                          <div class="col-sm-9">
                          <?php // $ReligionNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES'"); ?>
                          <select class="form-control" id="ReligionName"  name="ReligionName" value="">
                          <?php // foreach($ReligionNames as $ReligionName) { ?>
                         <option value="<?php // echo $ReligionName['SoftCode'];?>">
                         <?php  //echo $ReligionName['CodeValue'];?></option>
                          <?php// } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Caste *</label>
                          <div class="col-sm-9">
                          <?php // $CasteNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES'"); ?>
                          <select class="form-control" id="CasteName"  name="CasteName" value="">
                          <?php // foreach($CasteNames as $CasteName) { ?>
                         <option value="<?php //echo $CasteName['SoftCode'];?>">
                         <?php //echo $CasteName['CodeValue'];?></option>
                          <?php// } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email Id *</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="EmailID" name="EmailID" Placeholder="Enter Email ID" value="<?php //echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" Placeholder="Enter  Mobile Number" value="<?php //echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="WhatsappNumber" name="WhatsappNumber" Placeholder="Enter Whatsapp Number" value="<?php //echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Landline Number </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LandlineNumber" name="LandlineNumber" Placeholder="Enter Landline Number"value="<?php //echo (isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address1" name="Address1" Placeholder="Enter Address1" value="<?php //echo (isset($_POST['Address1']) ? $_POST['Address1'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address2" name="Address2" Placeholder="Enter Address2" value="<?php //echo (isset($_POST['Address2']) ? $_POST['Address2'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address3" name="Address3" Placeholder="Enter Address3" value="<?php //echo (isset($_POST['Address3']) ? $_POST['Address3'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Adhaar No *</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="AadhaarCard" name="AadhaarCard" Placeholder="Enter AadhaarCard Number" value="<?php //echo (isset($_POST['AadhaarCard']) ? $_POST['AadhaarCard'] : "");?>"></div>
                        </div>
                      </div> 
                   </div>   
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Fathers Name *</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="FatherName" name="FatherName" Placeholder="Enter Father Name" value="<?php //echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : "");?>">
                          </div>
                          <label class="col-sm-4 col-form-label" align="right"><input type="checkbox" class="form-control-check-input">&nbsp;no more</label>
                         </div>
                      </div>
                      </div>
                      <button type="submit" class="btn btn-success" name="BtnSaveCreate">Create</button>
      </div>
  </div>
</form>-->   