<?php 
    $response = $webservice->getData("Admin","GetSupportDeskUserInfo");
    $Users          = $response['data']['Users'];?>
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
    var pwd ='<?php echo $Users[0]['UserPassword'];?>';
    $('#pwd').html(pwd);
}
function ShowTxnPwd() {    
    var Txnpwd ='<?php echo $Users[0]['TransactionPassword'];?>';
    $('#Txnpwd').html(Txnpwd);
   
}
</script>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="<?php echo $Users[0]['UserCode'];?>" name="UserCode" id="UserCode">
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div style="padding:15px !important;max-width:770px !important;">
                        <h4 class="card-title">Manage Users</h4>
                        <h4 class="card-title">View User</h4>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>User Code</small></div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Users[0]['UserCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Name</small></div>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Users[0]['UserName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Date of Birth</small></div>
                                <div class="col-sm-5" ><small style="color:#737373;"><?php echo $Users[0]['DateofBirth'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Gender</small></div>
                                <div class="col-sm-4"><small style="color:#737373;"><?php echo $Users[0]['Sex'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Mobile Number</small></div>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Users[0]['MobileNumber'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Email ID</small></div>
                                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Users[0]['EmailID'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Login Name</small></div>
                                <div class="col-sm-5"><small style="color:#737373;"><?php echo $Users[0]['UserLogin'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Login Password</small></div>
                                <div class="col-sm-5">
                                    <small style="color:#737373;">
                                        <span id='pwd'><a href="javascript:ShowPwd()">Show Password</a></span>
                                </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Transaction Password</small></div>
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
                &nbsp;<a href="../ManageUsers"><small style="font-weight:bold;text-decoration:underline">List of Users</small></a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
                       
                        <div class="form-group row">
                        <div class="col-sm-12 col-form-label">
                            Created On <br>
                            <?php echo putDateTime($Users[0]['CreatedOn']);?><br><br> 
                        </div>
                        <div class="col-sm-12 col-form-label">
                           
                             <span class="<?php echo ($Users[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                             &nbsp;&nbsp;&nbsp;
                             <small style="color:#737373;">
                                      <?php if($Users[0]['IsActive']==1){
                                          echo "Active";
                                      }                                  
                                      else{
                                          echo "Deactive";
                                      }
                                      ?>
                                      </small>
                             </div>
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("SupportDesk/Edit/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit User</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Users[0]['IsActive']==1) { ?>
                                <a href="javascript:void(0)" onclick="SupportDesk.ConfirmDeactiveSDUser()"><small style="font-weight:bold;text-decoration:underline">Deactive User</small></a>                                   
                                 <?php } else {    ?>
                                    <a href="javascript:void(0)" onclick="SupportDesk.ConfirmActiveSDUser()"><small style="font-weight:bold;text-decoration:underline">Active User</small></a>                                   
                                <?php } ?>
                            </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="SupportDesk.ConfirmSDUserChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="SupportDesk.ConfirmSDUserResetTxnPswd()"><small style="font-weight:bold;text-decoration:underline">Reset Transaction Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="SupportDesk.ConfirmDeleteSDUser()"><small style="font-weight:bold;text-decoration:underline">Delete User</small></a></div>
                            
                            <div class="col-sm-12 col-form-label">
                            <hr>
                            <?php if($Users[0]['ChangePasswordFstLogin']==1) { ?>
                                <br><div>
                                    <a href="javascript:void(0)" onclick="SupportDesk.ConfirmSDUserChnPswdFstLogin()"><label class="switch" style="background: none;">
                                        <input type="checkbox">
                                            <span class="slider"></span>
                                    </label></a>
                                    Change Password for first time login
                                </div>
                            <?php } ?>
                                
                            </div>
                            
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
            <div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
        
            </div>
        </div>
    </div>
    <div class="modal" id="ChnPswdNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="ChnPswd_body"  style="max-height: 462px;;min-height: 462px;;" >
        
            </div>
        </div>
    </div>

