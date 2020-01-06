<?php $response = $webservice->getData("Admin","GetAdminStaffInfo");
    $Staffs          = $response['data']['Staffs'];?>
<style>
.switch input { 
    display:none;
}
.switch {
    display:inline-block;
    width: 46px;
    height: 17px;
    margin: 2px;
    transform:translateY(50%);
    position:relative;
}

.slider {
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    border-radius:30px;
    box-shadow:0 0 0 2px #777, 0 0 4px #777;
    cursor:pointer;
    overflow:hidden;
     transition:.4s;
}
.slider:before {
    position:absolute;
    content:"";
    width:100%;
    height:100%;
    background:#777;
    border-radius:30px;
    transform:translateX(-30px);
    transition:.4s;
}

input:checked + .slider:before {
    transform:translateX(30px);
    background:limeGreen;
}
input:checked + .slider {
    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
}
</style>
<script>
function ShowPwd() {
    var pwd ='<?php echo $Staffs[0]['AdminPassword'];?>';
    $('#pwd').html(pwd);
}
function ShowTxnPwd() {    
    var Txnpwd ='<?php echo $Staffs[0]['TransactionPassword'];?>';
    $('#Txnpwd').html(Txnpwd);
   
}
</script>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="<?php echo $Staffs[0]['AdminCode'];?>" name="StaffCode" id="StaffCode">
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div style="padding:15px !important;max-width:770px !important;">
                        <h4 class="card-title">Manage Staffs</h4>
                        <h4 class="card-title">View Staff</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Staff Code</label>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['AdminName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Staff Name<span id="star">*</span></label>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['AdminName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                                <div class="col-sm-5" ><small style="color:#737373;"><?php echo $Staffs[0]['DateofBirth'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
                                <div class="col-sm-4"><small style="color:#737373;"><?php echo $Staffs[0]['Sex'];?></small></div>
                                <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['Sex'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['MobileNumber'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['EmailID'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login Name</label>
                                <div class="col-sm-5"><small style="color:#737373;"><?php echo $Staffs[0]['AdminLogin'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                                <div class="col-sm-5">
                                    <small style="color:#737373;">
                                        <span id='pwd'><a href="javascript:ShowPwd()">Show Password</a></span>
                                </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Transaction Password<span id="star">*</span></label>
                                <div class="col-sm-5">
                                    <small style="color:#737373;">
                                        <span id='Txnpwd'><a href="javascript:ShowTxnPwd()">Show Password</a></span>
                                </small>
                                </div>
                            </div>
                            <br>
                        
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row" >
                <div class="col-sm-12" style="text-align:right">
                &nbsp;<a href="../ManageStaffs"><small style="font-weight:bold;text-decoration:underline">List of Staffs</small></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
                       
                        <div class="form-group row">
                        <div class="col-sm-12 col-form-label">
                            Created On <br>
                            <?php echo putDateTime($Staffs[0]['CreatedOn']);?><br><br> 
                        </div>
                        <div class="col-sm-12 col-form-label">
                           
                             <span class="<?php echo ($Staffs[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                             &nbsp;&nbsp;&nbsp;
                             <small style="color:#737373;">
                                      <?php if($Staffs[0]['IsActive']==1){
                                          echo "Active";
                                      }                                  
                                      else{
                                          echo "Deactive";
                                      }
                                      ?>
                                      </small>
                             </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmationfrEditAdminStf('<?php echo $Staffs[0]['AdminCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Edit Staff</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Staffs[0]['IsActive']==1) { ?>
                                <a href="javascript:void(0)" onclick="AdminStaff.ConfirmDeactiveAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Deactive Staff</small></a>                                   
                                 <?php } else {    ?>
                                    <a href="javascript:void(0)" onclick="AdminStaff.ConfirmActiveAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Active Staff</small></a>                                   
                                <?php } ?>
                            </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmAdminStaffChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmAdminStaffResetTxnPswd()"><small style="font-weight:bold;text-decoration:underline">Reset Transaction Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmDeleteAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Delete Staff</small></a></div>
                           
                            <?php if(sizeof($response['data']['LastLogin'])>0){ ?>
                            <div class="col-sm-12 col-form-label">
                            <hr>
                                Last Login <br><?php echo $response['data']['LastLogin'][0]['LoginOn'];?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
</div>
<br>
<div class=" grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
    
</div> 
</form> 
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
        
            </div>
        </div>
    </div>
    <div class="modal" id="ChnPswdNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="ChnPswd_body"  style="max-height: 462px;;min-height: 462px;;" >
        
            </div>
        </div>
    </div>

