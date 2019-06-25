<form method="post" action="<?php echo GetUrl("Franchisees/News/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">News & Events</h4>
                <div class="Form-group row">
                <div class="col-sm-3">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create News</button>
                </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="NewsandEvents" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="Publish"><small style="font-weight:bold;text-decoration:underline">Publish</small></a>&nbsp;|&nbsp;
                        <a href="UnPublished"><small style="font-weight:bold;text-decoration:underline">Unpublished</small></a>
                </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                           <th>Created</th> 
                           <th>News Title </th>  
                           <th>Published On</th>
                           <th>Unpublished On</th>
                           <th>Viewed</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $News = $mysql->select("select * from _tbl_franchisees_news where NewsFor='NF001' and IsActive='1'"); ?>
                        <?php foreach($News as $New) { ?>
                                <tr>
                                <td><span class="<?php echo ($New['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo putDateTime($New['CreatedOn']);?></td>
                                <td><?php echo $New['NewsTitle'];?></td> 
                                <td><?php //echo putDateTime($New['CreatedOn']);?></td>
                                <td><?php //echo putDateTime($New['CreatedOn']);?></td>  
                                <td><?php echo $New['Viewed'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Franchisees/Plan/Manage/Edit/". $New['NewsCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Plan/Manage/Manage/View/". $New['NewsCode'].".html");?>"><span>View</span></a></td>
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
