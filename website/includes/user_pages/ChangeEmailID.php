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
             
              if (isset($_POST['btnChangeEmailID'])) {
       
        $response = $webservice->getData("Member","ReqToChangeEmail",$_POST);    
        if ($response['status']=="success") {
        ?>
        <form action="ChangeEmailID-Otp" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
            <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
            <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
            <input type="hidden" value="<?php echo $_POST['EmailID'];?>" name="EmailID">
        </form>
        <script>document.getElementById("reqFrm").submit();</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    } 
    
             $res = $webservice->getData("Member","CheckChangeEmailIDDetails",array("link"=>$_GET['link'])); 
                if ($res['status']=="success") {
                 ?>
                    <script>
    $(document).ready(function () {
        $("#EmailID").blur(function () {    
            IsNonEmpty("EmailID","ErrEmailID","Please Enter Email Address");
        });
    });
    
    function SubmitChangeEmailID() {
        $('#ErrEmailID').html("");
        ErrorCount=0;
        if(IsNonEmpty("EmailID","ErrEmailID","Please Enter Email Address")){
            IsEmail("EmailID","ErrEmailID","Please Enter Valid Email Address");
        }
        return (ErrorCount==0) ? true : false;
    }
</script>

 <div style="text-align:center">
                <h2>Change Email</h2>
            </div>
            
          
            
            <form action="" method="post" role="form" class="contactForm"  onsubmit="return SubmitChangeEmailID();">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
                <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;">
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                New Email Address <br>
                                <input type="text" class="form-control pwd" id="EmailID" name="EmailID" Placeholder="eg: albert@gmail.com" value="<?php echo isset($_POST['EmailID']) ? $_POST['EmailID'] : '';?>">
                                <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?><?php echo $errormessage;?></span>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:red;text-align:center">
                            <div class="form-group"><button type="submit" name="btnChangeEmailID" class="btn btn-primary" required="required">Continue</button></div>
                        </td>
                    </tr>
             </table>
            </form>
                 <?php
                } else { ?>  <br><br><br>
                    <div class="form-group" style="text-align:center">
                        <img src="website/assets/images/exclamationmark.jpg" width="25%">
                        <br><?php echo  $res['message'];?> 
                    </div>
               <?php  }
             ?>
            </div>
        </div>
        <div class="col-sm-3"></div>
   </div> <br><br><br>
<?php include_once("includes/footer.php");?>
 