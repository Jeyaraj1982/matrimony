<form method="post" action="<?php echo GetUrl("Masters/Heights/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Height</h4>
                <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Height</button>
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
                          <th>Heights</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $Heights = $mysql->select("select * from _tbl_master_codemaster Where HardCode='HEIGHTS'"); ?>
                        <?php foreach($Heights as $Height) { ?>
                                <tr>
                                <td><span class="<?php echo ($Height['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Height['SoftCode'];?></td>
                                <td><?php echo $Height['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/Heights/Manage/Edit/". $Height['SoftCode'].".html");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/Heights/Manage/View/". $Height['SoftCode'].".html");?>"><span class="glyphicon glyphicon-pencil">View</span></a></td>
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