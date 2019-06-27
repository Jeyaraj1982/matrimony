<?php

    if (isset($_POST['Btnupdate'])) {
        $response = $webservice->EditMemberInfo($_POST);
        if ($response['status']=="success") {
            $successmessage=$response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->GetMemberInfo();
    $Member=$response['data'];
?>
<script>
    $(document).ready(function () {
        $("#MobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
                return false;
            }
        });
        $("#MemberName").blur(function () {
            IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name");
        });
        $("#MobileNumber").blur(function () {   
            IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
        });
        $("#EmailID").blur(function () {
            IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
        }); 
    });
    
    function SubmitNewMember() {
        $('#ErrMemberName').html("");
        $('#ErrMobileNumber').html("");
        $('#ErrEmailID').html("");
        
        ErrorCount=0;
        if (IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name")) {
            IsAlphabet("MemberName","ErrMemberName","Please Enter Alpha Numeric characters only");
        }
        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
            IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
        }
        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
        }
        return (ErrorCount==0) ? true : false;
    }                                                
</script>
<form method="post" action="" onsubmit="return SubmitNewMember();">
<h4>My Settings</h4>
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
             <div class="form-group-row">
              <div class="col-sm-12">
               <div class="col-sm-3">
                <div class="sidemenu" style="width: 200px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                    <?php include_once("sidemenu.php");?>
                </div>
                </div>
                <div class="col-sm-9">
                 <h4 class="card-title">Manage My Member</h4>  
                 <h4 class="card-title">Edit Member Information</h4>  
                  <div class="form-group row">
                     <div class="col-sm-3"><small>Member Code</small> </div>
                     <div class="col-sm-3"><input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member['MemberCode']);?>" placeholder="Member Code">
                     <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span></div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-3"><small>Member Name<span id="star">*</span></small> </div>
                     <div class="col-sm-8"><input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
                     <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span></div>'
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-3"><small>Mobile Number<span id="star">*</span></small></div>
                     <div class="col-sm-3"><input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
                     <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                  </div>
                  <div class="form-group row">     
                     <div class="col-sm-3"><small>Email ID<span id="star">*</span></small></div>
                     <div class="col-sm-6"><input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
                     <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3"><small>Status<span id="star">*</span></small></div>
                     <div class="col-sm-3">
                         <select name="Status" class="form-control" style="width: 140px;" >
                             <option value="1" <?php echo ($Member['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                             <option value="0" <?php echo ($Member['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                         </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-3"><small>Created On</small></div>
                     <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                  </div>
                  <div class="col-sm-12" style="text-align:center;color:red"><?php echo $successmessage;?> <?php echo $errormessage;?></div>
                  <button type="submit" name="Btnupdate" class="btn btn-primary mr-2">Update Information</button>
                </div>                                                                                                        
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
                                                                                                         
