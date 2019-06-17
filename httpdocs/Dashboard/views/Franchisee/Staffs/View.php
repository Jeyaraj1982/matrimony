<?php
  /* $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_REQUEST['Code']."'");
         if (sizeof($Staffs)==0) {
            echo "Error: Access denied. Please contact administrator";
             } else {*/?>
             <?php
 $response = $webservice->GetStaffs(array());
    $Staffs=$response['data'];    
?>
 
 
<form method="post" action="">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Staff</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Staff Code<span id="star">*</span></label>
                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['StaffCode'];?></small></div>
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Staff Name<span id="star">*</span></label>
                            <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['PersonName'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sex<span id="star">*</span></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['Sex'];?></small></div>
                          <label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['DateofBirth'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                            <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['MobileNumber'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                           <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['EmailID'];?></small></div> 
                        </div>
                      </div>
                      </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Role<span id="star">*</span></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['UserRole'];?></small></div>
                      </div>
                   </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['LoginName'];?></small></div> 
                          <label class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['LoginPassword'];?></small></div>
                        </div>
                      </div>
                      </div>
                   <br>
                   <div class="form-group row">
                        <div class="col-sm-3"><a href="<?php echo GetUrl("Staffs/Edit/".$_REQUEST['Code'].".html");?>" class="btn btn-success mr-2">Edit staff</a></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../ManageStaffs "><small>List of Staffs</small> </a></div>
                   </div>
                </form>
             </div>
          </div>
</div>
</form>   
