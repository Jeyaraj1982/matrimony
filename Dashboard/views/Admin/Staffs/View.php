<?php
  $response = $webservice->getData("Admin","GetAdminStaffInfo");
    $Staffs          = $response['data']['Staffs'];
         if (sizeof($Staffs)==0) {
            echo "Error: Access denied. Please contact administrator";
            } else {
?>
<script>
function ShowPwd() {
    var pwd ='<?php echo $Staffs['AdminPassword'];?>';
    $('#pwd').html(pwd);
    /*
  var x = document.getElementById("LoginPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }    */
}
</script> 
<form method="post" action="">                                   
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Staff</h4>
                  <h4 class="card-title">View Staff</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Staff Code</label>
                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['AdminCode'];?></small></div>
                          <label class="col-sm-3 col-form-label">Staff Name</label>
                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['AdminName'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo putDate($Staffs['DateofBirth']);?></small></div>
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['Sex'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number</label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['MobileNumberCountryCode'];?>-<?php echo $Staffs['MobileNumber'];?></small></div>
                          <label class="col-sm-3 col-form-label">Email ID</label>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['EmailID'];?></small></div> 
                        </div>
                      </div>
                      </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login Name</label>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['AdminLogin'];?></small></div> 
                           <label class="col-sm-3 col-form-label">Login Password</label>
                            <div class="col-sm-3">
                                <small style="color:#737373;">
                                    <span id='pwd'><a href="javascript:ShowPwd()">Show Password</a></span>
                                </small>
                             </div>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Staff Role</label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs['StaffRole'];?></small></div>
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-3"><span class="<?php echo ($Staffs['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;
                          <label style="color:#737373;">
                            <?php if($Staffs['IsActive']==1){
                                echo "Active";
                                }
                                else{
                                 echo "Deactive";
                                 }
                            ?>
                          </label>
                          </div>
                        </div>
                      </div>
                  </div>
                   <br>
                </form>
             </div>                                               
          </div>
</div>
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageStaffs"><small style="font-weight:bold;text-decoration:underline">List of Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/Edit/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Staff</small></a>&nbsp;
                        <a href="<?php //echo /*GetUrl("Staffs/BlockStaffs/".$_REQUEST['Code'].".html"); */ ?>"><small style="font-weight:bold;text-decoration:underline">Login Logs</small></a>&nbsp;|&nbsp;
                        <a href="<?php // echo //GetUrl("Staffs/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div> 
</form>   
<?php }?>