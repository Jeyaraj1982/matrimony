<?php
    $isShowSlider = false; 
    $layout=0;                                    
    include_once("includes/header.php");  
    include_once(application_config_path);
?>
   <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align:center">
             <?php 
                if (isset($_POST['btnChangeMobileNumber'])) {
       
        $response = $webservice->getData("Member","ReqToChangeMobileNumber",$_POST);    
        if ($response['status']=="success") {
        ?>
        <form action="ChangeMobileNumber-Otp" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
            <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
            <input type="hidden" value="<?php echo $_POST['CountryCode'];?>" name="CountryCode">
            <input type="hidden" value="<?php echo $_POST['MobileNumber'];?>" name="MobileNumber">
        </form>
        <script>document.getElementById("reqFrm").submit();</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    } 
            $res = $webservice->getData("Member","CheckChangeMobileNumberDetails",array("link"=>$_GET['link']));
                if ($res['status']=="success") {
                 ?>
<script>
    $(document).ready(function () {
        $("#MobileNumber").blur(function () {    
            IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
        });
    });
    
    function SubmitChangeMobileNumber() {
        $('#ErrMobileNumber').html("");
        ErrorCount=0;
        if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number")){
            IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
        }
        return (ErrorCount==0) ? true : false;
    }
</script>

 <div style="text-align:center">
                <h2>Change Mobile Number</h2>
            </div>
            
            <form action="" method="post" role="form" class="contactForm"  onsubmit="return SubmitChangeMobileNumber();">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
                <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 290px;max-width:100%">
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <label for="MobileNumber" style="text-align: left;">New Mobile Number</label>
                            <div>
                                <select name="CountryCode" class="form-control" id="CountryCode" style="width:70px;float:left">
                                    <option value="91">+91</option>
                                </select>
                                <input type="text" class="form-control" name="MobileNumber" id="MobileNumber" maxlength="10" placeholder="Mobile Number" value="<?php echo isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';?>" style="width:75%">
                            </div>
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:red;text-align:center">
                            <div class="form-group"><button type="submit" name="btnChangeMobileNumber" class="btn btn-primary" required="required">Continue</button></div>
                        </td>
                    </tr>
             </table>
            </form>
                 <?php
                } else { ?>  <br><br><br>
                    <div class="form-group" style="text-align:center">
                        <img src="website/assets/images/exclamationmark.jpg" width="25%">
                        <br><?php echo $errormessage = $res['message'];?> 
                    </div>
               <?php  }
             ?>
            </div>
        </div>
        <div class="col-sm-3"></div>
   </div> <br><br><br>
<?php include_once("includes/footer.php");?>
 