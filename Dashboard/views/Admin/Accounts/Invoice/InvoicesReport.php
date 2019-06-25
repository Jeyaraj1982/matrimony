<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title">Invoices</h4>
                </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="Invoices"><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="Report"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Invoice Date</th>
                        <th>Invoice Number</th>
                        <th>Invoice To</th>
                        <th>Invoice For</th>
                        <th>Invoice Amount</th>
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
