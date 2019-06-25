<!--<form method="post" action="<?php //echo GetUrl("Masters/StarNames/New");?>" onsubmit="">
    <div class="container"  id="sp">
        <h2>Manage Star Name</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6" align="left"><button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-print"></span> Add Star Name</button></div> 
                </div>  
            </div>   
            <br>
            <div class="form-group">
                <div class="col-sm-12">
                    <table id="myTable" class="table table-stripped">  
                        <thead>  
                          <tr>  
                            <th>ID</th>  
                            <th>Star Name</th>  
                            <th></th>
                            </tr>  
                        </thead>  
                        <tbody>  
                          <?php //$StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAME'"); ?>
                          <?php // foreach($StarNames as $StarName) { ?>
                                <tr>
                                <td><?php // echo $StarName['SoftCode'];?></td>
                                <td><?php // echo $StarName['CodeValue'];?></td>
                                <td><a href="<?php // echo GetUrl("Masters/StarNames/Manage/Edit/". $StarName['SoftCode'].".html");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a></td>
                                </tr>
                        <?php // } ?>  
                        </tbody>  
                  </table>
            </div>
          </div>
        </div>
 </form>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>-->

<form method="post" action="<?php echo GetUrl("Masters/StarNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Star Names</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Star Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageStar" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveStar"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveStar"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Star Names</th>
                          <th></th> 
                        </tr>
                      </thead>
                       <tbody>  
                          <?php $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES' and IsActive='0'"); ?>
                          <?php foreach($StarNames as $StarName) { ?>
                                <tr>
                                <td><span class="<?php echo ($StarName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $StarName['SoftCode'];?></td>
                                <td><?php echo $StarName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/StarNames/Manage/Edit/". $StarName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/StarNames/Manage/View/". $StarName['SoftCode'].".html");?>"><span>View</span></a></td>
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