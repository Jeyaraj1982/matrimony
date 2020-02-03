<?php 
    $response = $webservice->getData("Admin","GetManageActiveFranchisee");
    if (sizeof($response['data'])==0) {
?>
<div class="form-group row">
     <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div style="text-align: center;padding-top:calc( (100vh - 105px)/2 - 130px) !important;padding-bottom:calc( (100vh - 105px)/2 - 130px) !important;">
                    <div style="">
                    <img src="<?php echo ImagePath ?>/icons/franchisee_icon.png" style="width:128px;">
                    </div><br>
                    Active Franchisee Not Found <br><a href="<?php echo GetUrl("Franchisees/Create");?>">click here to create franchisee</a>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php } else {?>
<form method="post" action="<?php echo GetUrl("Franchisees/Create");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Franchisees</h4>
                <h4 class="card-title">Manage Franchisees</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Franchisee Names</th>  
                        <th>State Name</th>
                        <th>District Name</th>
                        <th>Plan Name</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php foreach($response['data'] as $Franchisee) { ?>
                                <tr>
                                <td><span class="<?php echo ($Franchisee['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Franchisee['FranchiseName'];?><?php if($Franchisee['IsAdmin']==1) {?>&nbsp;<button class="btn btn-primary" style="padding: 0px 4px;font-size: 12px;background: orange;border: orange">Default</button><?php } ?></td>
                                <td><?php echo $Franchisee['StateName'];?></td>
                                <td><?php echo $Franchisee['DistrictName'];?></td>
                                <td><?php echo $Franchisee['Plan'];?></td>
                                <td><?php echo putDateTime($Franchisee['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Franchisees/Wallet/RefillTransfer/". $Franchisee['FranchiseeCode'].".html");?>"><span>Refill</span></a></td>
                                </tr>
                        <?php } ?>            
                      </tbody>                        
                     </table>
                  </div>
                </div>
              </div>
            </div>
        </form>   
		<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 300px;min-height: 300px;" >
            
                </div>
            </div>
        </div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<?php } ?>