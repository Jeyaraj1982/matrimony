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
<?php   
    class HTML {
    function input($param) {
        $tag = "<input ";
        foreach($param as $k=>$v) {
            $tag .= $k.'="'.$v.'" ';
        }
        $tag .= ">";
        return $tag;
    }
    
    function span($param) {
        $tag = "<span ";
        foreach($param as $k=>$v) {
            $tag .= $k.'="'.$v.'" ';
        }
        $tag .= "></span>";
        return $tag;
    }
}

$html = new HTML();
    if (isset($_POST['BtnupdateStaff'])) {
        
        $response = $webservice->getData("Admin","EditAdminStaff",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","GetAdminStaffInfo");
    $Staffs          = $response['data']['Staffs'];
    
?>
<script>

$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
	$("#StaffName").blur(function () {
    if (IsNonEmpty("StaffName","ErrstaffName","Please Enter staff Name")) {
		IsAlphaNumeric("StaffName","ErrstaffName","Please Enter Alpha Numeric characters only");
		}
   });   
   $("#staffCode").blur(function () {
    
        IsNonEmpty("staffCode","ErrstaffCode","Please Enter staff Code");
                        
   });
   $("#Sex").change(function() {
		if ($("#Sex").val()=="0") {
			$("#ErrSex").html("Please select a Sex");  
		}else{
			$("#ErrSex").html("");  
		}
	});
	$("#MobileNumber").blur(function () {
			if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
				IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
			}              
		});	
   $("#EmailID").blur(function () {
			if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
			    IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
			}
		});

   $("#UserRole").blur(function () {
    
        IsNonEmpty("UserRole","ErrUserRole","Please Enter User Role");
                        
   });
	$("#LoginName").blur(function () {
		if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
					IsAlphabet("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
					}
	});
   $("#LoginPassword").blur(function () {
    
        IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password");
                        
   });
});

