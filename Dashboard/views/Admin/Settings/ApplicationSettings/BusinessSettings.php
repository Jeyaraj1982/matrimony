<?php 
$page="BusinessSettings";
include_once("views/Admin/Settings/ApplicationSettings/settings_header.php");
?>
<?php
    if (isset($_POST['savparam'])) {
                   
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    
                    if (isset($_FILES[$_POST['FUpload']]['name']) && strlen(trim($_FILES[$_POST['FUpload']]['name']))>0) {
                        
                        if(($_FILES[$_POST['FUpload']]['size'] >= 5000000)) {
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES[$_POST['FUpload']]['type'], $acceptable)) && (!empty($_FILES[$_POST['FUpload']]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                        }
                        
                        $Logo = time().$_FILES[$_POST['FUpload']]["name"];
                        $_POST[$_POST['FUpload']]= "" ;
                        if (!(move_uploaded_file($_FILES[$_POST['FUpload']]["tmp_name"],'assets/logo/'. $Logo))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST[$_POST['FUpload']]= $Logo;
                        }
                        
                    }
                    
                    if ($err==0) {
                      $response = $webservice->getData("Admin","UpdateBusinessConfiguration",$_POST);
                        if ($response['status']=="success") {
                            echo $successmessage = $response['message']; 
                        } else {
                        $errormessage = $response['message']; 
                      }
    }
    }
?>
<div class="col-sm-10 rightwidget" style="padding: 0px;">
<form method="post" action="" enctype="multipart/form-data">      
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">                                                                                   
            <div class="form-group row">
                <div class="col-sm-6"><h4 class="card-title">Business Settings</h4></div>
                <!--<div class="col-sm-6" style="text-align: right;"><a href="<?php echo GetUrl("Settings/ApplicationSettings/AddConfigurationSettings");?>" class="btn btn-primary">Add</a></div>-->
            </div>
            <div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                  <thead>  
                    <tr> 
                        <th>Parameter</th>                          
                        <th style="text-align: right;">Value</th>                          
                    </tr>  
                </thead>
                <tbody> 
                    <?php $response = $webservice->getData("Admin","GetBusinessSettingsList"); ?>  
                    <?php foreach($response['data'] as $Config) { 
                        if(strlen(trim($Config['CodeValue']))>0) { 
                        ?>
                    
                        <tr>
                            <td style="padding: 1px;font-size:12px"><?php echo $Config['CodeValue'];?></td>    
                            <td style="float:right;padding: 1px;">
                                <?php if($Config['ParamB']=="boolean") {?>
                                    <select style="width:150px" name="app_<?php echo $Config['CodeValue'];?>">
                                        <option value="1" <?php echo $Config['ParamA']==1 ? " selected='selected' ":"";?>>Yes</option>
                                        <option value="0" <?php echo $Config['ParamA']==0 ? " selected='selected' ":"";?>>No</option>
                                    </select>
                                <?php } ?>
                                 <?php if($Config['ParamB']=="integer") {?>
                                    <input type="text" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;text-align:right;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                <?php } ?>
                                <?php if($Config['ParamB']=="file") {?>
                                    <?php if($Config['ParamA']=="") {?>
                                        <input type="hidden" value="app_<?php echo $Config['CodeValue'];?>" name="FUpload" >
                                        <input type="file" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;text-align:right;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                    <?php } else {?>
                                        <img src="<?php echo AppUrl;?>assets/logo/<?php echo $Config['ParamA'];?>" style="border-radius:0px;Height:104px;width:100%;"><br>
                                        <input type="hidden" value="app_<?php echo $Config['CodeValue'];?>" name="FUpload" >
                                        <input type="file" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;text-align:right;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                    <?php } ?>
                                <?php } ?>
                                <?php if($Config['ParamB']=="string") {?>
                                    <?php if(sizeof($Config['ParamC'])>0) {  ?>
                                        <select  name="app_<?php echo $Config['CodeValue'];?>" style="width: 150px;">
                                            <?php foreach($Config['ParamC'] as $c) {?>
                                                <option value="<?php echo $c['SoftCode'];?>" <?php echo $Config['ParamD']==$c['SoftCode'] ? " selected='selected' ":"";?>><?php echo $c['CodeValue'];?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                    <input type="text" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                    <?php } ?>
                                <?php } ?>
                            </td>    
                        </tr>                                              
                    <?php } }?>            
                  </tbody>                        
                 </table>
              </div>
              <div class="form-group row">
                <div class="col-sm-12" style="text-align: right;">
                    <button type="submit" name="savparam" id="savparam" class="btn btn-primary" style="font-family:roboto">Update</button>
                </div>
              </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    
          
