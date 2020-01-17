<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                        <div class="col-sm-6">
                        <h4 class="card-title">Rejected Profiles</h4>
                        </div>
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="Drafted"><small>Drafted</small></a>&nbsp;|&nbsp;
                            <a href="Requested"><small>Requested</small></a>&nbsp;|&nbsp;
                            <a href="Published"><small>Published</small></a>&nbsp;|&nbsp;
                            <a href="UnPublished"><small>UnPublished</small></a>&nbsp;|&nbsp;
                            <a href="Rejected"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>
                        </div>
                    </div>
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