function myFunction() {
  var x = document.getElementById("LoginPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function SubmitNewStaff() {
                         $('#ErrstaffName').html("");
                         $('#ErrSex').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("StaffName","ErrstaffName","Please Enter staff Name")) {
                        IsAlphaNumeric("StaffName","ErrstaffName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsPassword("LoginPassword","ErrLoginPassword","Please Enter More than 8 characters")) {
                        IsAlphaNumeric("LoginPassword","ErrLoginPassword","Alpha Numeric Characters only");
                        }
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                        
}
                 
                 function DateofBirthValidation() {
        
        if ($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0") {
            $('#ErrDateofBirth').html("Please select Date of Birth");
        } else {
            $('#ErrDateofBirth').html("");
        }
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
                        <h4 class="card-title">Edit Staff</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Staff Code</label>
                                <div class="col-sm-3"><input type="text" class="form-control" disabled="disabled" id="StaffCode" name="StaffCode" value="<?php echo (isset($_POST['StaffCode']) ? $_POST['StaffCode'] : $Staffs[0]['AdminCode']);?>"> </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Staff Name<span id="star">*</span></label>
                                <div class="col-sm-9">
                                    <?php if($Staffs[0]['IsActive']==1){ ?>
                                    <input type="text" class="form-control" id="StaffName" name="StaffName" value="<?php echo (isset($_POST['StaffName']) ? $_POST['StaffName'] : $Staffs[0]['AdminName']);?>">
                                    <span class="errorstring" id="ErrstaffName"><?php echo isset($ErrstaffName)? $ErrstaffName : "";?></span>
                                    <?php } else { ?>
                                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $Staffs[0]['AdminName'];?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                                <div class="col-sm-5" >
                                    <?php if($Staffs[0]['IsActive']==1){ ?>
                                    <div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
                                        <?php $dob=strtotime($Staffs[0]['DateofBirth'])  ; ?>
                                            <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                                <?php for($i=1;$i<=31;$i++) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                                        <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                            <?php foreach($_Month as $key=>$value) {?>
                                                <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                        <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                            <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } else { ?>
                                        <div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
                                        <?php $dob=strtotime($Staffs[0]['DateofBirth'])  ; ?>
                                            <select class="form-control" disabled="disabled">
                                                <?php for($i=1;$i<=31;$i++) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                                        <select class="form-control" disabled="disabled">
                                            <?php foreach($_Month as $key=>$value) {?>
                                                <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                        <select class="form-control" disabled="disabled">
                                            <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
                                <div class="col-sm-4">
                                <?php if($Staffs[0]['IsActive']==1){ ?>
                                    <select class="form-control" id="Sex"  name="Sex" >
                                       <?php foreach($response['data']['Gender'] as $Sex) { ?>
                                            <option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($Sex['CodeValue']==$Staffs[0]['Sex']) ? " selected='selected'" :""; ?>><?php echo $Sex['CodeValue'];?></option>
                                       <?php } ?>     
                                    </select>
                                    <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                                <?php } else{  ?>
                                    <select class="form-control" disabled="disabled">
                                        <option><?php echo $Staffs[0]['Sex'];?></option>
                                    </select>
                                <?php } ?>
                                </div>
                                <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                                <div class="col-sm-3">
                                <?php if($Staffs[0]['IsActive']==1){ ?>
                                    <select class="form-control" id="UserRole"  name="UserRole">
										<option value="Admin" <?php echo ($_POST[ 'UserRole']==$Staffs[0]['StaffRoll']) ? " selected='selected'" :""; ?>>Admin</option>
										<option value="View" <?php echo ($_POST[ 'UserRole']==$Staffs[0]['StaffRoll']) ? " selected='selected'" :""; ?>>View</option>
                                    </select>
                                    <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                                <?php } else { ?>
                                    <select class="form-control" disabled="disabled">
                                        <option><?php echo $Staffs[0]['UserRole'];?></option>
                                    </select>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                                <div class="col-sm-3" style="padding-right:0px">
                                    <?php if($Staffs[0]['IsActive']==1){ ?>
                                    <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode">
                                        <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Staffs[0][ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>><?php echo $CountryCode['str'];?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } else { ?>
                                    <select class="form-control" disabled="disabled">
                                        <option><?php echo $Staffs[0]['CountryCode'];?></option>
                                    </select>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if($Staffs[0]['IsActive']==1){ ?>
                                   <?php 
                                        echo $html->input(array("type"        => "text",
                                                           "maxlength"    => "10",
                                                           "class"        => "form-control",
                                                           "id"            => "MobileNumber",
                                                           "name"        => "MobileNumber",
                                                           "error"        => "Please Enter Mobile Number",
                                                           "error_div"    => "ErrMobileNumber",
                                                           "oldvalue"    => $Staffs[0]['MobileNumber'],
                                                           "value"        => $Staffs[0]['MobileNumber']));
                                        echo $html->span(array("class"    => "errorstring",
                                                           "id"            => "ErrMobileNumber"));
                                                    ?>
                                    <span class="" id=""></span>
                                    <?php } else{ ?>
                                        <input type="text" disabled="disabled" maxlength="10" class="form-control" value="<?php echo  $Staffs[0]['MobileNumber'];?>" >
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                                <div class="col-sm-9">
                                    <?php if($Staffs[0]['IsActive']==1){ ?>
                                        <input type="type" class="form-control" id="EmailID" oldvalue="<?php echo $Staffs[0]['EmailID'];?>" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Staffs[0]['EmailID']);?>">
                                        <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                                    <?php } else{ ?>
                                        <input type="text" disabled="disabled" maxlength="10" class="form-control" value="<?php echo  $Staffs[0]['EmailID'];?>" >
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login Name</label>
                                <div class="col-sm-5">
                                    <input type="text" disabled="disabled" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : $Staffs[0]['AdminLogin']);?>">
                                    <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login Password</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="AdminPassword" name="AdminPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['AdminPassword']) ? $_POST['AdminPassword'] : $Staffs[0]['AdminPassword']);?>">
                                        <span class="input-group-btn">
                                            <button  onclick="showHidePwd('AdminPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                        </span>          
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Transaction Password</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="StaffTransactionPassword" name="StaffTransactionPassword" Placeholder="Transaction Password" value="<?php echo (isset($_POST['TransactionPassword']) ? $_POST['TransactionPassword'] : $Staffs[0]['TransactionPassword']);?>">
                                        <span class="input-group-btn">
                                            <button  onclick="showHidePwd('StaffTransactionPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                        </span>          
                                    </div> 
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
                    &nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AdminStaff.ConfirmGotoBackFromEditAdminStaff()">Cancel</a>&nbsp;
                    <?php if($Staffs[0]['IsActive']==1){ ?>
                        <a href="javascript:void(0)" onclick="AdminStaff.ConfirmEditAdminStaff()" class="btn btn-primary" name="BtnupdateStaff">Update staff</a>
                    <?php } else { ?>
                        <a class="btn btn-primary" disabled="disabled">Update information</a>
                    <?php } ?>
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
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Staffs/View/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">View Staff</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Staffs[0]['IsActive']==1) { ?>
                                <a href="javascript:void(0)" onclick="AdminStaff.ConfirmDeactiveAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Deactive Staff</small></a>                                   
                                 <?php } else {    ?>
                                    <a href="javascript:void(0)" onclick="AdminStaff.ConfirmActiveAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Active Staff</small></a>                                   
                                <?php } ?>
                            </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmAdminStaffChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmAdminStaffResetTxnPswd()"><small style="font-weight:bold;text-decoration:underline">Reset Transaction Password</small></a></div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="AdminStaff.ConfirmDeleteAdminStaff()"><small style="font-weight:bold;text-decoration:underline">Delete Staff</small></a></div>
							
							<div class="col-sm-12 col-form-label">
							<hr>
							<?php if($Staffs[0]['ChangePasswordFstLogin']==1) { ?>
								<br><div>
									<a href="javascript:void(0)" onclick="AdminStaff.ConfirmAdminStaffChnPswdFstLogin()"><label class="switch" style="background: none;">
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

