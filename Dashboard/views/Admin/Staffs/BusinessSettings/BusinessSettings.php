<?php 
$page="BusinessSettings";
include_once("views/Admin/Staffs/BusinessSettings/Business_settings_header.php");
?>
<?php
    
    if (isset($_POST['btnsave'])) {
        
        $target_dir = "uploads/";
		if (!is_dir('uploads/business/logo')) {
			mkdir('uploads/business/logo', 0777, true);
		}
		
        $err=0;
        $_POST['File']= "";
        $acceptable = array('image/jpeg','image/jpg','image/png');
        if(($_FILES['File']['size'] >= 5000000)) {
            $err++;
            echo "File must be less than 5 megabytes.";
        }
        
        if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
            $err++;
            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
        }
        
        if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
            $Logo = time().$_FILES["File"]["name"];
            if (!(move_uploaded_file($_FILES["File"]["tmp_name"], 'uploads/business/logo/'. $Logo))) {
                $err++;
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        if ($err==0) {
            $_POST['File']= $Logo;
            $res =$webservice->getData("Admin","AddBusinessSettings",$_POST);
            if ($res['status']=="success") {                
            echo $successmessage = $res['message'];   
            } else {
            echo $errormessage = $res['message']; 
            }
        } 
    }
?>
<script>
function submitSettings()  {
            $('#ErrFile').html("");
            $('#ErrAddressLine1').html("");
            $('#ErrPincode').html("");
            $('#ErrEmail').html("");
            $('#ErrMobileNumber').html("");
            $('#ErrWebsite').html("");
            $('#ErrGSTNumber').html("");
            $('#ErrPanNumber').html("");
            
            ErrorCount==0
            
            if ($("#File").val()=="") {
                $("#ErrFile").html("Please select the company logo");
                ErrorCount++;
            }
            
            IsNonEmpty("AddressLine1","ErrAddressLine1","Please enter your address line 1");
            IsNonEmpty("Pincode","ErrPincode","Please enter your pincode");
            if(IsNonEmpty("Email","ErrEmail","Please enter your email address")){
                IsEmail("Email","ErrEmail","Please enter valid imail address");
            }
            if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your mobile number")){
                IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid mobile number");
            }
            IsNonEmpty("Website","ErrWebsite","Please enter your website");
            IsNonEmpty("GSTNumber","ErrGSTNumber","Please enter your gst number");
            IsNonEmpty("PanNumber","ErrPanNumber","Please enter your pan number");
            
            return (ErrorCount==0) ? true : false;
         
       
}
</script>
 
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return submitSettings();" enctype="multipart/form-data" >
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Business Settings</h4>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company Logo</label>
                        <div class="col-sm-10">
                            <input type="File" id="File" name="File" Placeholder="File">
                            <span class="errorstring" id="ErrFile"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address Line 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" Placeholder="Address Line1" value="<?php echo isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : '';?>">
                            <span class="errorstring" id="ErrAddressLine1"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address Line 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" Placeholder="Address Line2" value="<?php echo isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : '';?>">
                            <span class="errorstring" id="ErrAddressLine2"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address Line 3</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" Placeholder="Address Line3" value="<?php echo isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : '';?>">
                            <span class="errorstring" id="ErrAddressLine3"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Pincode" name="Pincode" Placeholder="Pincode" value="<?php echo isset($_POST['Pincode']) ? $_POST['Pincode'] : '';?>">
                            <span class="errorstring" id="ErrPincode"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Email" name="Email" Placeholder="Email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '';?>">
                            <span class="errorstring" id="ErrEmail"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="MobileNumber" maxlength="10" name="MobileNumber" Placeholder="Mobile Number" value="<?php echo isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';?>">
                            <span class="errorstring" id="ErrMobileNumber"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Landline Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="LandlineNumber" name="LandlineNumber" Placeholder="Landline Number" value="<?php echo isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : '';?>">
                            <span class="errorstring" id="ErrLandlineNumber"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Website" name="Website" Placeholder="Website" value="<?php echo isset($_POST['Website']) ? $_POST['Website'] : '';?>">
                            <span class="errorstring" id="ErrWebsite"></span>   
                        </div>
                   </div>
                   <h4 class="card-title">Social Media</h4>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Facebook Url</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="FacebookUrl" name="FacebookUrl" Placeholder="Facebook Url" value="<?php echo isset($_POST['FacebookUrl']) ? $_POST['FacebookUrl'] : '';?>">
                            <span class="errorstring" id="ErrFacebookUrl"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Twitter Url</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="TwitterUrl" name="TwitterUrl" Placeholder="Twitter Url" value="<?php echo isset($_POST['TwitterUrl']) ? $_POST['TwitterUrl'] : '';?>">
                            <span class="errorstring" id="ErrTwitterUrl"></span>   
                        </div>
                   </div>
                  <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Youtube Url</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="YoutubeUrl" name="YoutubeUrl" Placeholder="Youtube Url" value="<?php echo isset($_POST['YoutubeUrl']) ? $_POST['YoutubeUrl'] : '';?>">
                            <span class="errorstring" id="ErrYoutubeUrl"></span>   
                        </div>
                   </div>
                   <h4 class="card-title">&nbsp;</h4>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GST Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="GSTNumber" name="GSTNumber" Placeholder="GST Number" value="<?php echo isset($_POST['GSTNumber']) ? $_POST['GSTNumber'] : '';?>">
                            <span class="errorstring" id="ErrGSTNumber"></span>   
                        </div>
                   </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="PanNumber" name="PanNumber" Placeholder="Pan Number" value="<?php echo isset($_POST['PanNumber']) ? $_POST['PanNumber'] : '';?>">
                            <span class="errorstring" id="ErrPanNumber"></span>   
                        </div>
                   </div>
                   <br>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Footer : </label>
                        <label class="col-sm-2 col-form-label">Copy right &copy;</label>
                        <label class="col-sm-8 col-form-label">
                            <input type="text" class="form-control" id="Copyright" name="Copyright" value="<?php echo isset($_POST['Copyright']) ? $_POST['Copyright'] : '';?>"> 
                            <span class="errorstring" id="ErrCopyright"></span>   
                        </label>
                   </div>
                   <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary" name="btnsave" id="btnsave">Save</button>
                        </div>
                   </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    