<form method="post" action="<?php echo GetUrl("Settings/MobileSMS/Create");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Settings</h4>
                <h6 class="card-title">Manage Mobile Api</h6>
                <div class="form-group row">
                 <div class="col-sm-3"><button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Api</button> </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="MobileSms" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                <a href="ActiveMobileSms"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                <a href="DeactiveMobileSms"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Api Code</th>
                        <th>Api Name</th>
                        <th>Api Url</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>  
                        <?php $response = $webservice->getData("Admin","ManageSettingsMobileSms",array("Request"=>"Deactive")); ?>  
                        <?php foreach($response['data'] as $MobileSMS) { ?>
                                <tr>
                                <td><span class="<?php echo ($MobileSMS['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $MobileSMS['ApiCode'];?></td>
                                <td><?php echo $MobileSMS['ApiName'];?></td>
                                <td><?php echo $MobileSMS['ApiUrl'];?></td>
                                <td><?php echo putDateTime($MobileSMS['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Settings/MobileSMS/Edit/". $MobileSMS['ApiID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/MobileSMS/View/". $MobileSMS['ApiID'].".htm");?>"><span>View</span></a>
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