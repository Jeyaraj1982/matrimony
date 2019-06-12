<form method="post" action="<?php echo GetUrl("Testimonials/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Testmonials</h4>
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Testimonial</button>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Testimonial Title</th>
                          <th>Posted on</th>
                          <th>Views</th> 
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
