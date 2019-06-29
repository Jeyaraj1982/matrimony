<?php
    $page="KYC";    
    include_once("settings_header.php");
?>
<form method="post" action=""  enctype="multipart/form-data">
    <div class="col-sm-9"  style="margin-top: -8px;">
        <h4 class="card-title">KYC</h4>
        <div class="form-group row">
            <div class="col-sm-12">
            <?php
                if (isset($_POST['updateKYC'])) {
                    
                    $target_dir = "uploads/";
                    $err=0;
                    $_POST['IDProofFileName']= "";
                    $_POST['AddressProofFileName']= "";
                    
                    if (isset($_FILES["IDProofFileName"]["name"]) && strlen(trim($_FILES["IDProofFileName"]["name"]))>0 ) {
                        $idprooffilename = time().basename($_FILES["IDProofFileName"]["name"]);
                        if (!(move_uploaded_file($_FILES["IDProofFileName"]["tmp_name"], $target_dir . $idprooffilename))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if (isset($_FILES["AddressProofFileName"]["name"]) && strlen(trim($_FILES["AddressProofFileName"]["name"]))>0 ) {
                        $addressfilename = time().basename($_FILES["AddressProofFileName"]["name"]);
                        if (!(move_uploaded_file($_FILES["AddressProofFileName"]["tmp_name"], $target_dir . $addressfilename))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file..";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['IDProofFileName']= $idprooffilename;
                        $_POST['AddressProofFileName']= $addressfilename;
                        $response = $webservice->UpdateKYC($_POST);
                        if ($response['status']=="success") {
                            echo  $response['message']; 
                        } else {
                            $errormessage = $response['message']; 
                        }
                    }
                }
                $Kyc = $webservice->GetKYC(); 
                
                $image=$_FILES["IDProofFileName"]["name"]; 
              $img="uploads/".$image;
              
            ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">ID Proof</div>
            <div class="col-sm-3">
                <select name="IDType" id="IDType"  class="selectpicker form-control" data-live-search="true">
                    <?php foreach($Kyc['data']['IDProof'] as $IDType) { ?>
                        <option value="<?php echo $IDType['SoftCode'];?>" <?php echo ($_POST['IDType']==$IDType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $IDType['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-3"><input type="file" name="IDProofFileName"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">Address Proof</div>
            <div class="col-sm-3">
                <select name="AddressProofType" id="AddressProofType"  class="selectpicker form-control" data-live-search="true">
                    <?php foreach($Kyc['data']['AddressProof'] as $AddressProofTypee) { ?>
                        <option value="<?php echo $AddressProofTypee['SoftCode'];?>" <?php echo ($_POST['AddressProofType']==$AddressProofTypee['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $AddressProofTypee['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-3"><input type="file" name="AddressProofFileName"></div>
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary" name="updateKYC" style="font-family:roboto">Update</button>
        </div>
       <?php  echo '<img src= "uploads/".$img>';     ?>           
    </div>
</form>
<?php include_once("settings_footer.php");?>                                