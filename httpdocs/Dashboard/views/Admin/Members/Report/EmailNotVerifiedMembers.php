
<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-4">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Manage Members</h4>
                <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">Email non-Verified Members</h5>
                </div>
                        <div class="col-sm-8" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMember" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
                        <a href="Franchiseewise"><small style="font-weight:bold;text-decoration:underline">Franchisee-wise</small></a>&nbsp;|&nbsp;
                        <a href="Report"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Name</th>
                        <th  style="width:50px;">Franchisee Code</th>
                        <th>Franchisee Name</th>                   
                        <th  style="width:100px;">Created</th>
                        <th style="width:50px;"></th>                          
                        </tr>  
                    </thead>
                    <tbody> 
                        <?php $Members=$mysql->select("
                                    SELECT 
                                        _tbl_members.MemberID AS MemberID,
                                        _tbl_members.MemberName AS MemberName,
                                        _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                        _tbl_franchisees.FranchiseName AS FranchiseeName,
                                        _tbl_members.CreatedOn AS CreatedOn,
                                        _tbl_members.IsActive AS IsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.IsEmailVerified='0';"); ?>
                                    
                        <?php foreach($Members as $Member) { ?>
                                <tr>
                                <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberName'];?></td>
                                <td><?php echo $Member['FranchiseeCode'];?></td>
                                <td><?php echo $Member['FranchiseeName'];?></td>
                                <td><?php echo  putDateTime($Member['CreatedOn']);?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Members/EditMember/". $Member['MemberID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Members/ViewMember/". $Member['MemberID'].".htm"); ?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
                                </tr>
                        <?php } ?>            
                      </tbody>                        
                     </table>
                  </div>
                </div>
              </div>
            </div>
        </form>   
        
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
