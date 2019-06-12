<form method="post" action="<?php echo GetUrl("Plans/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Plans</h4>
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Plans</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">Excel</a></li>
                    <li><a href="#">Pdf</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Plan Code</th>  
                          <th>Plan String</th>
                          <th>Validity</th>
                          <th>is Featured</th>
                          <th>is Active</th> 
                          <th>Billing Cost</th> 
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
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