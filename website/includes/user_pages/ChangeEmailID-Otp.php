 <?php
    if (isset($_POST['btnVerifyCode'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","ReqToChangeEmailSave",$_POST);
        if ($response['status']=="success") {
        ?>
        <form action="EmailID-changed" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $_POST['reqID'];?>" name="reqID">
            <input type="hidden" value="<?php echo $_POST['EmailID'];?>" name="EmailID">
            <input type="hidden" value="<?php echo $_POST['link'];?>" name="link">
        </form>
        <script>document.getElementById("reqFrm").submit();</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }  
    } 
    $layout=0;
    $isShowSlider = false;                              
    include_once("includes/header.php");
 ?>
<script>
function submitMemberChangeEmailIDOtp() {
        $('#Errscode').html("");
        ErrorCount=0;
        
        IsNonEmpty("scode","Errscode","Please Enter Verification code");
         return  (ErrorCount==0) ? true : false;
    }    
</script>
   <br><br><br> 
   <div class="row">
	<div class="col-sm-3"></div>
        <div class="col-sm-6">
			<div style="min-width: 410px;max-width:410px;margin:0px auto;">
				<div style="text-align:center">
					<h2>Change Email</h2>
				</div>
				<form action="" method="post" role="form" class="contactForm"  onsubmit="return submitMemberChangeEmailIDOtp();">
					<div class="form-group" style="text-align: center;">We have sent a verification code to your new email. Please check your email and  enter the verification code bellow</div>
					<input type="hidden" value="<?php echo $_POST['reqID'];?>" name="reqID">
                    <input type="hidden" value="<?php echo $_POST['EmailID'];?>" name="EmailID">
                    <input type="hidden" value="<?php echo $_POST['link'];?>" name="link">
					<div class="form-group">
						<input type="text" class="form-control"  name="scode" id="scode" placeholder="Verification code here ..." style="height:32px !important" value="<?php echo isset($_POST['scode']) ? $_POST['scode'] : '';?>">
						<span class="errorstring" id="Errscode"><?php echo isset($Errscode)? $Errscode : "";?>&nbsp;</span>
						<div class="validation"></div>
					</div>
					<?php if (isset($errormessage)) { ?>
						<div class="form-group" style="color: red"><?php echo $errormessage; ?></div>
					<?php } ?>
					<div class="text-center"><button type="submit" name="btnVerifyCode" class="btn btn-primary" required="required">Verify your code</button></div>
				</form>
			</div>
		</div>
        <div class="col-sm-3"></div>
	</div>
   <br><br><br>                                                                               
<?php include_once("includes/footer.php");?>