<form method="post" action="<?php echo GetUrl("Masters/Monsigns/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Monsigns</h4>
                <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Monsign</button>
                          <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Monsign</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $Monsigns = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($Monsigns['data']['Monsign'] as  $Monsign) { ?>
                                <tr>
                                <td><span class="<?php echo ($Monsign['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Monsign['SoftCode'];?></td>
                                <td><?php echo $Monsign['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/Monsigns/Manage/Edit/". $Monsign['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/Monsigns/Manage/View/". $Monsign['SoftCode'].".html");?>">View</a></td> 
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