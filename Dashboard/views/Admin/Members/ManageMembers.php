<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Manage Members</h4>
                <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">All Members</h5>
                </div>
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMember" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
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
                        <?php $response = $webservice->getData("Admin","GetManageMembers",array("Request"=>"All")); ?>  
                        <?php foreach($response['data'] as $Member) { ?>
                            <tr>
                                <td>
                                <?php
                                    if ($Member['IsDeleted']==1) {
                                       echo ' <span title="Member: Deleted" data-toggle="tooltip" class="DeletedDot"></span>'; 
                                    } elseif ($Member['IsActive']==1) {
                                        echo ' <span title="Member: Active" data-toggle="tooltip"class="Activedot"></span>'; 
                                    } elseif ($Member['IsActive']==0){
                                        echo ' <span title="Member: Deactivated" data-toggle="tooltip" class="Deactivedot"></span>'; 
                                    }
                                    
                                    if ($Member['Gender']=="Male") {
                                        echo '&nbsp;<i class="fa fa-male" data-toggle="tooltip" title="Gender: Male" aria-hidden="true"></i>';
                                    } else {
                                        echo '&nbsp;<i class="fa fa-female" data-toggle="tooltip" title="Gender: Female" aria-hidden="true"></i>';
                                    }
                                ?> 
                                &nbsp;&nbsp;&nbsp;<?php echo $Member['MemberCode'];?>
                                </td>
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
    $('[data-toggle="tooltip"]').tooltip({ container: 'body' }); 
    $('#myTable_filter input').addClass('form-control'); 
    $('#myTable_length select').addClass('form-control'); 
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<?php/* $Franchisees = $mysql->select("select * from _tbl_Franchisees"); ?>
                        <?php foreach($Franchisees as $Franchisee) { */?>
                         <?php // }  
                        ?>