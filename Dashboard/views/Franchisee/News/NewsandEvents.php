<form method="post" action="<?php echo GetUrl("Franchisees/News/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">News & Events</h4>
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create News</button>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                           <th>News ID</th> 
                           <th>News Title </th>  
                           <th>Created</th>
                           <th>Published</th>
                           <th>Viewed</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $News = $mysql->select("select * from _tbl_franchisees_news"); ?>
                        <?php foreach($News as $New) { ?>
                                <tr>
                                <td><?php echo $New['NewsID'];?></td>
                                <td><?php echo $New['NewsTitle'];?></td>
                                <td><?php echo $New['CreatedOn'];?></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Franchisees/Plan/Manage/Edit/". $New['NewsCode'].".html");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Plan/Manage/Manage/View/". $New['NewsCode'].".html");?>"><span class="glyphicon glyphicon-pencil">View</span></a></td>
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

                       