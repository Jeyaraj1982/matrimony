<?php
   // $Member = $mysql->select("select * from _tbl_members where MemberID='".$_REQUEST['Code']."'");
   // $Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='". $Member[0]['ReferedBy']."'");
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
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Manage Members</h4>  
                      <h4 class="card-title">View Member Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Code:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MemberCode'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MemberName'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MobileNumber'];?></small></div>
                          <div class="col-sm-2"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  $Member[0]['EmailID'];?></small></div>
                          </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Created on:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDateTime($Member[0]['CreatedOn']);?></small></div>
                          <div class="col-sm-2"><small>Status:</small></div>
                        <div class="col-sm-3"><small style="color:#737373;">
                              <?php if($Member[0]['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";
                              }
                              ?>
                              </small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-3"><small>Franchisee Name:</small></div>
                        <div class="col-sm-3"><span class="<?php echo ($Member[0]['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member[0]['FranchiseName'];?> (<?php echo  $Member[0]['FranchiseeCode'];?>)</small></div>                                                         
                </div>                                                                                                        
              </div>                                      
</div>    
</div>                                                                                                    
<div class="col-12 grid-margin">
                  <div class="card">                                                            
                    <div class="card-body">                                                                            
                      <h4 class="card-title">Profiles</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Drafted</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
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
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Wallet</h4>   
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-6"><small style="color:#737373;"><?php echo "RS 500"?></small></div>
                           <div class="col-sm-2"><small>Mails:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo "30";?></small></div>
                      </div>
                      <div class="form-group row">
                           <div class="col-sm-6"><a href="<?php echo GetUrl("Franchisees/Wallet/RefillWallet");?>"><small>Refill Wallet</small></a></div>
                           <div class="col-sm-2"><small>Notification:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  "35";?></small></div>
                      </div>
                </div>
              </div>
</div>
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title"></h4>   
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Total Contact Downloaded:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Saved Fav:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Remain Later:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div> 
                </div>
              </div>
</div>                                                                                     
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/EditMember/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/BlockMember/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Member/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div>         
</form>
  