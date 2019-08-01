<?php
    $page="KYC";    
    include_once("settings_header.php");
?>
<form method="post" action=""  enctype="multipart/form-data">
    <div class="col-sm-9"  style="margin-top: -8px;">
        <h4 class="card-title" style="margin-bottom:5px">KYC Process</h4>
        <span style="color:#999;">KYC stands for Know Your Customer process of identifying and verifying identity of members.</span>
        <br><br>
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
                        $res = $webservice->getData("Member","UpdateKYC",$_POST);
                        if ($res['status']=="success") {
                            echo  $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                    } else {
                        $res =$webservice->getData("Member","UpdateKYC");
                }
                }
                  else {
                     $res =$webservice->getData("Member","UpdateKYC");
                     
                }
               $res =$webservice->getData("Member","UpdateKYC");
               $Kyc =$webservice->getData("Member","GetKYC");
                 $KycProof=$Kyc['data']['KYCView'];
            ?>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom:0px">
            <div class="col-sm-3">ID Proof</div>
            
            <?php if (sizeof($Kyc['data']['IdProofDocument'])>0) {?>
            <div class="col-sm-5" style="padding-top: 5px;color: #888;">
                <img src="<?php echo AppUrl;?>uploads/<?php echo $Kyc['data']['IdProofDocument'][0]['FileName'];?>" style="height:120px;"><br><br>
                 Document Type&nbsp;&nbsp;:<?php echo $Kyc['data']['IdProofDocument'][0]['FileType'];?>
                <br><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;">&nbsp;Updated On&nbsp;&nbsp;&nbsp;:<?php echo putDateTime($Kyc['data']['IdProofDocument'][0]['SubmittedOn']);?>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status &nbsp;&nbsp;:
                <?php if($Kyc['data']['IdProofDocument'][0]['IsVerified']==0 && $Kyc['data']['IdProofDocument'][0]['IsRejected']==0){ 
                    echo "Verification pending";
                } if($Kyc['data']['IdProofDocument'][0]['IsVerified']==1 && $Kyc['data']['IdProofDocument'][0]['IsRejected']==0) { 
                    echo "verified";
                }
                  if($Kyc['data']['IdProofDocument'][0]['IsRejected']==1) { 
                    echo "Rejected";
                }
                ?>
            </div>
            <?php } else { ?>
            <div class="col-sm-3">
                <select name="IDType" id="IDType"  class="selectpicker form-control" data-live-search="true">
                    <?php foreach($Kyc['data']['IDProof'] as $IDType) { ?>
                        <option value="<?php echo $IDType['SoftCode'];?>" <?php echo ($_POST['IDType']==$IDType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $IDType['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-3" style="padding-top: 5px;"><input type="file" name="IDProofFileName"></div>
            <?php } ?>
            
            
        </div>
        <div class="form-group row" style="margin-bottom: 0px;" >
            <hr style="border:none;border-bottom:1px solid #eee;width:90%;margin:15px">
        </div>
        
        <div class="form-group row">
            <div class="col-sm-3">Address Proof</div>
            
            <?php if (sizeof($Kyc['data']['AddressProofDocument'])>0) {?>
            <div class="col-sm-5" style="padding-top: 5px;color: #888;">
                <img src="<?php echo AppUrl;?>uploads/<?php echo $Kyc['data']['AddressProofDocument'][0]['FileName'];?>" style="height:120px;"><br><br>
                 Document Type&nbsp;&nbsp;:<?php echo $Kyc['data']['AddressProofDocument'][0]['FileType'];?>
                <br><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;">&nbsp;Updated On&nbsp;&nbsp;&nbsp;:<?php echo putDateTime($Kyc['data']['AddressProofDocument'][0]['SubmittedOn']);?>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status &nbsp;&nbsp;:
                <?php if($Kyc['data']['AddressProofDocument'][0]['IsVerified']==0 && $Kyc['data']['AddressProofDocument'][0]['IsRejected']==0){ 
                    echo "Verification pending";
                } if($Kyc['data']['AddressProofDocument'][0]['IsVerified']==1 && $Kyc['data']['AddressProofDocument'][0]['IsRejected']==0) { 
                    echo "verified";
                }
                  if($Kyc['data']['AddressProofDocument'][0]['IsRejected']==1) { 
                    echo "Rejected";
                }
                ?>
            </div>
            <?php } else { ?>
            <div class="col-sm-3" >
                <select name="AddressProofType" id="AddressProofType"  class="selectpicker form-control" data-live-search="true">
                    <?php foreach($Kyc['data']['AddressProof'] as $AddressProofTypee) { ?>
                        <option value="<?php echo $AddressProofTypee['SoftCode'];?>" <?php echo ($_POST['AddressProofType']==$AddressProofTypee['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $AddressProofTypee['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-3" style="padding-top: 5px;"><input type="file" name="AddressProofFileName"></div>
             <?php }?>
        </div>
        <?php if(sizeof($Kyc['data']['IdProofDocument'])== 0 || (sizeof($Kyc['data']['AddressProofDocument'])== 0)){?>
        <br>
        <br>
        <span style="color:#666;">In order to submit your KYC, your identification documents need to pass a verification process, done by our document authentication team.</span>
        <br>
        <br>
        <div class="form-group row">
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="updateKYC" style="font-family:roboto">Submit Documents</button>
        </div>
        <?php }?>
</form>
<script>
 
    
 
 $( document ).ready(function() {
//     setTimout(function(){
  //   $('.bootstrap-select .form-control').css({"border":"1px solid #ccc !important"});     
    // },2000);
    
});
</script>
<?php include_once("settings_footer.php");?>                                
