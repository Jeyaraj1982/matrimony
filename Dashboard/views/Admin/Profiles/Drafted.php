<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Drafted</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Code</th>  
                        <th>Member Name</th>
                        <th>Profile For</th>
                        <th>Created On</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php 
                         $response = $webservice->getData("Admin","GetDraftedProfiles");
                         if (sizeof($response['data'])>0) {
                         ?>
                        <?php foreach($response['data']as $Profile) { ?>
                                <tr>
                                <td><?php echo $Profile['CreatedBy'];?></td>
                                <td><?php echo $Profile['MemberName'];?></td>
                                <td><?php echo $Profile['ProfileFor'];?></td>
                                <td><?php echo putDateTime($Profile['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Profiles/ViewDraftProfile/". $Profile['ProfileID'].".htm");?>"><span>View</span></a></td>
                                </tr>
                        <?php }} ?>            
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