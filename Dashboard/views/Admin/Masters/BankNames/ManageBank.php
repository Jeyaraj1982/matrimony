<form method="post" action="<?php echo GetUrl("Masters/BankNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Bank Names</h4>

                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Bank Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" width="100%">
                      <thead>
                        <tr>
                          <th>Bank Name ID</th>  
                          <th>Bank Names</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $BankNames =$webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($BankNames['data']['BankName'] as $BankName) { ?>
                                <tr>
                                <td><span class="<?php echo ($BankName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $BankName['SoftCode'];?></td>
                                <td><?php echo $BankName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/BankNames/Manage/Edit/". $BankName['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/BankNames/Manage/View/". $BankName['SoftCode'].".html");?>">View</a></td>
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
