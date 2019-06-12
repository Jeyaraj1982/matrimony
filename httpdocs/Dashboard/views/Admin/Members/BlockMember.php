<?php
    //$Member = $mysql->select("select * from _tbl_members where MemberID='".$_REQUEST['Code']."'");
    //$Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='". $Member[0]['ReferedBy']."'"); 
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
?>
<script>
    function SubmitSearch() {
        
        $('#ErrMemberDetails').html("");
        
        ErrorCount=0;
        
        if(IsNonEmpty("MemberDetails","ErrMemberDetails","Please Enter Valid Name or Mobile Number or Email")){
           IsSearch("MemberDetails","ErrMemberDetails","Please Enter more than 3 characters"); 
        }
        
        if (ErrorCount==0) {
            return true;
        } else{
            return false;
        }
    }
</script>
<div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Member Information</h4>
                    <h4 class="card-title">Block Member</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MemberName'];?></small></div>
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MobileNumber'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['EmailID'];?></small></div>
                          <div class="col-sm-3"><small>Status:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"> 
                          <?php if($Member[0]['IsActive']==1){
                                  echo "Active";
                              }
                              else{
                                  echo "Deactive";
                              }
                              ?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  $Member[0]['FranchiseName'];?></small></div>
                        </div>
                        <?php if($Member[0]['IsActive']==1){      ?>
                            <div class="form-group row">
                            <div class="col-sm-3"><small>Reason for Block Member</small></div>
                            <div class="9"><textarea rows="2" cols="33" id="ResetPassword" name="ResetPassword"></textarea></div>
                            </div>
                            <div class="form-group row">
                            <button type="submit" name="SendMail" class="btn btn-success mr-2">Block Member</button>
                        </div>
                        <?php } ?>
                        <?php  if($Member[0]['IsActive']==0){
                          echo "Already Blocked Try again";
                        }   
                        ?> 
                                    
                    
  </div>
 </div>
</div>                                        
                      