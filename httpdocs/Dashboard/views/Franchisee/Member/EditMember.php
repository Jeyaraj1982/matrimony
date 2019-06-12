<?php
    $Member = $mysql->select("select * from _tbl_members where MemberID='".$_REQUEST['Code']."'");
    
    $Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='". $Member[0]['ReferedBy']."'");
    
    $duplicate = $mysql->select("select * from  _tbl_members where MemberName='".trim($_POST['MemberName'])."' and MemberID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrMemberName="MemberName Already Exists";    
             $ErrorCount++;
        }
        
    $duplicate = $mysql->select("select * from  _tbl_members where EmailID='".trim($_POST['EmailID'])."' and MemberID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="EmailID Already Exists";    
             $ErrorCount++;
        }
    if (sizeof($Member)==0) {
        echo "Error: Access denied. Please contact administrator";
    } else {                                                       
        
     if (isset($_POST['Btnupdate'])) {
           $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                    EmailID='".$_POST['EmailID']."',
                                                    MobileNumber='".$_POST['MobileNumber']."',
                                                    IsActive='".$_POST['Status']."' where  MemberID='".$_REQUEST['Code']."'");
       unset($_POST);                         
       echo "Updated Successfully";
     }                                                 
    }                                     
    
    $Member=$mysql->select(" SELECT 
                                     _tbl_members.MemberID AS MemberID,
                                     _tbl_members.MemberCode AS MemberCode,
                                     _tbl_members.MemberName AS MemberName,
                                     _tbl_members.MobileNumber AS MobileNumber,
                                     _tbl_members.EmailID AS EmailID,
                                     _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                     _tbl_franchisees.FranchiseName AS FranchiseName,
                                     _tbl_franchisees.FranchiseeID AS FranchiseeID,
                                     _tbl_members.CreatedOn AS CreatedOn,
                                     _tbl_franchisees.IsActive AS FIsActive,
                                     _tbl_members.IsActive AS IsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.MemberID='".$_REQUEST['Code']."'");
    
     //$Member = $mysql->select("select * from _tbl_members where MemberID='".$_REQUEST['Code']."'");
    
    //$Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='". $Member[0]['ReferedBy']."'");
   
   
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
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}                                                
</script>
<form method="post" action="" onsubmit="return SubmitNewMember();">
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Manage My Member</h4>  
                      <h4 class="card-title">Edit Member Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Member Code</small> </div>
                          <div class="col-sm-3"><input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member[0]['MemberCode']);?>" placeholder="Member Code">
                          <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Member Name<span id="star">*</span></small> </div>
                          <div class="col-sm-8"><input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member[0]['MemberName']);?>" placeholder="Member Name">
                          <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span></div>'
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Mobile Number<span id="star">*</span></small></div>
                          <div class="col-sm-3"><input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member[0]['MobileNumber']);?>" placeholder="Mobile Number">
                          <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                          <div class="col-sm-2"><small>Email ID<span id="star">*</span></small></div>
                          <div class="col-sm-3"><input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member[0]['EmailID']);?>" placeholder="Email ID">
                          <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Created On</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDateTime($Member[0]['CreatedOn']);?></small></div>
                          <div class="col-sm-2"><small>Status<span id="star">*</span></small></div>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;" >
                                    <option value="1" <?php echo ($Member[0]['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Member[0]['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                          </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Franchisee Name</small></div>
                          <div class="col-sm-3"><span class="<?php echo ($Member[0]['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member[0]['FranchiseName'];?> (<?php echo  $Member[0]['FranchiseeCode'];?>)</small></div>
                      </div>
                      <button type="submit" name="Btnupdate" class="btn btn-primary mr-2">Update Information</button>
                </div>                                                                                                        
              </div>
</div>                                                                                                         
<div class="col-12 grid-margin">
                  <div class="card">                                                            
                    <div class="card-body">                                                                            
                      <h4 class="card-title">Profiles</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Draft</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Posted</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Published</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Unpublished</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Expired</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Rejected</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                      </div>
                </div>
              </div>
</div>
<div class="col-12 grid-margin">
<div class="col-sm-12" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/ViewMember/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">View Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/BlockMember/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div>         
</div>                                       
                   