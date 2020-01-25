<form method="post" action="<?php echo GetUrl("Masters/EducationDegrees/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
       <div class="card-body">
         <h4 class="card-title">Masters</h4>
         <h4 class="card-title">Manage Education Degree</h4>
          <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Education Degree</button>
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
                          <th>Education Degrees</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                          <?php $EducationDegrees = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($EducationDegrees['data']['EducationDegree'] as $EducationDegree) { ?>
                                <tr>
                                <td><span class="<?php echo ($EducationDegree['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $EducationDegree['SoftCode'];?></td>
                                <td><?php echo $EducationDegree['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/EducationDegrees/Manage/Edit/". $EducationDegree['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/EducationDegrees/Manage/View/". $EducationDegree['SoftCode'].".html");?>">View</a></td> 
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
                          