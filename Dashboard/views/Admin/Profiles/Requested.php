<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Requested</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Requested On</th>
                          <th>Member Name</th>
                          <th>Profile Name</th> 
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                         $response = $webservice->getData("Admin","GetProfilesRequestVerify");
                         if (sizeof($response['data'])>0) {
                         ?>
                        <?php foreach($response['data'] as $Profile) { ?>  
                        <tr>
                           <td><?php echo putDateTime($Profile['RequestVerifyOn']);?></td>
                           <td><?php echo $Profile['MemberName'];?></td>
                           <td><?php echo $Profile['ProfileName'];?></td>
                           <td><a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a></td>
                      </tr>
                      <?php } }?>
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