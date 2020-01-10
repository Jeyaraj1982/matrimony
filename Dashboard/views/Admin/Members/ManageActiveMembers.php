<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Manage Members</h4>
                <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">Active Members</h5>
                </div>
                    <!--<div class="col-sm-3">
                        <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>New Franchisee</button> </div>  -->
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMember" ><small>All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small>Deactive</small></a>&nbsp;|&nbsp;
                        <a href="Franchiseewise"><small>Franchisee-wise</small></a>&nbsp;|&nbsp;
                        <a href="Report/Report"><small>Report</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Name</th>
                        <th>Franchisee Code</th>
                        <th>Franchisee Name</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetManageMembers",array("Request"=>"Active")); ?>  
                        <?php foreach($response['data'] as $Member) { ?>
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
<?php/* $Franchisees = $mysql->select("select * from _tbl_Franchisees"); ?>
                        <?php foreach($Franchisees as $Franchisee) { */?>
                         <?php // }  
                        ?>