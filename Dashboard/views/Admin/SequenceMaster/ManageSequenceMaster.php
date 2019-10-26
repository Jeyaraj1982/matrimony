<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Sequence Master</h4>
        <?php 
            $response = $webservice->getData("Admin","GetSequenceMasterDetails");
        ?>
        <div class="form-group row">
            <div class="col-sm-6">
                <a href="<?php echo GetUrl("SequenceMaster/AddSequence");?>" class="btn btn-primary">Add Sequence Master</a>
            </div>
        </div>
        <div class="table-responsive">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Sequence For</th> 
                    <th>Prefix</th> 
                    <th>String Length</th> 
                    <th>Last Number</th> 
                    <th></th> 
                </tr>  
            </thead>
            <tbody>  
            <?php 
                foreach($response['data'] as $Sequence) {
            ?>
                <tr>
                    <td><?php echo $Sequence['SequenceFor'];?></td>
                    <td><?php echo $Sequence['Prefix'];?></td>
                    <td><?php echo $Sequence['StringLength'];?></td>
                    <td><?php echo $Sequence['LastNumber'];?></td>
                    <td style="text-align:right">
                        <a href="<?php echo GetUrl("SequenceMaster/EditSequence/". $Sequence['SequenceID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("SequenceMaster/ViewSequence/". $Sequence['SequenceID'].".htm"); ?>"><span>View</span></a>
                    </td>
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
