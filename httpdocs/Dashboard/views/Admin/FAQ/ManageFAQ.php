<form method="post" action="<?php echo GetUrl("FAQ/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List FAQ</h4>
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>FAQ</button>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>QuestionID</th>  
                          <th>Question Title</th>
                          <th>Posted On</th>
                          <th>No of Views</th> 
                        </tr>
                      </thead>
                      <tbody>  
                             <?php// $FAQs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES'"); ?>
                        <?php// foreach($FAQs as $FAQ) { ?>
                                <tr>
                                <td><!--<span class="<?php //echo ($FAQ['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $FAQ['SoftCode'];?></td>  -->
                                <td><?php// echo $FAQ['CodeValue'];?></td>
                                <td></td>
                                <td></td>
                                </tr>
                        <?php // } ?>   
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
