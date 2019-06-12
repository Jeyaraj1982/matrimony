<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rejected Profiles</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Profile ID</th>  
                          <th>Rejected On</th>
                          <th>Blocked On</th>
                          <th>Reason</th>
                          <th>Blocked by</th> 
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