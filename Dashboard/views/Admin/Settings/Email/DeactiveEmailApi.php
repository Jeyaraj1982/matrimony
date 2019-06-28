<form method="post" action="<?php echo GetUrl("Settings/Email/Create");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Settings</h4>
                <h5 class="card-title">Manage Email Api</h5>
                <div class="form-group row">
                <div class="col-sm-3"><button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Api</button> </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="EmailApi" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                <a href="ActiveEmailApi"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                <a href="DeactiveEmailApi"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>
                        <th>Api Code</th> 
                        <th>Api Name</th>
                        <th>Host Name</th>
                        <th>User Name</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>  
                        <?php $response = $webservice->GetManageDeactiveEmailApi(); ?>
                        <?php foreach($response['data'] as $EmailApi) { ?>
                                <tr>
                                <td><span class="<?php echo ($EmailApi['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $EmailApi['ApiCode'];?></td>
                                <td><?php echo $EmailApi['ApiName'];?></td>
                                <td><?php echo $EmailApi['HostName'];?></td>
                                <td><?php echo $EmailApi['UserName'];?></td>
                                <td><a href="<?php echo GetUrl("Settings/Email/Edit/". $EmailApi['ApiID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Email/View/". $EmailApi['ApiID'].".htm");?>"><span>View</span></a>
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
