<?php 
$page="Templates";
include_once("settings_header.php");
?>

<div class="col-sm-10 rightwidget">
<form method="post" id="FrmTemplate">  
    <input type="hidden" value="" name="txnPassword" id="txnPassword">   
    <input type="hidden" value="" name="Category" id="Category"> 
    <input type="hidden" value="" name="CategoryDescription" id="CategoryDescription">
    <h4 class="card-title">Manage Templates</h4>                    
        <div class="form-group row">
            <div class="col-sm-6"><a href="javascript:void(0)" onclick="CreateTemplate()" class="btn btn-primary"><i class="mdi mdi-plus"></i>Create Template</a></div>
        </div>
        <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Category</th>  
                        </tr>
                      </thead>
                       <tbody>  
                        <?php 
                            $response = $webservice->getData("Admin","GetManageTemplates",array("Request"=>"All"));
                         ?>
                        <?php foreach($response['data'] as $template) { ?>
                                <tr>
                                <td><?php echo $template['Category'];?></td>
                                <td><a href="<?php echo GetUrl("Settings/Template/EditTemplate/". $template['AccessCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Template/ViewTemplate/". $template['AccessCode'].".html");?>"><span>View</span></a>
                                </td>
                                </tr>
                        <?php } ?>            
                      </tbody> 
                    </table>
                  </div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
            
                </div>
            </div>
        </div>
<?php include_once("settings_footer.php");?>                    