<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Online Members</h4>
        <?php 
            $response = $webservice->getData("Admin","GetOnlineMembers");
            print_r($response);
        ?>
        <div class="table-responsive">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Member Name</th> 
                    <th>Email ID</th> 
                    <th>Mobile Number</th> 
                </tr>  
            </thead>
            <tbody>  
            <?php 
                foreach($response['data'] as $Member) {
            ?>
                <tr>
                    <td><?php echo $Member['MemberName'];?></td>
                    <td><?php echo $Member['EmailID'];?></td>
                    <td><?php echo $Member['MobileNumber'];?></td>
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
