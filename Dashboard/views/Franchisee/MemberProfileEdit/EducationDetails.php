<?php
    $page="EducationDetails";
   ?>
   
<?php include_once("settings_header.php");?> 
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Education Details</h4>
        <table class="table table-bordered">
        <?php                 
                         $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileID"=>$_GET['Code'])));
                         if (sizeof($response['data'])>0) {
                    ?>
                        
            <thead>                                                                                      
                <tr>
                    <th>Education</th>
                    <th>Education Details</th>
                    <th>Attached On</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
                <?php foreach($response['data'] as $Document) { ?>
                        
                <tr>    
                    <td><?php echo $Document['Education'];?></td>
                    <td><?php echo $Document['EducationDetails'];?></td>
                    <td><?php echo putDateTime($Document['AttachedOn']);?></td>
                    <td></td>
                    <td><img src="<?php echo SiteUrl?>assets/images/delete.png" style="height: 159px;margin-bottom: -18px;"></td>
                </tr>
                <?php }}?>
            </tbody>
        </table>
        <br>
        <div align="right">
            <a href="<?php echo GetUrl("MemberProfileEdit/AddEducationalDetails/". $_GET['Code'].".htm");?>" class="btn btn-success mr-2" >add</a>
        </div>
        
    </div>      
<?php include_once("settings_footer.php");?>                    