<?php 
$response = $webservice->getData("Admin","GetListMemberDocuments");?>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Requests</h4>
                <h4 class="card-title">Member Doccument Verification</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Document Type</th> 
                    <th>File Type</th> 
                    <th>File Name</th>  
                    <th>Submitted On</th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Requests) {
            ?>
                <tr>
                    <td><?php echo $Requests['DocumentType'];?></td>
                    <td><?php echo $Requests['FileType'];?></td>
                    <td><?php echo $Requests['FileName'];?></td>
                    <td><?php echo PutDateTime($Requests['SubmittedOn']);?></td>
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
               