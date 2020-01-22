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
                        <a href="ManageMembers" ><small>All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small>Deactivated</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeletedMembers"><small>Deleted</small></a>&nbsp;|&nbsp;
                        <a href="Franchiseewise"><small>Franchisee-wise</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Code</th>
                        <th>Member Name</th>
                        <th  style="width:50px;">Franchisee Code</th>
                        <th>Franchisee Name</th>  
                        <th>Created By</th>                 
                        <th  style="width:100px;">Created</th>
                        <th style="width:50px;"></th>                          
                        </tr> 
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetManageMembers",array("Request"=>"Active")); ?>  
                        <?php foreach($response['data'] as $Member) { ?>
                                <tr>
                                <td><span class="<?php if($Member['IsActive']==1 && $Member['IsDeleted']==0){ echo 'Activedot'; } if($Member['IsActive']==0 && $Member['IsDeleted']==0){ echo 'Deactivedot'; } if($Member['IsDeleted']==1){ echo 'DeletedDot'; }?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberCode'];?></td>
                                <td><?php echo $Member['MemberName'];?></td>
                                <td><?php echo $Member['FranchiseeCode'];?></td>
                                <td><?php echo $Member['FranchiseeName'];?></td>
                                <td><button class="btn btn-primary" style="padding: 0px 4px;font-size: 12px;background: #b3d285;border: #b3d285;"><?php echo $Member['CreatedBy'];?></button></td>
                                <td><?php echo  putDateTime($Member['CreatedOn']);?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Members/EditMember/". $Member['MemberCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Members/ViewMember/". $Member['MemberCode'].".htm"); ?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
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