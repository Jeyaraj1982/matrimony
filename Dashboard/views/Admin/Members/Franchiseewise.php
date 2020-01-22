<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                    <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Manage Members</h4>
                    <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">Franchisee-wise</h5>
                </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMembers" ><small>All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small>Deactivated</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeletedMembers"><small>Deleted</small></a>&nbsp;|&nbsp;
                        <a href="Franchiseewise"><small style="font-weight:bold;text-decoration:underline">Franchisee-wise</small></a>
                </div>
                </div>
                <div class="table-responsive">
                     <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th style="width:100px">Franchisee Code</th>
                        <th style="width:200px">Franchisee Name</th>
                        <th style="width:50px">Created On</th>
                        <th style="width:50px">District</th>
                        <th style="width:50px">Members</th>
                        <th style="width:50px"></th>                       
                        </tr>  
                    </thead>
                    <tbody> 
                   <?php $response = $webservice->getData("Admin","GetManageMembers",array("Request"=>"FranchiseeWise")); ?>  
                        <?php foreach($response['data'] as $Franchisee) { ?> 
                                <tr>
                                <td><span class="<?php echo ($Franchisee['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php  echo $Franchisee['FranchiseeCode'];?></td>
                                <td><?php echo $Franchisee['FranchiseName'];?></td>
                                <td><?php echo putDateTime($Franchisee['CreatedOn']);?></td>
                                <td><?php echo $Franchisee['DistrictName'];?></td>
                                <td style="text-align: right"><?php echo $Franchisee['MemberCount'];?></td>
                                <td style="text-align:right">
                                    <?php if ($Franchisee['MemberCount']>0) {?>
                                        <a href="<?php echo GetUrl("Members/ViewFranchiseeInfo/". $Franchisee['FranchiseeID'].".htm"); ?>"><span >View Members</span>
                                    <?php } else { ?>
                                        <span title="No members found" style="color:#888;cursor:pointer" >View Member</span>
                                    <?php } ?>
                                </a>
                                </td>
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