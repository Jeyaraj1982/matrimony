<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Report</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" width="100%">
                      <thead>
                        <tr>
                          <th>Plan Name</th>  
                          <th>Active Profle</th>
                          <th>Expired Profile</th> 
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <tr>
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