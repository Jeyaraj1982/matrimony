<?php
    //$Member = $mysql->select("select * from _tbl_members where MemberID='".$_REQUEST['Code']."'");
    //$Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='". $Member[0]['ReferedBy']."'"); 
    $Franchisee =$mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_REQUEST['Code']."'");
    $FranchiseeBank =$mysql->select("select * from _tbl_bank_details where FranchiseeID='".$_REQUEST['Code']."'");
    $FranchiseeStaff =$mysql->select("select * from _tbl_franchisees_staffs where ReferedBy='1' and FranchiseeID='".$_REQUEST['Code']."'");
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
                    <h4 class="card-title">Franchisee Information</h4>
                    <h4 class="card-title">Reset Password</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['FranchiseName'];?></small></div>
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactNumber'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactEmail'];?></small></div>
                          <div class="col-sm-3"><small>Status:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"> 
                          <?php if($Franchisee[0]['IsActive']==1){
                                  echo "Active";
                              }
                              else{
                                  echo "Deactive";
                              }
                              ?></small></div>
                        </div>
                        <?php if($Franchisee[0]['IsActive']==1){      ?>
                            <div class="form-group row">
                            <div class="col-sm-3"><small>Reason for Reset Password</small></div>
                            <div class="9"><textarea rows="2" cols="33" id="ResetPassword" name="ResetPassword"></textarea></div>
                            </div>
                            <div class="form-group row">
                            <button type="submit" name="SendMail" class="btn btn-success mr-2">Send Mail</button>
                        </div>
                        <?php } ?>
                        <?php  if($Franchisee[0]['IsActive']==0){
                          echo "Please Active Franchisee";
                        }   
                        ?> 
                                    
                    
  </div>
 </div>
</div>                                        
                      