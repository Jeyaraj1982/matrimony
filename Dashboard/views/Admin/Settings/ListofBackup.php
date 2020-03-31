<form method="post" action="<?php echo GetUrl("Settings/Backup");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Application Backup</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Backup</button></div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Backup date</th>
                          <th>Title</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Completed On</th>
                          <th>Size</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                       <tbody>  
                        <?php 
                            $response = $webservice->getData("Admin","GetManageBackup");
                         ?>
                        <?php foreach($response['data'] as $Backup) { ?>
                                <tr>
                                <td><?php echo $Backup['BackupOn'];?></td>
                                <td><?php echo $Backup['BackupTitle'];?></td>
                                <td><?php echo $Backup['BackupFor'];?></td>
                                <td><?php echo $Backup['Status'];?></td>
                                <td><?php echo $Backup['Size'];?></td>
                                <td><?php echo $Backup['CompletedOn'];?></td>
                                <td></td>
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
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 300px;min-height: 300px;" >
            
                </div>
            </div>
        </div>         
